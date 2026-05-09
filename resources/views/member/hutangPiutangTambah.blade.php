@extends('layouts.mainTemplateMember')

@section('title', 'Tambah Hutang Piutang')
@section('sub-title', 'Hutang Piutang-Tambah Hutang Piutang')

@section('konten')
<!-- Metric Cards -->
<!-- Metric Cards -->
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Tambah Hutang Piutang</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Masukkan Data Hutang Piutang
        Usaha Anda</h4>
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

                    <form style="color: #666666" class="py-3" action="/hutangPiutang/simpan" method="POST">
                        @csrf

                        <div class="row g-3">
                            <!-- Nama pihak -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Pihak</label>
                                <input type="text" name="nama_pihak" class="form-control"
                                    placeholder="Masukkan nama pihak" required>
                            </div>

                            <!-- Qty -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Produk</label>
                                <input type="number" name="qty" class="form-control"
                                    placeholder="Masukkan jumlah produk" min="1" required>
                            </div>

                            <!-- Harga Satuan -->
                            <div class="col-md-6">
                                <label class="form-label">Harga Satuan</label>
                                <input type="number" name="harga_satuan" class="form-control"
                                    placeholder="Masukkan harga satuan" min="0" step="0.01" required>
                            </div>

                            <!-- Total -->
                            <div class="col-md-6">
                                <label class="form-label">Total</label>
                                <input type="number" name="total" class="form-control" placeholder="Masukkan total"
                                    min="0" step="0.01" required>
                            </div>

                            <!-- Catatan -->
                            <div class="col-md-6">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" placeholder="Catatan" required></textarea>
                            </div>

                            <!-- Jatuh Tempo -->
                            <div class="col-md-6">
                                <label class="form-label">Jatuh Tempo</label>
                                <input type="date" name="jatuh_tempo" class="form-control">
                            </div>

                            <!-- Tanggal Pelunasan -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pelunasan</label>
                                <input type="date" name="tanggal_pelunasan" class="form-control">
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option selected disabled>Pilih status</option>
                                    <option value="lunas">Lunas</option>
                                    <option value="belum lunas">Belum Lunas</option>
                                    <option value="sebagian">Sebagian</option>
                                </select>
                            </div>

                            <!-- Jenis Transaksi -->
                            <div class="col-md-6">
                                <label class="form-label">Jenis Transaksi</label>
                                <select name="jenis_transaksi" class="form-select" required>
                                    <option selected disabled>Pilih jenis transaksi</option>
                                    <option value="hutang">Hutang</option>
                                    <option value="piutang">Piutang</option>
                                </select>
                            </div>

                            <!-- Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Pembayaran</label>
                                <select name="pembayaran" class="form-select" required>
                                    <option selected disabled>Pilih metode pembayaran</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end mt-5">
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
                                <a href="{{ route('hutangPiutang.index') }}" style="text-decoration: none; color: inherit;">
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
