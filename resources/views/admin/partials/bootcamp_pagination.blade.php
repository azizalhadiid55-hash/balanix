@php
    $window = 2; // tampilkan 2 halaman di kiri/kanan current
    $start = max(1, $bootcamps->currentPage() - $window);
    $end   = min($bootcamps->lastPage(), $bootcamps->currentPage() + $window);
@endphp

<ul class="pagination" id="pagination">
    {{-- Previous --}}
    <li class="page-item {{ $bootcamps->onFirstPage() ? 'disabled' : '' }}">
        @if ($bootcamps->onFirstPage())
            <span class="page-link">Previous</span>
        @else
            <a class="page-link"
               href="{{ route('admin.bootcamp.index', array_merge(request()->only('q','per_page'), ['page' => $bootcamps->currentPage() - 1])) }}"
               data-ajax="{{ route('admin.bootcamp.list', array_merge(request()->only('q','per_page'), ['page' => $bootcamps->currentPage() - 1])) }}">
               Previous
            </a>
        @endif
    </li>

    {{-- Numbered pages --}}
    @for ($page = $start; $page <= $end; $page++)
        <li class="page-item {{ $page == $bootcamps->currentPage() ? 'active' : '' }}">
            @if ($page == $bootcamps->currentPage())
                <span class="page-link">{{ $page }}</span>
            @else
                <a class="page-link"
                   href="{{ route('admin.bootcamp.index', array_merge(request()->only('q','per_page'), ['page' => $page])) }}"
                   data-ajax="{{ route('admin.bootcamp.list', array_merge(request()->only('q','per_page'), ['page' => $page])) }}">
                   {{ $page }}
                </a>
            @endif
        </li>
    @endfor

    {{-- Next --}}
    <li class="page-item {{ $bootcamps->hasMorePages() ? '' : 'disabled' }}">
        @if ($bootcamps->hasMorePages())
            <a class="page-link"
               href="{{ route('admin.bootcamp.index', array_merge(request()->only('q','per_page'), ['page' => $bootcamps->currentPage() + 1])) }}"
               data-ajax="{{ route('admin.bootcamp.list', array_merge(request()->only('q','per_page'), ['page' => $bootcamps->currentPage() + 1])) }}">
               Next
            </a>
        @else
            <span class="page-link">Next</span>
        @endif
    </li>
</ul>
