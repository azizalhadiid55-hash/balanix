@php
    $window = 2;
    $start = max(1, $member->currentPage() - $window);
    $end   = min($member->lastPage(), $member->currentPage() + $window);
@endphp

<ul class="pagination" id="pagination">
    {{-- Previous --}}
    <li class="page-item {{ $member->onFirstPage() ? 'disabled' : '' }}">
        @if ($member->onFirstPage())
            <span class="page-link">Previous</span>
        @else
            <a class="page-link"
               href="{{ $member->previousPageUrl() }}"
               data-ajax="{{ route('admin.dashboard.member', ['page' => $member->currentPage() - 1, 'q' => request('q')]) }}">
               Previous
            </a>
        @endif
    </li>

    {{-- Numbered pages --}}
    @for ($page = $start; $page <= $end; $page++)
        <li class="page-item {{ $page == $member->currentPage() ? 'active' : '' }}">
            @if ($page == $member->currentPage())
                <span class="page-link">{{ $page }}</span>
            @else
                <a class="page-link"
                   href="{{ $member->url($page) }}"
                   data-ajax="{{ route('admin.dashboard.member', ['page' => $page, 'q' => request('q')]) }}">
                   {{ $page }}
                </a>
            @endif
        </li>
    @endfor

    {{-- Next --}}
    <li class="page-item {{ $member->hasMorePages() ? '' : 'disabled' }}">
        @if ($member->hasMorePages())
            <a class="page-link"
               href="{{ $member->nextPageUrl() }}"
               data-ajax="{{ route('admin.dashboard.member', ['page' => $member->currentPage() + 1, 'q' => request('q')]) }}">
               Next
            </a>
        @else
            <span class="page-link">Next</span>
        @endif
    </li>
</ul>
