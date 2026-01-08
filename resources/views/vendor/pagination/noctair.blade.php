@if ($paginator->hasPages())
  <nav role="navigation" aria-label="Pagination Navigation" class="inline-flex items-center gap-2">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
      <span class="h-10 w-10 grid place-items-center rounded-lg bg-white/10 text-white/30 select-none">
        ‹
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}"
         class="h-10 w-10 grid place-items-center rounded-lg bg-white/10 text-white/80 hover:bg-white/15 transition">
        ‹
      </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
      @if (is_string($element))
        <span class="h-10 px-3 grid place-items-center rounded-lg bg-white/10 text-white/60 select-none">
          {{ $element }}
        </span>
      @endif

      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span class="h-10 w-10 grid place-items-center rounded-lg bg-blue-600 text-white font-semibold select-none">
              {{ $page }}
            </span>
          @else
            <a href="{{ $url }}"
               class="h-10 w-10 grid place-items-center rounded-lg bg-white/10 text-white/80 hover:bg-white/15 transition">
              {{ $page }}
            </a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}"
         class="h-10 w-10 grid place-items-center rounded-lg bg-white/10 text-white/80 hover:bg-white/15 transition">
        ›
      </a>
    @else
      <span class="h-10 w-10 grid place-items-center rounded-lg bg-white/10 text-white/30 select-none">
        ›
      </span>
    @endif

  </nav>
@endif
