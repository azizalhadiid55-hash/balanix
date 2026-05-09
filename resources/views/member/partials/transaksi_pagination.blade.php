@php
    $window = 2;
    $start = max(1, $transaksi->currentPage() - $window);
    $end   = min($transaksi->lastPage(), $transaksi->currentPage() + $window);
@endphp

<ul class="pagination" id="pagination pagination-transaksi">
    {{-- Previous --}}
    <li class="page-item {{ $transaksi->onFirstPage() ? 'disabled' : '' }}">
        @if ($transaksi->onFirstPage())
            <span class="page-link">Previous</span>
        @else
            <a class="page-link"
               href="{{ $transaksi->previousPageUrl() }}"
               data-ajax="{{ route('transaksi.list', array_merge(request()->only('q','filter'), ['page' => $transaksi->currentPage() - 1])) }}">
               Previous
            </a>
        @endif
    </li>

    {{-- Pages --}}
    @for ($page = $start; $page <= $end; $page++)
        <li class="page-item {{ $page == $transaksi->currentPage() ? 'active' : '' }}">
            @if ($page == $transaksi->currentPage())
                <span class="page-link">{{ $page }}</span>
            @else
                <a class="page-link"
                   href="{{ $transaksi->url($page) }}"
                   data-ajax="{{ route('transaksi.list', array_merge(request()->only('q','filter'), ['page' => $page])) }}">
                   {{ $page }}
                </a>
            @endif
        </li>
    @endfor

    {{-- Next --}}
    <li class="page-item {{ $transaksi->hasMorePages() ? '' : 'disabled' }}">
        @if ($transaksi->hasMorePages())
            <a class="page-link"
               href="{{ $transaksi->nextPageUrl() }}"
               data-ajax="{{ route('transaksi.list', array_merge(request()->only('q','filter'), ['page' => $transaksi->currentPage() + 1])) }}">
               Next
            </a>
        @else
            <span class="page-link">Next</span>
        @endif
    </li>
</ul>
