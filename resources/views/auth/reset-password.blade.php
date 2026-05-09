@extends('auth.mainTemplateAuth')

@section('title', 'Daftar Akun')

@section('konten')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 600px; width:100%;">
        <div class="card-body p-4 p-md-5 text-center">
            <div class="row g-4">
                {{-- Jika Ada Error --}}
                @if ($errors->any())
                <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert" style="width: 100%">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        <div class="text-start">
                            @foreach ($errors->all() as $error)
                            <p class="m-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Jika Sukses Login --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="width: 100%">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Jika Password Telah Diubah --}}
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="width: 100%">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <!-- Logo -->
            <div class="mb-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="120">
            </div>

            <!-- Judul -->
            <h4 class="auth-title">Reset Password Anda!</h4>
            <p class="text-muted mb-4">
                Kembali ke halaman? <a href="/login" class="fw-semibold text-decoration-none">Masuk</a>
            </p>

            <!-- Form -->
            <form method="POST" action="/reset-password">
                @csrf
                <div class="mb-3 text-start input-field">
                    <input id="token" type="hidden" name="token" class="form-control"
                                    value="{{ request()->route('token') }}">
                    <div class="text-danger small"></div>
                </div>

                <div class="mb-3 text-start input-field">
                    <label class="form-label">Email Perusahaan/UMKM</label>
                    <input type="email" class="form-control rounded-3" placeholder="Masukkan email perusahaan/UMKM" name="email" required>
                </div>

                <div class="mb-2 text-start input-field">
                    <label class="form-label">Password Akun Baru</label>
                    <input type="password" class="form-control rounded-3" placeholder="Masukkan password akun baru" name="password" required>
                </div>

                <div class="mb-2 text-start input-field">
                    <label class="form-label">Konfirmasi Password Akun Baru</label>
                    <input type="password" class="form-control rounded-3" placeholder="Tulis ulang password akun Anda!" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold mt-4">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
