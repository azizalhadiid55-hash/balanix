<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\CustomVerifyEmailNotification;

class AuthController extends Controller
{
    // For Index Page
    public function indexLogin()
    {
        return view('auth.login');
    }

    public function indexRegister()
    {
        return view('auth.register');
    }

    public function indexForgotPasswordr()
    {
        return view('auth.forgot-password');
    }

    public function indexResetPasswordr()
    {
        return view('auth.reset-password');
    }

    // Untuk Logout
    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user) {
            $user->remember_token = null;
            $user->google_token = null;
            $user->google_refresh_token = null;
            $user->save();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function createAkun(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            // Custom pesan error
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Menambah Data ke dalam tabel Users
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);

                // Coba kirim email verifikasi
                $user->notify(new CustomVerifyEmailNotification());
            });

            // Flash message sukses
            Session::flash('success', 'Registrasi berhasil! Silakan cek email Anda untuk aktivasi akun.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            // Jika ada error (termasuk gagal kirim email), rollback otomatis
            Session::flash('error', 'Registrasi gagal. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    // For Login
    public function masukAkun(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $isAccountLoginGoogle = User::where('email', $request->email)->whereNotNull('google_id')->first();
        if ($isAccountLoginGoogle) {
            return back()->withErrors(['msg' => 'Akun telah terdaftar melalui Login Google. Silakan gunakan tombol "Masuk dengan Google".'])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('verification.notice');
            }

            $request->session()->regenerate();

            // Cek role user setelah login
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Redirect ke dashboard admin
            }

            return redirect()->intended('/dashboard'); // Redirect user biasa ke dashboard
        }

        return back()->withErrors(['email' => 'Login Invalid'])->onlyInput('email');
    }

    // Untuk System Forgot password:
    public function kirimEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function redirectToGoogle()
    {
        /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
        $driver = Socialite::driver('google');

        return $driver->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            /** @var \Laravel\Socialite\Two\GoogleProvider $driver */
            $driver = Socialite::driver('google');

            $googleUser = $driver->stateless()->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                $user->trial_expired_at = now()->addDays(7);
                $user->save();
            }

            Auth::login($user, true);

            if ($user) {
                $request->session()->regenerate();

                if (Auth::user()->role === 'admin') {
                    return redirect()->intended('/admin/dashboard');
                }

                return redirect()->intended('/dashboard');
            }

            return redirect('/login')->withErrors(['msg' => 'Login gagal, silakan coba lagi.']);
        } catch (\Exception $e) {
            // Menangkap dan menampilkan pesan error asli dari sistem ke halaman login
            return redirect('/login')->withErrors(['msg' => 'Gagal Login: ' . $e->getMessage()]);
        }
    }
}
