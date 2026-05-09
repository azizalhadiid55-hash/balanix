@extends('layouts.mainTemplateAdmin')

@section('title', 'Tambah Berlangganan')
@section('sub-title', 'Dashboard-Berlangganan')

@section('konten')
<!-- Metric Cards -->
<!-- Metric Cards -->
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Tambah Berlangganan</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Masukkan Data UMKM Yang
        Berlangganan</h4>
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

                    <form style="color: #666666" class="py-3" action="{{ url('/admin/dashboard/berlanganan/simpan') }}"
                        method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Id UMKM -->
                            <div class="col-md-6">
                                <label class="form-label">ID UMKM</label>
                                <select name="user_id" class="form-select" required>
                                    <option value="">-- Pilih ID UMKM --</option>
                                    @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama UMKM -->
                            <div class="col-md-6">
                                <label class="form-label">Nama UMKM</label>
                                <select name="nama_umkm" class="form-select" required>
                                    <option value="">-- Pilih Nama UMKM --</option>
                                    @foreach ($members as $member)
                                    <option value="{{ $member->name }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jenis Pembayaran -->
                            <div class="col-md-6">
                                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                                <select class="form-select" name="jenis_pembayaran" required>
                                    <option disabled selected>Pilih Jenis Pembayaran</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BRI">BRI</option>
                                    <option value="MANDIRI">MANDIRI</option>
                                    <option value="DANA">DANA</option>
                                </select>
                            </div>

                            <!-- Tanggal Berlangganan -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Berlangganan</label>
                                <input type="date" class="form-control" name="tanggal_bayar" required>
                            </div>

                            <!-- Paket -->
                            <div class="col-md-6">
                                <label for="paket" class="form-label">Paket</label>
                                <select class="form-select" name="paket" required>
                                    <option disabled selected>Pilih Jenis Paket</option>
                                    <option value="PRO">PRO</option>
                                    <option value="BUSINESS">BUSINESS</option>
                                    <option value="ENTERPRISE">ENTERPRISE</option>
                                </select>
                            </div>

                            <!-- Total -->
                            <div class="col-md-6">
                                <label class="form-label">Total</label>
                                <input type="number" class="form-control" placeholder="Total Uang" required
                                    name="total">
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

@endsection
