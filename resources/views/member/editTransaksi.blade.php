@extends('layouts.mainTemplateMember')

@section('title', 'Edit Transaksi')
@section('sub-title', 'Transaksi-Edit Transaksi')

@section('konten')
<!-- Metric Cards -->
<!-- Metric Cards -->
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Edit Transaksi</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Edit Data Transaksi Usaha
        Anda</h4>
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

                    <form style="color: #666666" class="py-3" action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Nama Produk -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Produk"
                                    name="nama_produk" value="{{ $transaksi->nama_produk }}">
                            </div>

                            <!-- Kuantiti Produk -->
                            <div class="col-md-6">
                                <label class="form-label">Kuantiti Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan Kuantiti Produk"
                                    name="qty" value="{{ $transaksi->qty }}">
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal_transaksi"
                                    value="{{ $transaksi->tanggal_transaksi->format('Y-m-d') }}">
                            </div>

                            <!-- Total Transkasi -->
                            <div class="col-md-6">
                                <label class="form-label">Total Transkasi</label>
                                <input type="number" class="form-control"
                                    placeholder="Maksukkan Total Transaski Anda dalam Nominal Angka" name="total"
                                    value="{{ $transaksi->total }}">
                            </div>

                            <!-- Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Pembayaran</label>
                                <select name="pembayaran" class="form-select">
                                    <option disabled {{ $transaksi->pembayaran ? '' : 'selected' }}>Pilih Pembayaran
                                    </option>
                                    <option value="transfer"
                                        {{ $transaksi->pembayaran === 'transfer' ? 'selected' : '' }}>Transfer Bank
                                    </option>
                                    <option value="qris" {{ $transaksi->pembayaran === 'qris' ? 'selected' : '' }}>QRIS
                                    </option>
                                    <option value="cash" {{ $transaksi->pembayaran === 'cash' ? 'selected' : '' }}>Cash
                                    </option>
                                </select>
                                </select>
                            </div>

                            <!-- Jenis Transaksi -->
                            <div class="col-md-6">
                                <label class="form-label">Jenis Transaksi</label>
                                <select name="jenis_transaksi" class="form-select">
                                    <option disabled {{ $transaksi->jenis_transaksi ? '' : 'selected' }}>Pilih jenis
                                        transaksi</option>
                                    <option value="pemasukan"
                                        {{ $transaksi->jenis_transaksi === 'pemasukan' ? 'selected' : '' }}>Pemasukan
                                    </option>
                                    <option value="pengeluaran"
                                        {{ $transaksi->jenis_transaksi === 'pengeluaran' ? 'selected' : '' }}>
                                        Pengeluaran</option>
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
                                <a href="{{ route('transaksi.index') }}" style="text-decoration: none; color: inherit;">
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
