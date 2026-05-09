@extends('layouts.mainTemplateMember')

@section('title', 'Bootcamp')
@section('sub-title', 'Bootcamp')

@section('konten')
	<div class="header-bootcamp mb-4">
		<h3 class="fw-bold text-dark">Bootcamp Pengembangan UMKM</h3>
		<p class="text-secondary" style="font-size: 15px">Halaman Ini Membantumu Mengakses Dan Mengikuti Perkembangan Kelas
			Bootcamp. Mulai Jelajahi Dan Pastikan Kamu Tetap Terhubung! </p>
	</div>

	<div class="search-filter-section mb-4">
		<div class="row align-items-center">
			<div class="col-md-6 mb-3 mb-md-0">
				<div class="search-box">
					<i class="bi bi-search"></i>
					<input type="text" class="search-input" placeholder="Cari..." id="searchInput">
				</div>
			</div>
			<div class="col-md-6">
				<div class="d-flex flex-wrap justify-content-md-end gap-2" id="filterButtons">
					<button class="btn btn-sm btn-outline-primary active" data-jenis="Semua">Semua</button>
					@foreach ($jenisBootcamp as $jenis)
						<button class="btn btn-sm btn-outline-primary" data-jenis="{{ $jenis }}">{{ $jenis }}</button>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div class="bootcamp-list">
		<div class="row g-4" id="bootcampContainer">
			@forelse($bootcamps as $bootcamp)
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card h-100">
						<img src="{{ asset('storage/' . $bootcamp->preview) }}" class="card-img-top" alt="Bootcamp image">
						<div class="card-body d-flex flex-column">
							<span class="badge bg-light text-primary mb-2">Eksploratif & informatif</span>
							<h5 class="card-title fw-bold text-dark">{{ $bootcamp->nama_bootcamp }}</h5>
							<p class="card-subtitle text-muted mb-2 small">
								<i class="bi bi-folder me-1"></i> {{ $bootcamp->jenis_bootcamp }}
							</p>
							<p class="card-subtitle text-muted mb-2 small">
								<i class="bi bi-calendar-date-fill me-1"></i>
								{{ \Carbon\Carbon::parse($bootcamp->pelaksanaan)->translatedFormat('d M Y') }}
							</p>
							<p class="card-text small text-secondary flex-grow-1">{{ Str::limit($bootcamp->deskripsi, 100) }}</p>
							<a href="{{ $bootcamp->link }}" class="btn btn-primary btn-sm mt-3" target="_blank"
								rel="noopener noreferrer">Daftar</a>
						</div>
					</div>
				</div>
			@empty
				<div class="col-12 text-center">
					<p class="text-muted">Maaf, bootcamp tidak ditemukan.</p>
				</div>
			@endforelse
		</div>
	</div>

	<style>
		.search-box {
			position: relative;
		}

		.search-box i {
			position: absolute;
			left: 12px;
			top: 50%;
			transform: translateY(-50%);
			color: #9ca3af;
		}

		.search-input {
			width: 100%;
			padding: 8px 12px 8px 36px;
			border: 1px solid #e5e7eb;
			border-radius: 8px;
			font-size: 14px;
			color: #374151;
			background: #f9fafb;
			transition: all 0.2s ease;
		}

		.search-input:focus {
			outline: none;
			border-color: #4f46e5;
			background: white;
			box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
		}

		.btn-outline-primary {
			color: #4f46e5;
			border-color: #4f46e5;
		}

		.btn-outline-primary:hover,
		.btn-outline-primary.active {
			background-color: #4f46e5;
			color: white;
		}

		.card {
			border: 1px solid #e5e7eb;
			border-radius: 12px;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
			transition: transform 0.2s ease-in-out;
			overflow: hidden;
		}

		.card:hover {
			transform: translateY(-5px);
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
		}

		.card-img-top {
			border-top-left-radius: 12px;
			border-top-right-radius: 12px;
			height: 200px;
			/* Menetapkan tinggi tetap untuk gambar */
			object-fit: cover;
			/* Memastikan gambar terpotong agar pas */
		}

		.card-body {
			padding: 16px;
		}

		.card-title {
			font-size: 16px;
			min-height: 48px;
			/* Memberikan tinggi minimum agar judul tidak bergeser */
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.card-subtitle {
			font-size: 12px;
		}

		.badge {
			background-color: #eef2ff !important;
			color: #4f46e5 !important;
			font-weight: 500;
		}
	</style>

	{{-- Tambahkan script JavaScript untuk fungsionalitas pencarian dan filter AJAX --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			// Function untuk mengambil dan menampilkan data bootcamp
			function fetchBootcamps(jenis = '', search = '') {
				$.ajax({
					url: '{{ route('bootcamp.searchAndFilter') }}', // Gunakan route yang baru
					type: 'GET',
					data: {
						jenis: jenis,
						search: search
					},
					success: function(data) {
						$('#bootcampContainer').html($(data).find('#bootcampContainer').html());
					},
					error: function(xhr, status, error) {
						console.error("Error fetching bootcamps:", error);
					}
				});
			}

			// Event listener untuk tombol filter
			$('#filterButtons .btn').on('click', function() {
				$('#filterButtons .btn').removeClass('active');
				$(this).addClass('active');

				let jenis = $(this).data('jenis');
				let search = $('#searchInput').val();
				fetchBootcamps(jenis, search);
			});

			// Event listener untuk input pencarian
			$('#searchInput').on('keyup', function() {
				let search = $(this).val();
				let jenis = $('#filterButtons .btn.active').data('jenis');
				fetchBootcamps(jenis, search);
			});
		});
	</script>
@endsection
