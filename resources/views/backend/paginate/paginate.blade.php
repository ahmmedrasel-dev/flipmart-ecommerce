<div class="d-flex d-flex justify-content-between">
    <div class="pagination">
        <span>Showing Items- {{ $paginator->count() }} / Page No- {{ $paginator->currentPage() }} / Total Items- {{ $paginator->total() }}.</span>
    </div>
    <ul class="pagination justify-content-end pagination-sm">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">Previous</a>
        </li>
        @endif

        @for ($i = 1; $i <= $paginator->lastPage(); $i ++)
            <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endfor

      @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
        </li>
      @else
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
      @endif
    </ul>
</div>
