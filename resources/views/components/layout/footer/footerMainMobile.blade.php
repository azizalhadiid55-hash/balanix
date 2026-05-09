<div class="footer-main-mobile my-4">
    <div class="footer-brand">

        {{-- Logo dan Slogan --}}
        <div class="w-100 d-flex justify-content-center align-items-center  mb-3">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Balanix Logo" class="footer-logo  ">
        </div>
        <p class="footer-description ">
            Membantu UMKM Indonesia berkembang dengan sistem pencatatan keuangan yang mudah, akurat, dan
            profesional.
        </p>

        {{-- logo sosial media --}}
        <div class="social-links mb-3">
            <a href="#" class="social-link instagram">
                <i class="bi bi-instagram "></i>
            </a>
            <a href="#" class="social-link facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="social-link twitter">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="#" class="social-link linkedin">
                <i class="bi bi-linkedin"></i>
            </a>
        </div>

        {{-- Perusahaan  --}}
        <div class="footer-collapse">
            <div class="footer-collapse-perusahaan d-flex align-items-center justify-content-between"
                data-bs-toggle="collapse" data-bs-target="#listPerusahaan" aria-expanded="false"
                aria-controls="listPerusahaan">
                <span class="footer-collapse-title">Perusahaan</span>
                <i class="bi bi-chevron-down icon-arrow"></i>
            </div>
            <div class="collapse background-collapse" id="listPerusahaan">
                <ul class="footer-menu-collapse list-unstyled  ">
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#kontak">Kontak Kami</a></li>
                    <li><a href="#karir">Karir</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                </ul>
            </div>
        </div>

        {{-- Bantuan --}}
        <div class="footer-collapse">
            <div class="footer-collapse-perusahaan d-flex align-items-center justify-content-between"
                data-bs-toggle="collapse" data-bs-target="#listBantuan" aria-expanded="false"
                aria-controls="listBantuan">
                <span class="footer-collapse-title">Bantuan</span>
                <i class="bi bi-chevron-down icon-arrow"></i>
            </div>
            <div class="collapse background-collapse" id="listBantuan">
                <ul class="footer-menu-collapse list-unstyled  ">
                    <li><a href="#pusat-bantuan">Pusat Bantuan</a></li>
                    <li><a href="#kebijakan">Kebijakan Layanan</a></li>
                    <li><a href="#legal">Legal</a></li>
                    <li><a href="#kebijakan-privasi">Kebijakan Privasi</a></li>
                    <li><a href="#status">Status</a></li>
                </ul>
            </div>
        </div>

        {{-- footer-newsletter --}}
        <div class="mt-3 mb-1">
            <h5 class="text-center">Tetap Terdepan</h5>
            <p class="dsescription-newsletter">Dapatkan update terbaru tentang fitur dan tips bisnis</p>
            <form class="newsletter-form">
                <div class="input-group">
                    <input type="email" class="form-control newsletter-input-mobile" placeholder="Masukkan email Anda"
                        required>
                    <button class="btn newsletter-btn-mobile" type="submit">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
