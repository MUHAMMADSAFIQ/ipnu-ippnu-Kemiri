@if ($paginator->hasPages())
    <div class="na-pagination">
        <span>Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>
        <div class="pg-buttons">
            {{-- First Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="pg-btn disabled"><i class="fa-solid fa-angles-left"></i></a>
            @else
                <a href="{{ $paginator->url(1) }}" class="pg-btn ajax-page"><i class="fa-solid fa-angles-left"></i></a>
            @endif

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="pg-btn disabled"><i class="fa-solid fa-angle-left"></i></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pg-btn ajax-page"><i class="fa-solid fa-angle-left"></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="pg-btn disabled">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="pg-btn active">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="pg-btn ajax-page">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pg-btn ajax-page"><i class="fa-solid fa-angle-right"></i></a>
            @else
                <a class="pg-btn disabled"><i class="fa-solid fa-angle-right"></i></a>
            @endif

            {{-- Last Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pg-btn ajax-page"><i class="fa-solid fa-angles-right"></i></a>
            @else
                <a class="pg-btn disabled"><i class="fa-solid fa-angles-right"></i></a>
            @endif
        </div>
    </div>
@endif
