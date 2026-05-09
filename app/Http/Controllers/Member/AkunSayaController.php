<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AkunSayaController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Dapatkan data user yang sedang login
        $subcription = $user->getLatestActiveSubscription();
        return view('member.akunSaya', compact('user', 'subcription'));
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password_baru.min' => 'Password baru harus minimal 8 karakter.',
            // Pesan validasi yang diubah ke Bahasa Indonesia
            'password_baru.mixedCase' => 'Password baru harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
            'password_baru.numbers' => 'Password baru harus mengandung setidaknya satu angka.',
            'password_baru.symbols' => 'Password baru harus mengandung setidaknya satu simbol.',
        ]);

        /** @var \App\Models\User $user */ // Tambahkan baris ini
        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        // Update password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
