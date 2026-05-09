@php
    $window = 2;
    $start = max(1, $berlangganan->currentPage() - $window);
    $end   = min($berlangganan->lastPage(), $berlangganan->currentPage() + $window);
@endphp

<ul class="pagination" id="pagination">
    {{-- Previous --}}
    <li class="page-item {{ $berlangganan->onFirstPage() ? 'disabled' : '' }}">
        @if ($berlangganan->onFirstPage())
            <span class="page-link">Previous</span>
        @else
            <a class="page-link"
               href="{{ $berlangganan->previousPageUrl() }}"
                data-ajax="{{ route('admin.dashboard.berlangganan', ['page' => $berlangganan->currentPage() - 1, 'q' => request('q')]) }}">
               Previous
            </a>
        @endif
    </li>

    {{-- Numbered pages --}}
    @for ($page = $start; $page <= $end; $page++)
        <li class="page-item {{ $page == $berlangganan->currentPage() ? 'active' : '' }}">
            @if ($page == $berlangganan->currentPage())
                <span class="page-link">{{ $page }}</span>
            @else
                <a class="page-link"
                   href="{{ $berlangganan->url($page) }}"
                   data-ajax="{{ route('admin.dashboard.berlangganan', ['page' => $page, 'q' => request('q')]) }}">
                   {{ $page }}
                </a>
            @endif
        </li>
    @endfor

    {{-- Next --}}
    <li class="page-item {{ $berlangganan->hasMorePages() ? '' : 'disabled' }}">
        @if ($berlangganan->hasMorePages())
            <a class="page-link"
               href="{{ $berlangganan->nextPageUrl() }}"
               data-ajax="{{ route('admin.dashboard.berlangganan', ['page' => $berlangganan->currentPage() + 1, 'q' => request('q')]) }}">
               Next
            </a>
        @else
            <span class="page-link">Next</span>
        @endif
    </li>
</ul>
