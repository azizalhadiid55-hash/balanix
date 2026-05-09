@extends('layouts.mainTemplateAdmin')

@section('title', 'Dashboard')
@section('sub-title', 'Dashboard')

@section('konten')
    <!-- Metric Cards -->
    <div class="metric-cards">
        <div class="metric-card users">
            <div class="icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="title">Total Pengguna</div>
            <div class="value">{{ $membersCount > 0 ? $membersCount : 'Tidak ada' }}</div>
        </div>

        <div class="metric-card subscribers">
            <div class="icon">
                <i class="bi bi-person-check"></i>
            </div>
            <div class="title">Berlangganan</div>
            <div class="value">{{ $berlanggananCount > 0 ? $berlanggananCount : 'Tidak ada' }}</div>
        </div>

        <div class="metric-card bootcamp">
            <div class="icon">
                <i class="bi bi-mortarboard"></i>
            </div>
            <div class="title">Bootcamp</div>
            <div class="value">{{ $bootcampCount > 0 ? $bootcampCount : 'Tidak ada' }}</div>
        </div>
    </div>

    <!-- Data Table Berlangganan-->
    <div class="data-table-card">
        <div class="table-header">
            <h2 class="table-title">Daftar Berlangganan</h2>
            <button class="btn-primary-custom">
                <a href="/admin/dashboard/berlanganan/tambah" style="color: white; text-decoration: none">
                    <i class="bi bi-plus-circle"></i>
                    <span>Tambah Berlangganan</span>
                </a>
            </button>
        </div>

        <div class="table-controls">
            <div class="search-wrapper">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Cari..." class="search-input search-berlangganan">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama UMKM</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Paket</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="berlangganan-rows">
                    @include('admin.partials.berlangganan_rows')
                </tbody>
            </table>

            {{-- SweetAlert2 CDN --}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const hapusForms = document.querySelectorAll('.form-hapus');

                    hapusForms.forEach(form => {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault(); // cegah submit langsung

                            Swal.fire({
                                title: 'Apakah kamu yakin?',
                                text: "Data berlanganan akan dihapus permanen!",
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

        <div class="pagination-wrapper pagination-wrapper-berlangganan">
            <div class="pagination-info" id="berlangganan-info">
                @include('admin.partials.berlangganan_info')
            </div>
            @include('admin.partials.berlangganan_pagination')
        </div>
    </div>

    <!-- Data Table Memeber UMKM-->
    <div class="data-table-card mt-5">
        <div class="table-header">
            <h2 class="table-title ">Daftar UMKM/Pengguna</h2>
            <div class="search-wrapper">
                <div class="search-box ">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Cari..." class="search-input search-member">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th>ID</th>
                        <th>Nama UMKM/Pengguna</th>
                        <th>Email UMKM/Pengguna</th>
                    </tr>
                </thead>
                <tbody id="member-rows">
                    @include('admin.partials.member_rows')
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper pagination-wrapper-member">
            <div class="pagination-info" id="member-info">
                @include('admin.partials.member_info')
            </div>
            @include('admin.partials.member_pagination')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupAjaxTable(options) {
                const input = document.querySelector(options.searchSelector);
                const rowsEl = document.getElementById(options.rowsId);
                const infoEl = document.getElementById(options.infoId);
                const wrapper = document.querySelector(options.wrapperSelector);

                let debounce;
                const debounceMs = 250;

                function fetchList(url) {
                    const u = new URL(url, window.location.origin);
                    const q = (input.value || '').trim();
                    if (q) u.searchParams.set('q', q);
                    else u.searchParams.delete('q');

                    fetch(u.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(r => r.json())
                        .then(data => {
                            rowsEl.innerHTML = data.rows;
                            const currentUl = wrapper.querySelector('#pagination');
                            const temp = document.createElement('div');
                            temp.innerHTML = data.pagination.trim();
                            const newUl = temp.firstElementChild;
                            if (currentUl && newUl) currentUl.replaceWith(newUl);
                            infoEl.innerHTML = data.info;
                        })
                        .catch(console.error);
                }

                if (input) {
                    input.addEventListener('input', () => {
                        clearTimeout(debounce);
                        debounce = setTimeout(() => {
                            fetchList(options.listUrl);
                        }, debounceMs);
                    });
                }

                if (wrapper) {
                    wrapper.addEventListener('click', (e) => {
                        const a = e.target.closest('a.page-link');
                        if (!a) return;
                        e.preventDefault();
                        const ajaxUrl = a.dataset.ajax || a.href;
                        fetchList(ajaxUrl);
                    });
                }
            }

            // setup untuk tabel Berlangganan
            setupAjaxTable({
                searchSelector: '.search-berlangganan',
                rowsId: 'berlangganan-rows',
                infoId: 'berlangganan-info',
                wrapperSelector: '.pagination-wrapper-berlangganan',
                listUrl: '/admin/dashboard/berlangganan'
            });

            // setup untuk tabel Member
            setupAjaxTable({
                searchSelector: '.search-member',
                rowsId: 'member-rows',
                infoId: 'member-info',
                wrapperSelector: '.pagination-wrapper-member',
                listUrl: '/admin/dashboard/member'
            });
        });
    </script>

@endsection
