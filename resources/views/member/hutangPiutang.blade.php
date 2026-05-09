@extends('layouts.mainTemplateMember')

@section('title', 'Hutang Piutang')
@section('sub-title', 'Hutang Piutang')

@section('konten')
{{-- Tombol Filter --}}
<div class="select">
    <div class="input-group">
        <select class="form-select filter-hutangPiutang" id="selectHari">
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
        <h2 class="table-title">Daftar Hutang Piutang</h2>
        <button class="btn-primary-custom">
            <a href="/hutangPiutang/tambah" style="color: white; text-decoration: none">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Hutang Piutang</span>
            </a>
        </button>
    </div>

    <div class="table-controls">
        <div class="search-wrapper">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari..." class="search-input search-hutangPiutang" value="{{ request('q') }}">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pihak</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>Catatan</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Pelunasan</th>
                    <th>Status</th>
                    <th>Jenis Transaksi</th>
                    <th>Metode Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="hutangPiutang-rows">
                @include('member.partials.hutangPiutang_rows')
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
                        text: "Data hutang piutang akan dihapus permanen!",
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

    <div class="pagination-wrapper pagination-wrapper-hutangPiutang">
        <div class="pagination-info" id="hutangPiutang-info">
            @include('member.partials.hutangPiutang_info')
        </div>
        @include('member.partials.hutangPiutang_pagination')
    </div>
</div>

{{-- Script untuk Pegination --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input   = document.querySelector('.search-hutangPiutang');
    const select  = document.querySelector('.filter-hutangPiutang');
    const rowsEl  = document.getElementById('hutangPiutang-rows');
    const infoEl  = document.getElementById('hutangPiutang-info');
    const wrapper = document.querySelector('.pagination-wrapper-hutangPiutang');

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
                const currentUl = wrapper.querySelector('#pagination-hutangPiutang');
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
            debounce = setTimeout(() => fetchList('/hutangPiutang/list'), debounceMs);
        });
    }

    if (select) {
        select.addEventListener('change', () => {
            fetchList('/hutangPiutang/list');
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
