@extends('layouts.mainTemplateMember')

@section('title', 'Berlangganan')
@section('sub-title', 'Berlangganan')

@section('konten')
	<section class="pricing-section" id="harga">
		<div class="">
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
						@php
							$message = "";
							$message = "Halo, saya ingin berlangganan Balanix Pro. Berikut ini detail akun saya:\n\n";
							$message .= "ID User: " . Auth::user()->id . "\n";
							$message .= "Nama: " . Auth::user()->name . "\n";
							$message .= "Email: " . Auth::user()->email . "\n";
							$message .= "\nMohon informasinya, terima kasih.";
						@endphp
						<a href="https://wa.me/6287860625673?text={{ urlencode($message) }}" target="_blank" class="pricing-btn btn-outline">Daftar sekarang</a>

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
						@php
							$message = "";
							$message = "Halo, saya ingin berlangganan Balanix Business. Berikut ini detail akun saya:\n\n";
							$message .= "ID User: " . Auth::user()->id . "\n";
							$message .= "Nama: " . Auth::user()->name . "\n";
							$message .= "Email: " . Auth::user()->email . "\n";
							$message .= "\nMohon informasinya, terima kasih.";
						@endphp
						<a href="https://wa.me/6287860625673?text={{ urlencode($message) }}" target="_blank" class="pricing-btn btn-white">Daftar sekarang</a>

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
						@php
							$message = "";
							$message = "Halo, saya ingin berlangganan Balanix Enterprise. Berikut ini detail akun saya:\n\n";
							$message .= "ID User: " . Auth::user()->id . "\n";
							$message .= "Nama: " . Auth::user()->name . "\n";
							$message .= "Email: " . Auth::user()->email . "\n";
							$message .= "\nMohon informasinya, terima kasih.";
						@endphp
						<a href="https://wa.me/6287860625673?text={{ urlencode($message) }}" target="_blank" class="pricing-btn btn-outline">Daftar sekarang</a>

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
@endsection
