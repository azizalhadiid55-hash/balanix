@php
    $window = 2;
    $start = max(1, $hutangPiutang->currentPage() - $window);
    $end   = min($hutangPiutang->lastPage(), $hutangPiutang->currentPage() + $window);
@endphp

<ul class="pagination" id="pagination pagination-hutangPiutang">
    {{-- Previous --}}
    <li class="page-item {{ $hutangPiutang->onFirstPage() ? 'disabled' : '' }}">
        @if ($hutangPiutang->onFirstPage())
            <span class="page-link">Previous</span>
        @else
            <a class="page-link"
               href="{{ $hutangPiutang->previousPageUrl() }}"
               data-ajax="{{ route('hutangPiutang.list', array_merge(request()->only('q','filter'), ['page' => $hutangPiutang->currentPage() - 1])) }}">
               Previous
            </a>
        @endif
    </li>

    {{-- Pages --}}
    @for ($page = $start; $page <= $end; $page++)
        <li class="page-item {{ $page == $hutangPiutang->currentPage() ? 'active' : '' }}">
            @if ($page == $hutangPiutang->currentPage())
                <span class="page-link">{{ $page }}</span>
            @else
                <a class="page-link"
                   href="{{ $hutangPiutang->url($page) }}"
                   data-ajax="{{ route('hutangPiutang.list', array_merge(request()->only('q','filter'), ['page' => $page])) }}">
                   {{ $page }}
                </a>
            @endif
        </li>
    @endfor

    {{-- Next --}}
    <li class="page-item {{ $hutangPiutang->hasMorePages() ? '' : 'disabled' }}">
        @if ($hutangPiutang->hasMorePages())
            <a class="page-link"
               href="{{ $hutangPiutang->nextPageUrl() }}"
               data-ajax="{{ route('hutangPiutang.list', array_merge(request()->only('q','filter'), ['page' => $hutangPiutang->currentPage() + 1])) }}">
               Next
            </a>
        @else
            <span class="page-link">Next</span>
        @endif
    </li>
</ul>
