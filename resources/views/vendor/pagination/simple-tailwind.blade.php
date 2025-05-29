@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-not-allowed">
                &laquo; Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                &laquo; Sebelumnya
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                Selanjutnya &raquo;
            </a>
        @else
            <span class="px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-not-allowed">
                Selanjutnya &raquo;
            </span>
        @endif
    </nav>
@endif
