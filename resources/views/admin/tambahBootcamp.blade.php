@extends('layouts.mainTemplateAdmin')

@section('title', 'Tambah Bootcamp')
@section('sub-title', 'Bootcamp-Tambah')

@section('konten')
<!-- Metric Cards -->
<!-- Metric Cards -->
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Tambah Bootcamp</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Masukkan Data Bootcamp</h4>
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
                    <form style="color: #666666" class="py-3" action="/admin/bootcamp/simpan" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Nama Bootcamp -->
                            <div class="col-md-6">
                                <label class="form-label">Nama Bootcamp</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Bootcamp"
                                    name="nama_bootcamp" required>
                            </div>

                            <!-- Jenis Bootcamp -->
                            <div class="col-md-6">
                                <label for="jenis_bootcamp" class="form-label">Jenis Bootcamp</label>
                                <select class="form-select" name="jenis_bootcamp" required>
                                    <option disabled selected>Pilih jenis bootcamp</option>
                                    <option value="Manjamen">Manjamen</option>
                                    <option value="Bisnis Digital">Bisnis Digital</option>
                                    <option value="Pemasaran">Pemasaran</option>
                                    <option value="Keuangan">Keuangan</option>
                                    <option value="Teknologi Informasi">Teknologi Informasi</option>
                                </select>
                            </div>

                            <!-- Pelaksanaan -->
                            <div class="col-md-6">
                                <label class="form-label">Pelaksanaan</label>
                                <input type="date" class="form-control" name="pelaksanaan" required>
                            </div>

                            <!-- Link -->
                            <div class="col-md-6">
                                <label class="form-label">Link</label>
                                <input type="text" class="form-control" placeholder="Link" name="link" required>
                            </div>

                            <!-- Deskripsi -->
                            <div class="col-md-6">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" placeholder="Deskripsi bootcamp" name="deskripsi"
                                    required></textarea>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Preview</label>
                                <input type="file" class="form-control" id="previewFile" name="preview" required>
                            </div>

                            <!-- Tempat preview gambar -->
                            <div class="col-md-6">
                                <label class="form-label d-block">Hasil Preview</label>
                                <img id="previewImage" src="" alt="Preview Gambar" class="img-fluid rounded border"
                                    style="max-height: 200px; display:none;">
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
                                <a href="{{ route('admin.bootcamp.index') }}" style="text-decoration: none; color: inherit;">
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
        } else {
            previewImage.src = "";
            previewImage.style.display = "none";
        }
    });

</script>

@endsection
