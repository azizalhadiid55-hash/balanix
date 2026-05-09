@extends('layouts.mainTemplateMember')

@section('title', 'Edit Hutang Piutang')
@section('sub-title', 'Hutang Piutang-Edit Hutang Piutang')

@section('konten')
<!-- Metric Cards -->
<!-- Metric Cards -->
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Edit Hutang Piutang</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Edit Data Hutang Piutang
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

                    <form style="color: #666666" class="py-3" action="{{ route('hutangPiutang.update', $hutangPiutang->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Nama pihak -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Pihak</label>
                                <input type="text" name="nama_pihak" class="form-control"
                                    placeholder="Masukkan nama pihak"
                                    value="{{ old('nama_pihak', $hutangPiutang->nama_pihak) }}">
                            </div>

                            <!-- Qty -->
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Produk</label>
                                <input type="number" name="qty" class="form-control"
                                    placeholder="Masukkan jumlah produk" min="1"
                                    value="{{ old('qty', $hutangPiutang->qty) }}">
                            </div>

                            <!-- Harga Satuan -->
                            <div class="col-md-6">
                                <label class="form-label">Harga Satuan</label>
                                <input type="number" name="harga_satuan" class="form-control"
                                    placeholder="Masukkan harga satuan" min="0" step="0.01"
                                    value="{{ old('harga_satuan', $hutangPiutang->harga_satuan) }}">
                            </div>

                            <!-- Total -->
                            <div class="col-md-6">
                                <label class="form-label">Total</label>
                                <input type="number" name="total" class="form-control" placeholder="Masukkan total"
                                    min="0" step="0.01" value="{{ old('total', $hutangPiutang->total) }}">
                            </div>

                            <!-- Catatan -->
                            <div class="col-md-6">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control"
                                    placeholder="Catatan">{{ old('catatan', $hutangPiutang->catatan) }}</textarea>
                            </div>

                            <!-- Jatuh Tempo -->
                            <div class="col-md-6">
                                <label class="form-label">Jatuh Tempo</label>
                                <input type="date" name="jatuh_tempo" class="form-control"
                                    value="{{ $hutangPiutang->jatuh_tempo }}">
                            </div>

                            <!-- Tanggal Pelunasan -->
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Pelunasan</label>
                                <input type="date" name="tanggal_pelunasan" class="form-control"
                                    value="{{ $hutangPiutang->tanggal_pelunasan }}">
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option disabled>Pilih status</option>
                                    <option value="lunas" {{ $hutangPiutang->status === 'lunas' ? 'selected' : '' }}>
                                        Lunas</option>
                                    <option value="belum lunas"
                                        {{ $hutangPiutang->status === 'belum lunas' ? 'selected' : '' }}>Belum Lunas
                                    </option>
                                    <option value="sebagian"
                                        {{ $hutangPiutang->status === 'sebagian' ? 'selected' : '' }}>Sebagian</option>
                                </select>
                            </div>

                            <!-- Jenis Transaksi -->
                            <div class="col-md-6">
                                <label class="form-label">Jenis Transaksi</label>
                                <select name="jenis_transaksi" class="form-select">
                                    <option disabled>Pilih jenis transaksi</option>
                                    <option value="hutang"
                                        {{ $hutangPiutang->jenis_transaksi === 'hutang' ? 'selected' : '' }}>Hutang
                                    </option>
                                    <option value="piutang"
                                        {{ $hutangPiutang->jenis_transaksi === 'piutang' ? 'selected' : '' }}>Piutang
                                    </option>
                                </select>
                            </div>

                            <!-- Pembayaran -->
                            <div class="col-md-6">
                                <label class="form-label">Pembayaran</label>
                                <select name="pembayaran" class="form-select">
                                    <option disabled>Pilih metode pembayaran</option>
                                    <option value="transfer"
                                        {{ $hutangPiutang->pembayaran === 'transfer' ? 'selected' : '' }}>Transfer Bank
                                    </option>
                                    <option value="qris" {{ $hutangPiutang->pembayaran === 'qris' ? 'selected' : '' }}>
                                        QRIS</option>
                                    <option value="cash" {{ $hutangPiutang->pembayaran === 'cash' ? 'selected' : '' }}>
                                        Cash</option>
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
