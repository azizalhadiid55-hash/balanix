@extends('auth.mainTemplateAuth')

@section('title', 'Masuk')

@section('konten')
	<div class="d-flex justify-content-center align-items-center min-vh-100  ">
		<div class="d-flex justify-content-center align-items-center flex-column flex-md-row px-3 px-sm-0">
			<div class="card shadow-lg border-0 rounded-4  pt-4 pt-sm-0" style="max-width: 600px; width:100%; ">
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
					<h4 class="auth-title">Masuk ke Akun Anda!</h4>
					<p class="text-muted mb-4">
						Belum Mempunyai Akun? <a href="/register" class="fw-semibold text-decoration-none">Daftar Akun</a>
					</p>

					<!-- Form -->
					<form method="POST" action="/login">
						@csrf
						<div class="mb-3 text-start input-field">
							<label class="form-label" for="email">Email Perusahaan/UMKM</label>
							<input type="email" class="form-control rounded-3" placeholder="Masukkan email perusahaan/UMKM" id="email"
								name="email" required autofocus>
						</div>

						<div class="mb-2 text-start input-field">
							<label class="form-label" for="password">Password Akun</label>
							<input type="password" class="form-control rounded-3" placeholder="Masukkan password akun" id="password"
								name="password" required>
						</div>

						<div class="d-flex justify-content-between align-items-center mb-4 input-field">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember">
								<label class="form-check-label small" for="rememberMe">Ingatkan Saya</label>
							</div>
							<a href="/forgot-password" class="small text-decoration-none">Lupa Password ?</a>
						</div>

						<button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
							Masuk Akun
						</button>

						<div class="mt-2 text-center">
							<p class="mb-2">Atau</p>
							<a href="{{ route('google.login') }}">
								<button type="button" class="login-with-google-btn">
									Masuk dengan akun Google
								</button>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
