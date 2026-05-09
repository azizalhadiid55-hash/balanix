@extends('layouts.mainTemplateMember')

@section('title', 'Dashboard')
@section('sub-title', 'Dashboard')

@section('konten')
	<div class="d-flex">
		{{-- Tombol Filter --}}
		<div class="select">
			<div class="input-group">
				<select class="form-select filter-dashboard" id="selectHari">
					<option value="">Semua Waktu</option>
					<option value="today">Hari ini</option>
					<option value="month">Bulan ini</option>
					<option value="year">Tahun ini</option>
				</select>
				<label class="input-group-text" for="selectHari">
					<i class="bi bi-calendar-event"></i>
				</label>
			</div>
		</div>
		@if (in_array(Auth::user()->getLatestActiveSubscription()?->paket, ['BUSINESS', 'ENTERPRISE']) ||
				(Auth::user()->isOnTrial() && !Auth::user()->getLatestActiveSubscription()))
			{{-- Tombol Export PDF --}}
			<div class="ms-4">
				<button class="btn-primary-custom" style="background-color: rgb(187, 21, 21) !important;">
					<a href="{{ route('dashboard.exportPdf') }}" style="color: white; text-decoration: none">
						<i class="bi bi-file-earmark-pdf"></i>
						<span>Export PDF</span>
					</a>
				</button>
			</div>
		@endif
	</div>


	{{-- Grafik --}}
	<div class="metric-cards">
		<!-- Kas & Bank -->
		<div class="data-table-card">
			<div class="table-header">
				<h3 class="table-title">Kas & Bank</h3>
			</div>
			<!-- wrapper dengan tinggi fix -->
			<div class="p-4" style="height:300px;">
				<canvas id="kasBankChart"></canvas>
			</div>
		</div>

		<!-- Hutang Piutang -->
		<div class="data-table-card">
			<div class="table-header">
				<h3 class="table-title">Hutang Piutang</h3>
			</div>
			<div class="p-4" style="height:300px;">
				<canvas id="hutangPiutangChart"></canvas>
			</div>
		</div>
	</div>

	<!-- Load Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script>
		// Kas & Bank (Line Chart)
		const ctxKas = document.getElementById('kasBankChart').getContext('2d');
		new Chart(ctxKas, {
			type: 'line',
			data: {
				labels: @json($bulanLabels),
				datasets: [{
						label: 'Pemasukan',
						data: @json($pemasukanData),
						borderColor: '#FACC15',
						backgroundColor: '#FACC15',
						tension: 0.4
					},
					{
						label: 'Pengeluaran',
						data: @json($pengeluaranData),
						borderColor: '#6366F1',
						backgroundColor: '#6366F1',
						tension: 0.4
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: {
						position: 'top'
					}
				},
				scales: {
					y: {
						beginAtZero: true,
						ticks: {
							callback: (value) => 'Rp. ' + value.toLocaleString()
						}
					}
				}
			}
		});

		// Hutang Piutang (Bar Chart)
		const ctxHP = document.getElementById('hutangPiutangChart').getContext('2d');
		new Chart(ctxHP, {
			type: 'bar',
			data: {
				labels: @json($bulanLabels),
				datasets: [{
						label: 'Hutang',
						data: @json($hutangData),
						backgroundColor: '#FACC15',
					},
					{
						label: 'Piutang',
						data: @json($piutangData),
						backgroundColor: '#6366F1',
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: {
						position: 'top'
					}
				},
				scales: {
					y: {
						beginAtZero: true,
						ticks: {
							callback: (value) => 'Rp. ' + value.toLocaleString()
						}
					}
				}
			}
		});
	</script>

	<!-- Data Table -->
	<div class="data-table-card">
		<div class="table-header">
			<h2 class="table-title">Daftar Transaksi</h2>
			<button class="btn-primary-custom">
				<a href="/transaksi/tambah" style="color: white; text-decoration: none">
					<i class="bi bi-plus-circle"></i>
					<span>Tambah Transaksi</span>
				</a>
			</button>
		</div>

		<div class="table-controls">
			<div class="search-wrapper">
				<div class="search-box">
					<i class="bi bi-search"></i>
					<input type="text" placeholder="Cari..." class="search-input search-dashboard">
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="custom-table">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Tanggal</th>
						<th>Pembayaran</th>
						<th>Jenis Transaksi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="dashboard-rows">
					@include('member.partials.dashboard_rows')
				</tbody>
			</table>

			{{-- Untuk Alert Hapus Data --}}
			{{-- SweetAlert2 CDN --}}
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					const hapusForms = document.querySelectorAll('.form-hapus');

					hapusForms.forEach(form => {
						form.addEventListener('submit', function(e) {
							e.preventDefault(); // cegah submit langsung

							Swal.fire({
								title: 'Apakah kamu yakin?',
								text: "Data transaksi akan dihapus permanen!",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#d33',
								cancelButtonColor: '#6c757d',
								confirmButtonText: 'Ya, hapus!',
								cancelButtonText: 'Batal'
							}).then((result) => {
								if (result.isConfirmed) {
									form.submit(); // Submit form jika user setuju
								}
							});
						});
					});
				});
			</script>
		</div>

		<div class="pagination-wrapper pagination-wrapper-dashboard">
			<div class="pagination-info" id="dashboard-info">
				@include('member.partials.dashboard_info')
			</div>
			@include('member.partials.dashboard_pagination')
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const input = document.querySelector('.search-dashboard');
			const select = document.querySelector('.filter-dashboard');
			const rowsEl = document.getElementById('dashboard-rows');
			const infoEl = document.getElementById('dashboard-info');
			const wrapper = document.querySelector('.pagination-wrapper-dashboard');

			let debounce;
			const debounceMs = 250;

			function fetchList(url) {
				const u = new URL(url, window.location.origin);
				if (input.value) u.searchParams.set('q', input.value);
				if (select.value) u.searchParams.set('filter', select.value);

				fetch(u.toString(), {
						headers: {
							'X-Requested-With': 'XMLHttpRequest'
						}
					})
					.then(r => r.json())
					.then(data => {
						rowsEl.innerHTML = data.rows;
						const currentUl = wrapper.querySelector('#pagination-dashboard');
						const temp = document.createElement('div');
						temp.innerHTML = data.pagination.trim();
						const newUl = temp.firstElementChild;
						if (currentUl && newUl) currentUl.replaceWith(newUl);
						infoEl.innerHTML = data.info;
					})
					.catch(console.error);
			}

			if (input) {
				input.addEventListener('input', () => {
					clearTimeout(debounce);
					debounce = setTimeout(() => fetchList('{{ route('dashboard.list') }}'), debounceMs);
				});
			}

			if (select) {
				select.addEventListener('change', () => {
					fetchList('{{ route('dashboard.list') }}');
				});
			}

			if (wrapper) {
				wrapper.addEventListener('click', (e) => {
					const a = e.target.closest('a.page-link');
					if (!a) return;
					e.preventDefault();
					fetchList(a.dataset.ajax);
				});
			}
		});
	</script>

@endsection
