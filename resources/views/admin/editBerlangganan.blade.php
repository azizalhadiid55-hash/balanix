@extends('layouts.mainTemplateAdmin')

@section('title', 'Edit Berlangganan')
@section('sub-title', 'Berlangganan-Edit')

@section('konten')
<!-- Metric Cards -->
<!-- Metric Cards -->
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Edit Data Berlangganan</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Edit Data Berlangganan yang Ada
    </h4>
</div>

<!-- Data Table -->
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-10">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="row g-4 mb-3" style="width: 50%; margin: 0 auto;">
                        {{-- Jika Ada Error --}}
                        @if ($errors->any())
                        <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert"
                            style="width: 100%">
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
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert"
                            style="width: 100%">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- Jika Password Telah Diubah --}}
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert"
                            style="width: 100%">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>

                    {{-- Form --}}
                    <form style="color: #666666" class="py-3"
                        action="{{ route('admin.berlanganan.update', $berlangganan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Id UMKM -->
                            <div class="col-md-6">
                                <label class="form-label">ID UMKM</label>
                                <input type="text" class="form-control" value="{{ $berlangganan->user_id }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $berlangganan->user_id }}">
                            </div>

                            <!-- Nama UMKM -->
                            <div class="col-md-6">
                                <label class="form-label">Nama UMKM</label>
                                <input type="text" class="form-control" value="{{ $berlangganan->nama_umkm }}" readonly>
                                <input type="hidden" name="nama_umkm" value="{{ $berlangganan->nama_umkm }}">
                            </div>

                            <!-- Jenis Pembayaran -->
                            <div class="col-md-6">
                                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                                <select class="form-select" name="jenis_pembayaran">
                                    <option disabled>Pilih Jenis Pembayaran</option>
                                    <option value="QRIS"
                                        {{ $berlangganan->jenis_pembayaran == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="BNI"
                                        {{ $berlangganan->jenis_pembayaran == 'BNI' ? 'selected' : '' }}>BNI</option>
                                    <option value="BRI"
                                        {{ $berlangganan->jenis_pembayaran == 'BRI' ? 'selected' : '' }}>BRI</option>
                                    <option value="MANDIRI"
                                        {{ $berlangganan->jenis_pembayaran == 'MANDIRI' ? 'selected' : '' }}>MANDIRI
                                    </option>
                                    <option value="DANA"
                                        {{ $berlangganan->jenis_pembayaran == 'DANA' ? 'selected' : '' }}>DANA</option>
                                </select>
                            </div>

                            <!-- Tanggal Berlangganan -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Berlangganan</label>
                                <input type="date" class="form-control" name="tanggal_bayar"
                                    value="{{ $berlangganan->tanggal_bayar}}">
                            </div>

                            <!-- Paket -->
                            <div class="col-md-6">
                                <label for="paket" class="form-label">Paket</label>
                                <select class="form-select" name="paket">
                                    <option disabled>Pilih Jenis Paket</option>
                                    <option value="PRO" {{ $berlangganan->paket == 'PRO' ? 'selected' : '' }}>PRO
                                    </option>
                                    <option value="BUSINESS" {{ $berlangganan->paket == 'BUSINESS' ? 'selected' : '' }}>
                                        BUSINESS</option>
                                    <option value="ENTERPRISE"
                                        {{ $berlangganan->paket == 'ENTERPRISE' ? 'selected' : '' }}>ENTERPRISE</option>
                                </select>
                            </div>

                            <!-- Total -->
                            <div class="col-md-6">
                                <label class="form-label">Total</label>
                                <input type="number" class="form-control" placeholder="Total Uang" name="total"
                                    value="{{ $berlangganan->total }}">
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end mt-4">
                            <style>
                                .btn-submit-custom {
                                    background: #246DFF;
                                    color: white;
                                    border: none;
                                    padding: 8px 16px;
                                    border-radius: 10px;
                                    font-weight: 500;
                                    font-size: 14px;
                                    display: flex;
                                    align-items: center;
                                    gap: 8px;
                                    transition: all 0.2s ease;
                                }

                                .btn-submit-custom:hover {
                                    background: #194cb4;
                                }

                                .btn-cencel-custom {
                                    border: 1px solid #246DFF;
                                    color: #246DFF;
                                    padding: 8px 16px;
                                    border-radius: 10px;
                                    font-weight: 500;
                                    font-size: 14px;
                                    display: flex;
                                    align-items: center;
                                    gap: 8px;
                                    transition: all 0.2s ease;
                                }

                                .btn-cencel-custom:hover {
                                    background: red;
                                    border: 1px solid red;
                                    color: white
                                }

                            </style>
                            <button type="button" class="btn-cencel-custom me-2">
                                <a href="{{ route('admin.dashbaord.index') }}"
                                style="text-decoration: none; color: inherit;">
                                Batal
                            </a>
                            </button>
                            <button type="submit" class="btn-submit-custom">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Preview -->
<script>
    document.getElementById("previewFile").addEventListener("change", function (event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById("previewImage");

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
    });

</script>

@endsection
