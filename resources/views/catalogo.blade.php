@extends('layouts.app')

@section('content')
@php
  $wa = '51902205964';
  $waMsg = fn($txt) => "https://wa.me/{$wa}?text=" . rawurlencode($txt);
@endphp

<div class="relative min-h-screen w-full">

  {{-- Background Gradient --}}
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <div class="absolute -top-52 -left-52 h-[720px] w-[720px] rounded-full bg-sky-500/20 blur-3xl"></div>
    <div class="absolute top-0 -right-52 h-[720px] w-[720px] rounded-full bg-violet-500/20 blur-3xl"></div>
    <div class="absolute bottom-[-260px] left-1/3 h-[720px] w-[720px] rounded-full bg-fuchsia-500/15 blur-3xl"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/90"></div>
  </div>

  {{-- Header --}}
  <header class="max-w-7xl mx-auto px-5 sm:px-6 pt-8 pb-6 flex items-center justify-between">
    <a href="/" class="flex items-center gap-3 group">
      <div class="h-10 w-10 rounded-xl bg-white/10 border border-white/20 overflow-hidden group-hover:border-white/30 transition">
        <img src="{{ asset('img/logo-noctair.png') }}" alt="NOCTAIR" class="h-full w-full object-cover">
      </div>
      <div class="leading-tight">
        <div class="font-semibold text-lg tracking-tight">NOCTAIR</div>
        <div class="text-[11px] text-white/50">Catálogo</div>
      </div>
    </a>
    <a href="{{ $waMsg('Hola NOCTAIR 👋 Quiero el catálogo completo y precios.') }}" target="_blank" rel="noopener" class="btn-whatsapp px-5 py-2.5 text-sm font-medium">
      Comprar por WhatsApp
    </a>
  </header>

  {{-- Filters Section --}}
  <section class="max-w-7xl mx-auto px-5 sm:px-6 pb-6">
    <div class="rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 p-5 sm:p-6">
      
      <div class="mb-5">
        <h1 class="text-2xl font-semibold tracking-tight">Catálogo</h1>
        <p class="text-sm text-white/50 mt-1">Filtra y encuentra tu perfume ideal</p>
      </div>

      <form method="GET" action="{{ route('catalogo') }}" class="space-y-3">
        
        <div class="grid sm:grid-cols-3 gap-3">
          {{-- Search Input --}}
          <input 
            name="q" 
            value="{{ $q ?? '' }}" 
            placeholder="Buscar perfume o marca..." 
            class="rounded-xl bg-black/30 border border-white/10 px-4 py-2.5 text-sm outline-none placeholder:text-white/40 focus:border-sky-400/50 focus:ring-2 focus:ring-sky-400/10 transition"
          />

          {{-- Brand Filter --}}
          <select 
            name="marca" 
            class="rounded-xl bg-black/30 border border-white/10 px-4 py-2.5 text-sm outline-none focus:border-sky-400/50 focus:ring-2 focus:ring-sky-400/10 transition"
          >
            <option value="">Todas las marcas</option>
            @foreach($marcas ?? [] as $m)
              <option value="{{ $m }}" @selected(($marcaSel ?? '') === $m)>{{ $m }}</option>
            @endforeach
          </select>

          {{-- Sort Order --}}
          <select 
            name="order" 
            class="rounded-xl bg-black/30 border border-white/10 px-4 py-2.5 text-sm outline-none focus:border-sky-400/50 focus:ring-2 focus:ring-sky-400/10 transition"
          >
            @foreach([''=>'Ordenar', 'price_asc'=>'Precio: menor', 'price_desc'=>'Precio: mayor'] as $k => $v)
              <option value="{{ $k }}" @selected(($orderSel ?? '') === $k)>{{ $v }}</option>
            @endforeach
          </select>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-2">
          <button type="submit" class="btn-whatsapp px-5 py-2.5 text-sm font-medium">
            Aplicar filtros
          </button>
          <a href="{{ route('catalogo') }}" class="rounded-xl px-5 py-2.5 text-sm font-medium bg-white/5 border border-white/10 hover:bg-white/10 transition">
            Limpiar
          </a>
        </div>
      </form>

    </div>
  </section>

  {{-- Products Grid --}}
  <section class="max-w-7xl mx-auto px-5 sm:px-6 pb-20">
    @if(($productos ?? collect())->isEmpty())
      <div class="rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 p-12 text-center">
        <div class="text-white/40 text-sm">No se encontraron productos con esos filtros.</div>
      </div>
    @else
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($productos as $p)
          <article class="group rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 overflow-hidden hover:bg-white/[0.07] hover:border-white/20 transition-all duration-300">
            
            {{-- Product Image --}}
            <div class="relative bg-gradient-to-br from-white/5 to-transparent border-b border-white/10 p-6">
              <img 
                src="{{ asset('img/' . $p['img']) }}" 
                onerror="this.src='{{ asset('img/logo-noctair.png') }}'; this.classList.add('opacity-30')" 
                alt="{{ $p['nombre'] }}" 
                class="w-full h-[200px] object-contain rounded-lg transition-transform duration-300 group-hover:scale-105" 
                loading="lazy"
              >
            </div>

            {{-- Product Info --}}
            <div class="p-5">
              <div class="text-xs font-medium text-white/50 tracking-wide uppercase">{{ $p['marca'] }}</div>
              <h3 class="mt-1.5 font-semibold text-base leading-tight line-clamp-2">{{ $p['nombre'] }}</h3>

              <div class="mt-4 flex items-center justify-between gap-3">
                <div class="text-white font-bold text-xl">S/ {{ number_format($p['precio'], 2) }}</div>
                <a 
                  href="{{ $waMsg('Hola NOCTAIR 👋 Quiero comprar: ' . $p['nombre'] . ' (' . $p['marca'] . '). ¿Precio final y envío?') }}" 
                  target="_blank" 
                  rel="noopener" 
                  class="btn-whatsapp px-4 py-2 text-sm font-medium whitespace-nowrap"
                >
                  Comprar
                </a>
              </div>

              <a 
                href="{{ $waMsg('Hola NOCTAIR 📌 ¿Tienes recomendaciones similares a: ' . $p['nombre'] . '?') }}" 
                target="_blank" 
                rel="noopener" 
                class="mt-3 inline-flex items-center text-sm text-white/60 hover:text-white transition group"
              >
                Pedir recomendación
                <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
              </a>
            </div>
          </article>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="mt-10 flex justify-center">
        {{ $productos->onEachSide(1)->links('vendor.pagination.noctair') }}
      </div>
    @endif
  </section>

</div>
@endsection