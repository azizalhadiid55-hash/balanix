@php
	use Carbon\Carbon;
@endphp

@extends('layouts.mainTemplateMember')

@section('title', 'Akun Saya')
@section('sub-title', 'Akun Saya')

@section('konten')
	<div class="row">
		<div class="col-12">
			<h3 style="color: #333333; font-size: 24px; font-weight: bold">Pengaturan Akun Perusahaan</h3>
			<p style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Detail Profil Akun Perusahaan</p>
		</div>
	</div>

	<div class="card shadow-sm rounded-3 overflow-hidden">
		<div class="card-body p-4">
			<div class="row g-4 mb-3" style="width: 50%; margin: 0 auto;">
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

			<div class="row g-4">
				{{-- Data Profile Perusahaan --}}
				<div class="col-12 col-md-6">
					<h5 class="fw-bold text-dark mb-3">Data Profile Perusahaan</h5>
					<form>
						<div class="mb-3">
							<label for="namaPerusahaan" class="form-label text-muted">Nama Perusahaan / UMKM</label>
							<input type="text" class="form-control" id="namaPerusahaan" value="{{ $user->name }}" disabled>
						</div>
						<div class="mb-3">
							<label for="emailPerusahaan" class="form-label text-muted">Email Perusahaan / UMKM</label>
							<input type="email" class="form-control" id="emailPerusahaan" value="{{ $user->email }}" disabled>
						</div>
						<div class="mb-3">
							<label for="paketLangganan" class="form-label text-muted">Paket Langganan</label>
							@php
								$paketValue = 'Belum Berlangganan';

								if (Auth::user()->isOnTrial() && !$subcription) {
								    $paketValue = 'Trial 7 Hari | Expired: ' . Carbon::parse(Auth::user()->trial_expired_at)->diffForHumans();
								} elseif (!Auth::user()->isOnTrial() && $subcription) {
								    $paketValue =
								        $subcription->paket . ' | Expired: ' . Carbon::parse($subcription->expired_at)->diffForHumans();
								} elseif (Auth::user()->isOnTrial() && $subcription) {
								    $paketValue =
								        $subcription->paket . ' | Expired: ' . Carbon::parse($subcription->expired_at)->diffForHumans();
								}
							@endphp

							<input type="text" class="form-control" id="paketLangganan" value="{{ $paketValue }}" disabled>
						</div>
					</form>
				</div>

				{{-- Ganti Password --}}
				<div class="col-12 col-md-6" style="border-left: 1px solid black" id="gantiPassword">
					<h5 class="fw-bold text-dark mb-3">Ganti Password</h5>
					<form action="{{ route('akunSaya.updatePassword') }}" method="POST">
						@csrf
						<div class="mb-3">
							<label for="passwordLama" class="form-label text-muted">Password Lama</label>
							<input type="password" class="form-control" id="passwordLama" name="password_lama" placeholder="********">
						</div>
						<div class="mb-3">
							<label for="passwordBaru" class="form-label text-muted">Password Baru</label>
							<input type="password" class="form-control" id="passwordBaru" name="password_baru" placeholder="********">
						</div>
						<div class="mb-4">
							<label for="konfirmasiPassword" class="form-label text-muted">Konfirmasi Password Baru</label>
							<input type="password" class="form-control" id="konfirmasiPassword" name="password_baru_confirmation"
								placeholder="********">
						</div>
						<div class="d-flex justify-content-end gap-2">
							<button type="button" class="btn btn-outline-primary">Batal</button>
							<button type="submit" class="btn btn-primary">Simpan Password Baru</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<style>
		.card {
			border: 1px solid #e5e7eb;
			border-radius: 12px;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
		}

		.form-control {
			background-color: #f3f4f6;
			border: 1px solid #e5e7eb;
			border-radius: 8px;
			padding: 10px 14px;
			color: #4b5563;
		}

		.form-control:focus {
			background-color: #ffffff;
			border-color: #4f46e5;
			box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
		}

		.form-label {
			font-size: 14px;
			font-weight: 500;
		}

		.btn-primary {
			background-color: #4f46e5;
			border-color: #4f46e5;
			color: white;
			font-weight: 500;
		}

		.btn-primary:hover {
			background-color: #4338ca;
			border-color: #4338ca;
		}

		.btn-outline-primary {
			color: #4f46e5;
			border-color: #4f46e5;
			font-weight: 500;
		}

		.btn-outline-primary:hover {
			background-color: #4f46e5;
			color: white;
		}
	</style>

	<script>
		function updateBorder() {
			const gantiPasswordDiv = document.getElementById('gantiPassword');
			if (window.innerWidth < 768) {
				gantiPasswordDiv.style.borderLeft = 'none';
				gantiPasswordDiv.style.borderTop = '1px solid #e5e7eb';
				gantiPasswordDiv.style.paddingTop = '1.5rem';
				gantiPasswordDiv.style.marginTop = '1.5rem';
			} else {
				gantiPasswordDiv.style.borderLeft = '1px solid #e5e7eb';
				gantiPasswordDiv.style.borderTop = 'none';
			}
		}

		// Jalankan saat halaman dimuat
		window.addEventListener('load', updateBorder);
		// Jalankan setiap kali ukuran jendela diubah
		window.addEventListener('resize', updateBorder);
	</script>
@endsection
