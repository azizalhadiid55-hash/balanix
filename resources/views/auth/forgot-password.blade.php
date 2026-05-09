@extends('auth.mainTemplateAuth')

@section('title', 'Lupa Password')

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
            <div class="mb-3 mt-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="120">
            </div>

            <!-- Judul -->
            <h4 class="auth-title">Lupa Password!</h4>
            <p class="text-muted mb-4">
                Jangan khawatir, kami akan mengirimkan email reset password.
            </p>

            <!-- Form -->
            <form method="POST" action="/forgot-password">
                @csrf

                <div class="mb-3 text-start input-field">
                    <label class="form-label">Email Perusahaan/UMKM</label>
                    <input type="email" class="form-control rounded-3" placeholder="Masukkan email perusahaan/UMKM" name="email" required> 
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold mt-4">
                    Kirim Email
                </button>
            </form>

            <div>
                <p class="text-muted mt-4">
                    Kembali ke halaman? <a href="/login" class="fw-semibold text-decoration-none">Masuk</a>
                </p>
                <p class="text-muted" style="margin-top: -10px">
                    Belum Mempunyai Akun? <a href="/register" class="fw-semibold text-decoration-none">Daftar Akun</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
