{{-- resources/views/admin/bootcamp.blade.php --}}
@extends('layouts.mainTemplateAdmin')

@section('title', 'Bootcamp')
@section('sub-title', 'Bootcamp')

@section('konten')
<div class="container">
    <h1 style="color: #333333; font-size: 24px; font-weight: bold">Data Bootcamp</h1>
    <h4 style="color: #767575; font-size: 12px; font-weight: bold; margin-bottom: 30px">Kelola Data Bootcamp</h4>
</div>

<div class="data-table-card">
    <div class="table-header">
        <h2 class="table-title">Daftar Bootcamp</h2>
        <button class="btn-primary-custom">
            <a href="/admin/bootcamp/tambah" style="color: white; text-decoration: none">
                <i class="bi bi-plus-circle"></i>
                <span>Tambah Bootcamp</span>
            </a>
        </button>
    </div>

    <div class="table-controls">
        <div class="search-wrapper">
            <div class="search-box">
                <i class="bi bi-search"></i>
                {{-- input ini sudah ada di file kamu sebelumnya --}}
                <input type="text" placeholder="Cari." class="search-input" value="{{ request('q') }}">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bootcamp</th>
                    <th>Pelaksanaan</th>
                    <th>Jenis bootcamp</th>
                    <th>Link Zoom</th>
                    <th>Priview</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="bootcamp-rows">
                @include('admin.partials.bootcamp_rows')
            </tbody>
        </table>
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
                        text: "Data bootcamp akan dihapus permanen!",
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

    <div class="pagination-wrapper">
        <div class="pagination-info" id="pagination-info">
            @include('admin.partials.bootcamp_pagination_info')
        </div>
        @include('admin.partials.bootcamp_pagination')
    </div>
</div>

{{-- JS: live search + AJAX pagination --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input     = document.querySelector('.search-input');
    const rowsEl    = document.getElementById('bootcamp-rows');
    const infoEl    = document.getElementById('pagination-info');
    const wrapper   = document.querySelector('.pagination-wrapper');

    let debounce;
    const debounceMs = 250;

    function fetchList(url) {
        const u = new URL(url, window.location.origin);
        const q = (input.value || '').trim();
        if (q) u.searchParams.set('q', q); else u.searchParams.delete('q');

        fetch(u.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            rowsEl.innerHTML = data.rows;
            // ganti <ul id="pagination"> seluruhnya
            const currentUl = wrapper.querySelector('#pagination');
            const temp = document.createElement('div');
            temp.innerHTML = data.pagination.trim();
            const newUl = temp.firstElementChild;
            if (currentUl && newUl) currentUl.replaceWith(newUl);
            infoEl.innerHTML = data.info;
        })
        .catch(console.error);
    }

    // Live search (ketik → debounce → fetch)
    input.addEventListener('input', () => {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
            fetchList('{{ route('admin.bootcamp.list') }}');
            // update URL agar q tersimpan saat refresh
            const url = new URL(window.location);
            const q = (input.value || '').trim();
            if (q) url.searchParams.set('q', q); else url.searchParams.delete('q');
            url.searchParams.delete('page'); // reset ke page 1
            window.history.replaceState({}, '', url);
        }, debounceMs);
    });

    // AJAX pagination (delegation)
    wrapper.addEventListener('click', (e) => {
        const a = e.target.closest('a.page-link');
        if (!a) return;
        e.preventDefault();
        const ajaxUrl = a.dataset.ajax || a.href;
        fetchList(ajaxUrl);

        // sinkronkan URL address bar (tanpa reload)
        try {
            const url = new URL(a.getAttribute('href'), window.location.origin);
            const q = (input.value || '').trim();
            if (q) url.searchParams.set('q', q); else url.searchParams.delete('q');
            window.history.replaceState({}, '', url);
        } catch (_) {}
    });
});
</script>
@endsection
