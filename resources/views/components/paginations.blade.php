@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
    @endphp

    <nav class="d-flex justify-content-center mt-4">
        <ul class="pagination pagination-sm align-items-center gap-2 m-0 border-0">
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link custom-pagination-item text-muted opacity-25">
                        <i class="fa fa-chevron-left small"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa fa-chevron-left small" style="color: #ff7c9d;"></i>
                    </a>
                </li>
            @endif

            {{-- Page 1 --}}
            @if ($currentPage == 1)
                <li class="page-item active" aria-current="page">
                    <span class="page-link custom-pagination-item active-page shadow-sm">1</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->url(1) }}">1</a>
                </li>
            @endif

            {{-- First Ellipsis Break --}}
            @if ($currentPage > 3 && $lastPage > 5)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link border-0 bg-transparent text-muted px-1 fw-bold" style="color: #ff7c9d !important; font-size: 0.8rem;">。。。</span>
                </li>
            @endif

            {{-- Dynamic Center Windows --}}
            @for ($i = 2; $i < $lastPage; $i++)
                @if ($i >= $currentPage - 1 && $i <= $currentPage + 1)
                    @if ($i == $currentPage)
                        <li class="page-item active" aria-current="page">
                            <span class="page-link custom-pagination-item active-page shadow-sm">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @elseif ($currentPage <= 3 && $i <= 3 && $lastPage > 4)
                    <li class="page-item">
                        <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @elseif ($currentPage >= $lastPage - 2 && $i >= $lastPage - 2 && $lastPage > 4)
                    <li class="page-item">
                        <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Second Ellipsis Break --}}
            @if ($currentPage < $lastPage - 2 && $lastPage > 5)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link border-0 bg-transparent text-muted px-1 fw-bold" style="color: #ff7c9d !important; font-size: 0.8rem;">。。。</span>
                </li>
            @endif

            {{-- Last Page --}}
            @if ($lastPage > 1)
                @if ($currentPage == $lastPage)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link custom-pagination-item active-page shadow-sm">{{ $lastPage }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link custom-pagination-item text-secondary page-hover-effect" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa fa-chevron-right small" style="color: #ff7c9d;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link custom-pagination-item text-muted opacity-25">
                        <i class="fa fa-chevron-right small"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    /* Clean up default Bootstrap layout wrappers */
    .pagination .page-item {
        margin: 0 !important;
    }
    
    .custom-pagination-item {
        display: flex !important;
        align-items: center;
        justify-content: center;
        width: 30px !important;  /* Reduced from 36px for a cleaner profile */
        height: 30px !important; /* Reduced from 36px */
        padding: 0 !important;
        border-radius: 8px !important; 
        border: 1px solid #ffa3b9 !important; /* Made border crisp and pinker */
        background-color: #fff !important;
        color: #ff7c9d !important; /* Default inactive text color matches the pink style */
        font-weight: 700 !important;
        font-size: 0.82rem;
        box-shadow: none !important;
        transition: all 0.15s ease-in-out;
    }

    /* Active page item - Deep solid pink background with clean white font */
    .active-page {
        background-color: #ff7c9d !important;
        border-color: #ff7c9d !important;
        color: #ffffff !important;
    }

    /* Inactive elements hover style matrix */
    .page-hover-effect:hover {
        background-color: #fff0f3 !important; 
        color: #d13b5c !important;
        border-color: #ff7c9d !important;
    }

    /* Fixed disabled state layout borders */
    .page-item.disabled .custom-pagination-item {
        background-color: #ffffff !important;
        border-color: #ffe0e6 !important;
    }
</style>