<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<!-- Favicons -->
	<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
	<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- My Style Css -->
	<link href="{{ asset('assets/css/member.css') }}" rel="stylesheet">

	{{-- My Font Awasome --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
	@yield('css')
</head>

<body>
	@if (!Auth::user()->getLatestActiveSubscription() && !Auth::user()->isOnTrial())
		<div class="overlay-not-subcribed">
			<div style="display: flex; flex-direction: column;">
				<p style="color: red;">Anda belum berlangganan, silahkan hubungi admin.</p>
				@php
					$message = '';
					$message = "Halo, saya ingin berlangganan Balanix. Berikut ini detail akun saya:\n\n";
					$message .= 'ID User: ' . Auth::user()->id . "\n";
					$message .= 'Nama: ' . Auth::user()->name . "\n";
					$message .= 'Email: ' . Auth::user()->email . "\n";
					$message .= "\nMohon informasinya, terima kasih.";
				@endphp
				<a href="https://wa.me/6287860625673?text={{ urlencode($message) }}" target="_blank" class="btn btn-primary">Hubungi
					Admin</a>
			</div>
		</div>
	@endif
	<!-- Sidebar -->
	<nav class="sidebar" id="sidebar">
		<div class="sidebar-header">
			<a href="/dashboard" class="logo">
				<img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="120">
			</a>
		</div>

		<div class="sidebar-menu">
			{{-- Utama --}}
			<div class="menu-label">Utama</div>
			<a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
				<i class="bi bi-speedometer2"></i>
				<span>Dashboard</span>
			</a>
			<a href="/transaksi" class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
				<i class="bi bi-cash-coin"></i>
				<span>Transaksi</span>
			</a>
			<a href="/hutangPiutang" class="nav-link {{ request()->is('hutangPiutang*') ? 'active' : '' }}">
				<i class="bi bi-database"></i>
				<span>Hutang Piutang</span>
			</a>
			<a href="/bootcamp" class="nav-link {{ request()->is('bootcamp*') ? 'active' : '' }}">
				<i class="bi bi-people-fill"></i>
				<span>Bootcamp</span>
			</a>
			<a href="/balabot" class="nav-link {{ request()->is('balabot*') ? 'active' : '' }}">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-claude"
					viewBox="0 0 16 16">
					<path
						d="m3.127 10.604 3.135-1.76.053-.153-.053-.085H6.11l-.525-.032-1.791-.048-1.554-.065-1.505-.08-.38-.081L0 7.832l.036-.234.32-.214.455.04 1.009.069 1.513.105 1.097.064 1.626.17h.259l.036-.105-.089-.065-.068-.064-1.566-1.062-1.695-1.121-.887-.646-.48-.327-.243-.306-.104-.67.435-.48.585.04.15.04.593.456 1.267.981 1.654 1.218.242.202.097-.068.012-.049-.109-.181-.9-1.626-.96-1.655-.428-.686-.113-.411a2 2 0 0 1-.068-.484l.496-.674L4.446 0l.662.089.279.242.411.94.666 1.48 1.033 2.014.302.597.162.553.06.17h.105v-.097l.085-1.134.157-1.392.154-1.792.052-.504.25-.605.497-.327.387.186.319.456-.045.294-.19 1.23-.37 1.93-.243 1.29h.142l.161-.16.654-.868 1.097-1.372.484-.545.565-.601.363-.287h.686l.505.751-.226.775-.707.895-.585.759-.839 1.13-.524.904.048.072.125-.012 1.897-.403 1.024-.186 1.223-.21.553.258.06.263-.218.536-1.307.323-1.533.307-2.284.54-.028.02.032.04 1.029.098.44.024h1.077l2.005.15.525.346.315.424-.053.323-.807.411-3.631-.863-.872-.218h-.12v.073l.726.71 1.331 1.202 1.667 1.55.084.383-.214.302-.226-.032-1.464-1.101-.565-.497-1.28-1.077h-.084v.113l.295.432 1.557 2.34.08.718-.112.234-.404.141-.444-.08-.911-1.28-.94-1.44-.759-1.291-.093.053-.448 4.821-.21.246-.484.186-.403-.307-.214-.496.214-.98.258-1.28.21-1.016.19-1.263.112-.42-.008-.028-.092.012-.953 1.307-1.448 1.957-1.146 1.227-.274.109-.477-.247.045-.44.266-.39 1.586-2.018.956-1.25.617-.723-.004-.105h-.036l-4.212 2.736-.75.096-.324-.302.04-.496.154-.162 1.267-.871z" />
				</svg>
				<span>Balabot</span>
			</a>
			@if (Auth::user()->getLatestActiveSubscription()?->paket === 'ENTERPRISE' ||
					(Auth::user()->isOnTrial() && !Auth::user()->getLatestActiveSubscription()))
				@php
					$message = '';
					$message .= "Halo, saya ingin konsultasi bisnis. Berikut ini detail akun saya:\n\n";
					$message .= 'ID User: ' . Auth::user()->id . "\n";
					$message .= 'Nama: ' . Auth::user()->name . "\n";
					$message .= 'Email: ' . Auth::user()->email . "\n";
					$message .= "\nMohon informasinya, terima kasih.";
				@endphp
				<a href="https://wa.me/6287860625673?text={{ urlencode($message) }}" target="_blank"
					class="nav-link {{ request()->is('konsultasi*') ? 'active' : '' }}">
					<i class="bi bi-chat-dots-fill"></i>
					<span>Konsultasi Bisnis</span>
				</a>
			@endif

			{{-- Pendukung --}}
			<div class="menu-label mt-3">Pendukung</div>
			<a href="/berlangganan" class="nav-link {{ request()->is('berlangganan*') ? 'active' : '' }}">
				<i class="bi bi-cart-fill"></i>
				<span>Berlangganan</span>
			</a>
			<a href="/akunSaya" class="nav-link {{ request()->is('akunSaya*') ? 'active' : '' }}">
				<i class="bi bi-person-circle"></i>
				<span>Akun Saya</span>
			</a>
		</div>

		<div class="sidebar-footer">
			<a class="btn-logout" href="/logout">
				<i class="bi bi-box-arrow-right me-2"></i>
				Keluar
			</a>
		</div>
	</nav>

	<!-- Main Content -->
	<div class="main-content">
		<!-- Top Navbar -->
		<nav class="top-navbar">
			<button class="btn btn-hamburger" type="button" onclick="toggleSidebar()">
				<i class="bi bi-list fs-4"></i>
			</button>
			<div class="navbar-title">@yield('sub-title')</div>
		</nav>

		<main class="content-area">
			@yield('konten')
		</main>
	</div>

	@yield('js')

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<script>
		function toggleSidebar() {
			const sidebar = document.getElementById('sidebar');
			sidebar.classList.toggle('show');
		}

		// Close sidebar when clicking outside on mobile
		document.addEventListener('click', function(event) {
			const sidebar = document.getElementById('sidebar');
			const toggleBtn = event.target.closest('[onclick="toggleSidebar()"]');

			if (!sidebar.contains(event.target) && !toggleBtn && window.innerWidth <= 768) {
				sidebar.classList.remove('show');
			}
		});
	</script>

	@session('error')
		<script>
			alert("{{ session('error') }}");
		</script>
	@endsession
</body>

</html>
