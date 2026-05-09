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
	<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

	{{-- My Font Awasome --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
	<!-- Sidebar -->
	<nav class="sidebar" id="sidebar">
		<div class="sidebar-header">
			<a href="/admin/dashboard" class="logo">
				<img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="120">
			</a>
		</div>

		<div class="sidebar-menu">
			<div class="menu-label">Utama</div>
			<a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
				<i class="bi bi-speedometer2"></i>
				<span>Dashboard</span>
			</a>
			<a href="/admin/bootcamp" class="nav-link {{ request()->is('admin/bootcamp*') ? 'active' : '' }}">
				<i class="bi bi-mortarboard"></i>
				<span>Bootcamp</span>
			</a>
		</div>

		<div class="sidebar-footer">
			<a class="btn-logout" href="/admin/logout">
				<i class="bi bi-box-arrow-right me-2"></i>
				Keluar
			</a>
		</div>
	</nav>

	<!-- Main Content -->
	<div class="main-content">
		<!-- Top Navbar -->
		<nav class="top-navbar">
			<button class="btn d-lg-none" type="button" onclick="toggleSidebar()">
				<i class="bi bi-list fs-4"></i>
			</button>
			<div class="navbar-title">@yield('sub-title')</div>
		</nav>

		<main class="content-area">
			@yield('konten')
		</main>
	</div>

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
</body>

</html>
