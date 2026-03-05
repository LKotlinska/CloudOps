<nav class="pagination" aria-label="Page navigation">
    <div class="pagination-info" aria-live="polite">
        @if ($paginator->hasPages())
            {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        @else
            {{ $paginator->total() }} {{ Str::plural('item', $paginator->total()) }}
        @endif
    </div>

    @if ($paginator->hasPages())
    <div class="pagination-btns">
        @if ($paginator->onFirstPage())
            <span class="page-btn" aria-disabled="true" aria-label="Previous page">‹</span>
        @else
            <a class="page-btn" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous page">‹</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-btn" aria-hidden="true">…</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-btn active" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="page-btn" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="page-btn" href="{{ $paginator->nextPageUrl() }}" aria-label="Next page">›</a>
        @else
            <span class="page-btn" aria-disabled="true" aria-label="Next page">›</span>
        @endif
    </div>
    @endif
</nav>
