<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\BootcampController;
use App\Http\Controllers\Member\BalabotController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Member\AkunSayaController;
use App\Http\Controllers\Member\TransaksiController;
use App\Http\Controllers\Member\BerlanggananController;
use App\Http\Controllers\Member\HutangPiutangController;
use App\Http\Controllers\Member\BootcampController as MemberBootcampController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/login', [AuthController::class, 'indexLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'masukAkun'])->middleware(['guest', 'throttle:5,1']);
Route::get('/register', [AuthController::class, 'indexRegister'])->middleware('guest');
Route::post('/register/create', [AuthController::class, 'createAkun'])->middleware('guest');

// Google OAuth
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/forgot-password', [AuthController::class, 'indexForgotPasswordr'])->middleware('guest');
Route::post('/forgot-password', [AuthController::class, 'kirimEmail'])->middleware('guest');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset')->middleware('guest');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update')->middleware('guest');

Route::get('/reset', [AuthController::class, 'indexResetPasswordr'])->middleware('guest');

// Untuk verifikasi email
Route::get('/email/verify/{id}', function (string $id) {
    $user = User::findOrFail($id);

    if ($user->email_verified_at) {
        return view('auth.email-verify-result', [
            'status' => 'already',
            'user' => $user,
        ]);
    }

    $user->update([
        'email_verified_at' => now(),
        'trial_expired_at' => now()->addDays(7),
    ]);

    return view('auth.email-verify-result', [
        'status' => 'success',
        'user' => $user,
    ]);
})
    ->name('verification.verify')
    ->middleware('signed');

Route::get('/email/notice', function () {
    return redirect()->back()->withErrors(['msg' => 'Harap verifikasi email Anda terlebih dahulu']);
})->name('verification.notice');

// Untuk Admin
Route::middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/admin/logout', [AuthController::class, 'logout']);
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashbaord.index');
    // AJAX list untuk masing-masing tabel
    Route::get('/admin/dashboard/berlanganan/tambah', [DashboardController::class, 'tambah']);
    Route::post('/admin/dashboard/berlanganan/simpan', [DashboardController::class, 'simpan']);
    Route::get('/admin/dashboard/berlanganan/edit/{id}', [DashboardController::class, 'show'])->name('admin.berlanganan.show');
    Route::put('/admin/berlanganan/{id}', [DashboardController::class, 'update'])->name('admin.berlanganan.update');
    Route::delete('/admin/berlanganan/hapus/{id}', [DashboardController::class, 'destroy'])->name('admin.berlanganan.destroy');
    Route::get('/admin/dashboard/berlangganan', [DashboardController::class, 'listBerlangganan'])->name('admin.dashboard.berlangganan');
    Route::get('/admin/dashboard/member', [DashboardController::class, 'listMember'])->name('admin.dashboard.member');
    Route::get('/admin/bootcamp', [BootcampController::class, 'index'])->name('admin.bootcamp.index');
    Route::get('/admin/bootcamp/list', [BootcampController::class, 'list'])->name('admin.bootcamp.list');
    Route::get('/admin/bootcamp/edit/{id}', [BootcampController::class, 'show'])->name('admin.bootcamp.show');
    Route::put('/admin/bootcamp/{id}', [BootcampController::class, 'update'])->name('admin.bootcamp.update');
    Route::delete('/admin/bootcamp/edit/{id}', [BootcampController::class, 'destroy'])->name('admin.bootcamp.destroy');
    Route::get('/admin/bootcamp/tambah', [BootcampController::class, 'tambah'])->name('bootcamp.php');
    Route::post('/admin/bootcamp/simpan', [BootcampController::class, 'simpan'])->name('bootcamp.store');
});

// Untuk Member
Route::middleware(['auth', 'member', 'verified'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/exportPdf', [MemberDashboardController::class, 'exportPdf'])->middleware('subscription:business,enterprise,trial')->name('dashboard.exportPdf');
    Route::get('/dashboard/list', [MemberDashboardController::class, 'list'])->name('dashboard.list');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/list', [TransaksiController::class, 'list'])->name('transaksi.list');
    Route::get('/transaksi/tambah', [TransaksiController::class, 'tambah']);
    Route::post('/transaksi/tambah/simpan', [TransaksiController::class, 'simpan']);
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'show'])->name('transaksi.edit');
    Route::put('/transaksi/edit/simpan/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/tambah/hapus/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/hutangPiutang', [HutangPiutangController::class, 'index'])->name('hutangPiutang.index');
    Route::get('/hutangPiutang/list', [HutangPiutangController::class, 'list'])->name('hutangPiutang.list');
    Route::get('/hutangPiutang/tambah', [HutangPiutangController::class, 'tambah']);
    Route::post('/hutangPiutang/simpan', [HutangPiutangController::class, 'simpan']);
    Route::get('/hutangPiutang/edit/{id}', [HutangPiutangController::class, 'show'])->name('hutangPiutang.edit');
    Route::put('/hutangPiutang/edit/simpan/{id}', [HutangPiutangController::class, 'update'])->name('hutangPiutang.update');
    Route::delete('/hutangPiutang/hapus/{id}', [HutangPiutangController::class, 'destroy'])->name('hutangPiutang.destroy');
    Route::get('/bootcamp', [MemberBootcampController::class, 'index'])->name('bootcamp.index');
    Route::get('/bootcamp/search-filter', [MemberBootcampController::class, 'searchAndFilter'])->name('bootcamp.searchAndFilter');
    Route::get('/berlangganan', [BerlanggananController::class, 'index']);
    Route::get('/akunSaya', [AkunSayaController::class, 'index'])->name('akunSaya.index');
    Route::post('/akunSaya/update-password', [AkunSayaController::class, 'updatePassword'])->name('akunSaya.updatePassword');
    Route::get('/balabot', [BalabotController::class, 'index'])->middleware('subscription:pro,business,enterprise,trial');
});
