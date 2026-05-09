<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Balanix</title>

	<!-- Favicons -->
	<link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
	<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

	<!-- CDN Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- My Style Css -->
	<link href="{{ asset('assets/css/welcome.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/footerMainMobile.css') }}">
	{{-- My Font Awasome --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top">
		<div class="container">
			<a class="navbar-brand" href="/">
				<img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 40px; width: auto;">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#beranda" style="font-size: 16px">Beranda</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#fitur" style="font-size: 16px">Fitur</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#layanan" style="font-size: 16px">Layanan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#harga" style="font-size: 16px">Harga</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#testimonial" style="font-size: 16px">Testimonial</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#faq" style="font-size: 16px">FAQ</a>
					</li>
				</ul>

				<a href="/login" class="btn btn-primary-custom text-white d-lg-inline-block d-block mt-lg-0 mt-3">Ayo
					Mulai</a>
			</div>
		</div>
	</nav>

	<!-- Hero Section -->
	<section class="hero-section" id="beranda">
		<div class="container hero-countainer">
			<div class="row align-items-center ">
				<div class="col-lg-6">
					<h1 class="hero-title">Catat, pelajari,</h1>
					<h1 class="hero-subtitle">kembangkan bisnismu</h1>
					<p class="hero-description">
						Apakah kamu siap membawa UMKM-mu naik level? Mulai dari pencatatan penjualan hingga laporan
						keuangan otomatis.
					</p>
					<a href="/register" class="btn-daftar">Daftar</a>
				</div>

				<div class="col-lg-6 text-end">
					<div class="hero-image">
						<img src="{{ asset('assets/img/illustration1.png') }}" alt="Hero Image" class="img-fluid"
							style="height: auto; width: 80%">
					</div>
				</div>
			</div>
		</div>

		{{-- Mobile --}}
		<div class=" container hero-countainer-mobile px-4">
			<div class="row align-items-center ">
				{{-- Title --}}
				<div>
					<h1 class=" font-bold text-center text-[#1e293b]" style="font-size: 36px;">Catat, pelajari,</h1>
					<h1 style="font-size: 30px;" class="font-bold text-center gradient-text pb-5">kembangkan
						bisnismu</h1>
				</div>
				{{-- Image --}}
				<div class="pb-5">
					<div class="hero-image  ">
						<div class="d-flex justify-content-center">
							<img src="{{ asset('assets/img/illustration1.png') }}" alt="Hero Image" class="  w-75 h-auto">
						</div>
					</div>
				</div>
				{{-- Description --}}
				<p class="hero-description text-center">
					Apakah kamu siap membawa UMKM-mu naik level? Mulai dari pencatatan penjualan hingga laporan
					keuangan otomatis.
				</p>
				<div>
					<a href="/register" class="btn-daftar">Daftar</a>
				</div>
			</div>
		</div>
	</section>

	{{-- Card Section --}}
	<section class="card-section" id="fitur">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center mb-5">
					<h2 class="section-title">Kelola seluruh pencatatan keuangan</h2>
					<h2 class="section-title">Anda dalam satu sistem</h2>
					<p class="section-subtitle">Apa saja fitur yang ada pada Balanix?</p>
				</div>
			</div>

			<div class="row g-4">
				<div class="col-lg-4 col-md-6">
					<div class="feature-card">
						<div class="card-icon pencatatan">
							<i class="bi bi-card-text"></i>
						</div>
						<h3 class="card-title">Pencatatan</h3>
						<p class="card-description">
							Sistem pencatatan penjualan kami membantu mengotomatiskan pencatatan transaksi, laporan
							keuangan, dan pengelolaan data pelanggan secara menyeluruh
						</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="feature-card">
						<div class="card-icon balabot">
							<i class="bi bi-lightning-charge"></i>
						</div>
						<h3 class="card-title">Balabot AI</h3>
						<p class="card-description">
							Balabot AI membantu mengotomatiskan pencatatan penjualan, pembuatan laporan keuangan, dan
							analisis bisnis— cukup lewat chat.
						</p>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="feature-card">
						<div class="card-icon kelas">
							<i class="bi bi-mortarboard-fill"></i>
						</div>
						<h3 class="card-title">Bootcamp</h3>
						<p class="card-description">
							Bootcamp kami menyediakan banyak materi mengenai UMKM, pengembangan Bisnis, dan Pengelolaan
							Keuangan.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Benefits Section -->
	<section class="benefits-section" id="layanan">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 mb-5 mb-lg-0">
					<div class="benefits-image text-center">
						<img src="{{ asset('assets/img/illustration2.png') }}" alt="Partnership Illustration" class="img-fluid"
							style="height: auto; width: 80%">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="benefits-content">
						<h2 class="benefits-title">Hal yang ada bisa raih jika berlangganan pada aplikasi kami</h2>

						<div class="benefits-list">
							<div class="benefit-item">
								<div class="benefit-icon">
									<i class="bi bi-check-circle-fill"></i>
								</div>
								<p class="benefit-text">Hemat waktu hingga 50% dalam pencatatan keuangan</p>
							</div>

							<div class="benefit-item">
								<div class="benefit-icon">
									<i class="bi bi-check-circle-fill"></i>
								</div>
								<p class="benefit-text">Kurangi kesalahan pencatatan hingga 90%.</p>
							</div>

							<div class="benefit-item">
								<div class="benefit-icon">
									<i class="bi bi-check-circle-fill"></i>
								</div>
								<p class="benefit-text">Akses dari berbagai perangkat tanpa instalasi.</p>
							</div>

							<div class="benefit-item">
								<div class="benefit-icon">
									<i class="bi bi-check-circle-fill"></i>
								</div>
								<p class="benefit-text">Dukungan pelanggan yang responsif dan profesional.</p>
							</div>
						</div>

						<a href="/register" class="btn-coba-gratis">Coba Gratis Sekarang</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Statistics Section -->
	<section class="py-5 bg-light">
		<div class="container">
			<div class="row align-items-center">
				<!-- Kiri -->
				<div class="col-lg-7 mb-4 mb-lg-0 text-center text-lg-start">
					<h3 class="fw-medium" style="color: #4D4D4D">
						Membantu bisnis lokal <br>
						<span style="color: #3A62FF">dalam hal pencatatan</span>
					</h3>
					<p class="text-muted mb-0">
						Kami sampai di sini dengan kerja keras dan dedikasi kami
					</p>
				</div>
				<!-- Kanan -->
				<div class="col-lg-5">
					<div class="row g-4">
						<div class="col-6 d-flex justify-content-center justify-content-lg-start text-center text-lg-start">
							<i class="bi bi-people-fill me-2" style="font-size: 2.2rem; color: #3A62FF"></i>
							<div>
								<h6 class="mb-0 fw-bold fs-5" style="color: #4D4D4D">2,245,341</h6>
								<small class="text-muted fs-6">Pengguna</small>
							</div>
						</div>

						<div class="col-6 d-flex justify-content-center justify-content-lg-start text-center text-lg-start">
							<i class="bi bi-bookmark-fill me-2" style="font-size: 2.2rem; color: #3A62FF"></i>
							<div>
								<h6 class="mb-0 fw-bold fs-5" style="color: #4D4D4D">120</h6>
								<small class="text-muted fs-6">Kelas</small>
							</div>
						</div>

						<div class="col-6 d-flex justify-content-center justify-content-lg-start text-center text-lg-start">
							<i class="bi bi-card-text me-2" style="font-size: 2.2rem; color: #3A62FF"></i>
							<div>
								<h6 class="mb-0 fw-bold fs-5" style="color: #4D4D4D">828,867</h6>
								<small class="text-muted fs-6">Pencatatan</small>
							</div>
						</div>

						<div class="col-6 d-flex justify-content-center justify-content-lg-start text-center text-lg-start">
							<i class="bi bi-wallet-fill me-2" style="font-size: 2.2rem; color: #3A62FF"></i>
							<div>
								<h6 class="mb-0 fw-bold fs-5" style="color: #4D4D4D">1,926,436</h6>
								<small class="text-muted fs-6">Pembayaran</small>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- Price --}}
	<section class="pricing-section" id="harga">
		<div class="container">
			<h2 class="pricing-title">Pilih paket sesuai kebutuhan bisnis anda</h2>
			<p class="pricing-subtitle">sesuaikan paket yang tepat untuk bisnis mu dengan harga yang terjangkau</p>

			<div class="row justify-content-center">
				<!-- Pro Plan -->
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="pricing-card">
						<div class="plan-icon pro">
							<i class="bi bi-moon-fill"></i>
						</div>
						<h3 class="plan-name">Pro</h3>
						<p class="plan-description">
							Dapatkan semua yang Anda butuhkan untuk mengelola bisnis dengan cerdas dan efisien! Mulai
							dari fitur basic yang solid, AI Smart Advisor yang siap membantu.
						</p>
						<div class="plan-price">Rp 29.000,00</div>
						<div class="plan-period">/Bulan</div>
						<a
							href="https://wa.me/6287860625673?text={{ urlencode('Halo, saya ingin berlangganan Balanix Pro. Mohon informasinya, terima kasih.') }}"
							target="_blank" class="pricing-btn btn-outline">Daftar sekarang</a>

						<div class="features-title">Apa yang didapatkan:</div>
						<ul class="features-list">
							<li><i class="bi bi-check"></i> Semua fitur basic</li>
							<li><i class="bi bi-check"></i> AI smart chatbot</li>
						</ul>
					</div>
				</div>

				<!-- Business Plan (Popular) -->
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="pricing-card popular">
						<div class="popular-badge">Popular</div>
						<div class="plan-icon business">
							<i class="bi bi-pause-fill" style="transform: rotate(90deg);"></i>
						</div>
						<h3 class="plan-name">Business</h3>
						<p class="plan-description">
							Kelola bisnis tanpa batas dengan semua fitur Pro yang dirancang untuk memberi Anda kendali
							penuh! Nikmati laporan keuangan mendetail untuk keputusan yang lebih cerdas.
						</p>
						<div class="plan-price">Rp 59.000,00</div>
						<div class="plan-period">/Bulan</div>
						<a
							href="https://wa.me/6287860625673?text={{ urlencode('Halo, saya ingin berlangganan Balanix Business. Mohon informasinya, terima kasih.') }}"
							target="_blank" class="pricing-btn btn-white">Daftar sekarang</a>

						<div class="features-title">Apa yang didapatkan:</div>
						<ul class="features-list">
							<li><i class="bi bi-check"></i> Semua fitur pro</li>
							<li><i class="bi bi-check"></i> Laporan keuangan detail</li>
						</ul>
					</div>
				</div>

				<!-- Enterprise Plan -->
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="pricing-card">
						<div class="plan-icon enterprise">
							<i class="bi bi-diamond-fill"></i>
						</div>
						<h3 class="plan-name">Enterprise</h3>
						<p class="plan-description">
							Tingkatkan bisnis Anda dengan semua fitur Business! Kelola tim dengan akses multi-user,
							serta nikmati dukungan prioritas dan konsultasi keuangan.
						</p>
						<div class="plan-price">Rp 99.000,00</div>
						<div class="plan-period">/Bulan</div>
						<a
							href="https://wa.me/6287860625673?text={{ urlencode('Halo, saya ingin berlangganan Balanix Enterprise. Mohon informasinya, terima kasih.') }}"
							target="_blank" class="pricing-btn btn-outline">Daftar sekarang</a>

						<div class="features-title">Apa yang didapatkan:</div>
						<ul class="features-list">
							<li><i class="bi bi-check"></i> Semua fitur business</li>
							<li><i class="bi bi-check"></i> Dukungan konsultansi</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonial Section -->
	<section class="testimonial-section" id="testimonial">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-5">
					<h2 class="testimonial-title">Testimonial</h2>
					<p class="testimonial-subtitle">
						Jangan hanya percaya begitu saja. Lihat apa yang sebenarnya<br>
						dikatakan pengguna layanan kami tentang pengalaman mereka.
					</p>
				</div>
			</div>

			<div class="row g-4">
				<div class="col-lg-4 col-md-6">
					<div class="testimonial-card">
						<div class="testimonial-content">
							<p class="testimonial-text">
								"Saya sudah menggunakan platform pencatatan ini selama lebih dari setahun, dan sangat
								terbantu dalam mencatat transaksi serta melihat laporan keuangan. Sistemnya stabil dan
								tim
								support sangat responsif setiap kali saya butuh bantuan. Sangat direkomendasikan untuk
								pelaku UMKM!"
							</p>
						</div>

						<div class="testimonial-rating">
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
						</div>

						<div class="testimonial-author">
							<div class="author-avatar">
								<img src="{{ asset('assets/img/profile/trainer-3.jpg') }}" alt="Jane Smith">
							</div>
							<div class="author-info">
								<h5 class="author-name">Jane Smith</h5>
								<p class="author-position">Freelance Designer</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="testimonial-card">
						<div class="testimonial-content">
							<p class="testimonial-text">
								"Saya sudah menggunakan platform ini beberapa bulan, dan sejauh ini cukup memuaskan.
								Fitur pencatatannya bekerja dengan baik dan belum pernah ada masalah besar. Harganya
								juga masih terjangkau.
								Tidak ada yang terlalu menonjol, tapi cukup membantu untuk kebutuhan usaha saya."
							</p>
						</div>

						<div class="testimonial-rating">
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star"></i>
							<i class="bi bi-star"></i>
						</div>

						<div class="testimonial-author">
							<div class="author-avatar">
								<img src="{{ asset('assets/img/profile/trainer-3-2.jpg') }}" alt="Tom Williams">
							</div>
							<div class="author-info">
								<h5 class="author-name">Tom Williams</h5>
								<p class="author-position">Software Developer</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="testimonial-card">
						<div class="testimonial-content">
							<p class="testimonial-text">
								"Awalnya saya ragu pindah ke platform pencatatan ini, tapi ternyata keputusan saya
								tepat.
								Tampilan sistemnya mudah digunakan, dan proses pencatatan transaksi jadi jauh lebih
								praktis.
								Sejak pakai ini, semuanya berjalan lancar."
							</p>
						</div>

						<div class="testimonial-rating">
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
							<i class="bi bi-star-fill"></i>
						</div>

						<div class="testimonial-author">
							<div class="author-avatar">
								<img src="{{ asset('assets/img/profile/trainer-2.jpg') }}" alt="Sarah Johnson">
							</div>
							<div class="author-info">
								<h5 class="author-name">Sarah Johnson</h5>
								<p class="author-position">Blogger</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ Section -->
	<section class="faq-section" id="faq">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center mb-5">
					<h2 class="faq-title">Frequently Asked Questions</h2>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="faq-container">
						<!-- FAQ Item 1 -->
						<div class="faq-item">
							<div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false"
								aria-controls="faq1">
								<div class="faq-icon">
									<i class="bi bi-credit-card"></i>
								</div>
								<span class="faq-text">Bagaimana cara pembayarannya?</span>
								<i class="bi bi-chevron-down faq-arrow"></i>
							</div>
							<div class="collapse faq-answer" id="faq1">
								<div class="faq-answer-content">
									Kami menyediakan berbagai metode pembayaran yang mudah dan aman, termasuk transfer
									bank, e-wallet (GoPay, OVO, Dana), dan virtual account. Pembayaran dapat dilakukan
									secara bulanan atau tahunan dengan diskon khusus untuk langganan tahunan.
								</div>
							</div>
						</div>

						<!-- FAQ Item 2 -->
						<div class="faq-item">
							<div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false"
								aria-controls="faq2">
								<div class="faq-icon">
									<i class="bi bi-robot"></i>
								</div>
								<span class="faq-text">Apakah fitur Balabot AI sulit digunakan?</span>
								<i class="bi bi-chevron-down faq-arrow"></i>
							</div>
							<div class="collapse faq-answer" id="faq2">
								<div class="faq-answer-content">
									Tidak, pada fitur ini Anda cukup berikan ringkasan pada pencatatan anda pada kolom
									chat, maka AI akan otomatis memberikan hasil yang sesuai dengan Anda inginkan.
								</div>
							</div>
						</div>

						<!-- FAQ Item 3 -->
						<div class="faq-item">
							<div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false"
								aria-controls="faq3">
								<div class="faq-icon">
									<i class="bi bi-clock"></i>
								</div>
								<span class="faq-text">Apakah fitur AI bisa diakses kapanpun?</span>
								<i class="bi bi-chevron-down faq-arrow"></i>
							</div>
							<div class="collapse faq-answer" id="faq3">
								<div class="faq-answer-content">
									Ya, fitur Balabot AI tersedia 24/7 dan dapat diakses kapan saja sesuai kebutuhan
									Anda. AI kami siap membantu pencatatan, analisis, dan pembuatan laporan keuangan
									tanpa batasan waktu, sehingga bisnis Anda dapat berjalan lancar sepanjang hari.
								</div>
							</div>
						</div>

						<!-- FAQ Item 4 -->
						<div class="faq-item">
							<div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false"
								aria-controls="faq4">
								<div class="faq-icon">
									<i class="bi bi-graph-up"></i>
								</div>
								<span class="faq-text">Apakah materi yang disampaikan sesuai trend berdagang?</span>
								<i class="bi bi-chevron-down faq-arrow"></i>
							</div>
							<div class="collapse faq-answer" id="faq4">
								<div class="faq-answer-content">
									Tentu saja! Materi dalam kelas kami selalu diperbarui mengikuti trend dan
									perkembangan terbaru dalam dunia bisnis dan perdagangan. Tim ahli kami secara rutin
									melakukan riset pasar dan memperbarui konten agar tetap relevan dengan kondisi
									bisnis saat ini.
								</div>
							</div>
						</div>

						<!-- FAQ Item 5 -->
						<div class="faq-item">
							<div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false"
								aria-controls="faq5">
								<div class="faq-icon">
									<i class="bi bi-currency-dollar"></i>
								</div>
								<span class="faq-text">Apakah ada biaya tambahan jika sudah berlangganan?</span>
								<i class="bi bi-chevron-down faq-arrow"></i>
							</div>
							<div class="collapse faq-answer" id="faq5">
								<div class="faq-answer-content">
									Tidak ada biaya tersembunyi atau biaya tambahan setelah Anda berlangganan. Semua
									fitur yang tertera dalam paket yang Anda pilih sudah termasuk dalam harga langganan
									bulanan. Anda hanya perlu membayar biaya langganan sesuai paket yang dipilih.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	{{-- Text Before Footer --}}
	<section class="py-5" style="background:#DBE2FF;">
		<div class="container text-center">
			<h2 class="mb-4" style="color:#263238; font-weight: 600; font-size: 50px">
				Kelola penjualan dan laporan keuangan <br class="d-none d-md-block">
				harian secara otomatis dan akurat.
			</h2>
			<a href="/register" class="btn px-4 py-2 rounded-2" style="background-color: #0335FF; color: white">
				Ayo Mulai Sekarang →
			</a>
		</div>
	</section>

	<!-- Footer -->
	<footer class="footer-section">
		<div class="container">
			<!-- Main Footer Content -->
			@include('components.layout.footer.footerMain')


			{{-- Footer Mobile --}}
			@include('components.layout.footer.footerMainMobile')

			<!-- Footer Bottom -->
			<div class="footer-bottom ">
				<div class="responsive-footer-bottom    container justify-content-between align-items-center  gap-2 ">
					<div class="footer-bottom-links">
						<a href="#privacy">Privasi</a>
						<a href="#terms">Syarat & Ketentuan</a>
						<a href="#sitemap">Sitemap</a>
					</div>
					<div class="">
						<p class="copyright">
							© {{ date('Y') }} Balanix.pro. All rights reserved.
						</p>
					</div>

				</div>
			</div>
		</div>

		<!-- Floating Back to Top -->
		<button class="back-to-top" onclick="scrollToTop()">
			<i class="bi bi-arrow-up"></i>
		</button>
	</footer>


	{{-- Bootstrap Script --}}
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
	</script>

	{{-- My Script --}}
	<script src="{{ asset('assets/js/welcome.js') }}"></script>
	</script>
</body>

</html>
