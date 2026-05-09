@extends('auth.mainTemplateAuth')

@section('title', 'Daftar Akun')

@section('konten')
	<div class="d-flex justify-content-center align-items-center min-vh-100  ">
		<div class="d-flex justify-content-center align-items-center flex-column flex-md-row  w-100 mx-3 mx-sm-0">
			<div class="card shadow-lg border-0 rounded-4   pt-4 pt-sm-0" style="max-width: 600px; width:100%; ">
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
					<h4 class="auth-title">Buat Akun Anda!</h4>
					<p class="text-muted mb-4">
						Sudah Mempunyai Akun? <a href="/login" class="fw-semibold text-decoration-none">Masuk</a>
					</p>

					<!-- Form -->
					<form method="POST" action="{{ url('/register/create') }}">
						@csrf
						<div class="mb-3 text-start input-field">
							<label class="form-label" for="name">Nama Perusahan/UMKM</label>
							<input type="text" class="form-control rounded-3" placeholder="Masukkan nama perusahaan/UMKM" id="name"
								name="name" required autofocus>
						</div>

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

						<div class="mb-2 text-start input-field">
							<label class="form-label" for="password_confirmation">Konfirmasi Password Akun</label>
							<input type="password" class="form-control rounded-3" placeholder="Tulis ulang password akun Anda!"
								id="password_confirmation" name="password_confirmation" required>
						</div>

						<button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold mt-4">
							Buat Akun
						</button>
					</form>
				</div>
			</div>
		</div>
	@endsection
