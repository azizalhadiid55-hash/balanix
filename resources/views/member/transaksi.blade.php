@extends('layouts.mainTemplateMember')

@section('title', 'Transaksi')
@section('sub-title', 'Transaksi')

@section('konten')
{{-- Tombol Filter --}}
<div class="select">
    <div class="input-group">
        <select class="form-select filter-transaksi" id="selectHari">
            <option value="">Semua Waktu</option>
            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan ini</option>
            <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>Tahun ini</option>
        </select>

        <label class="input-group-text" for="selectHari">
            <i class="bi bi-calendar-event"></i>
        </label>
    </div>
</div>

<!-- Data Table -->
<div class="data-table-card">
    <div class="table-header">
        <h2 class="table-title">Daftar Transaksi</h2>
        <button class="btn-primary-custom">
            <a href="/transaksi/tambah" style="color: white; text-decoration: none">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Transaksi</span>
            </a>
        </button>
    </div>

    <div class="table-controls">
        <div class="search-wrapper">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari..." class="search-input search-transaksi"
                    value="{{ request('q') }}">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Pembayaran</th>
                    <th>Jenis Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="transaksi-rows">
                @include('member.partials.transaksi_rows')
            </tbody>
        </table>

        {{-- Untuk Alert Hapus Data --}}
        {{-- SweetAlert2 CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hapusForms = document.querySelectorAll('.form-hapus');

            hapusForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // cegah submit langsung

                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Data transaksi akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form jika user setuju
                        }
                    });
                });
            });
        });
        </script>
    </div>

    <div class="pagination-wrapper pagination-wrapper-transaksi">
        <div class="pagination-info" id="transaksi-info">
            @include('member.partials.transaksi_info')
        </div>
        @include('member.partials.transaksi_pagination')
    </div>
</div>

{{-- Script untuk Pegination --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input   = document.querySelector('.search-transaksi');
    const select  = document.querySelector('.filter-transaksi');
    const rowsEl  = document.getElementById('transaksi-rows');
    const infoEl  = document.getElementById('transaksi-info');
    const wrapper = document.querySelector('.pagination-wrapper-transaksi');

    let debounce;
    const debounceMs = 250;

    function fetchList(url) {
        const u = new URL(url, window.location.origin);
        const q = (input && input.value) ? input.value.trim() : '';
        const filter = (select && select.value) ? select.value : '';

        if (q) u.searchParams.set('q', q); else u.searchParams.delete('q');
        if (filter) u.searchParams.set('filter', filter); else u.searchParams.delete('filter');

        fetch(u.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
            .then(r => r.json())
            .then(data => {
                rowsEl.innerHTML = data.rows;
                const currentUl = wrapper.querySelector('#pagination-transaksi');
                const temp = document.createElement('div');
                temp.innerHTML = data.pagination.trim();
                const newUl = temp.firstElementChild;
                if (currentUl && newUl) currentUl.replaceWith(newUl);
                infoEl.innerHTML = data.info;
            })
            .catch(err => console.error(err));
    }

    if (input) {
        input.addEventListener('input', () => {
            clearTimeout(debounce);
            debounce = setTimeout(() => fetchList('/transaksi/list'), debounceMs);
        });
    }

    if (select) {
        select.addEventListener('change', () => {
            fetchList('/transaksi/list');
        });
    }

    if (wrapper) {
        wrapper.addEventListener('click', (e) => {
            const a = e.target.closest('a.page-link');
            if (!a) return;
            e.preventDefault();
            // pakai data-ajax (sudah mengarah ke transaksi.list)
            const ajaxUrl = a.dataset.ajax;
            if (ajaxUrl) fetchList(ajaxUrl);
        });
    }
});
</script>

@endsection
