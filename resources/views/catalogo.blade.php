@extends('layouts.app')

@section('content')
@php
  $wa = '51902205964';
  $waMsg = fn($txt) => "https://wa.me/{$wa}?text=".rawurlencode($txt);
@endphp

<div class="relative min-h-screen w-full">

  {{-- BACKGROUND --}}
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <div class="absolute -top-52 -left-52 h-[720px] w-[720px] rounded-full bg-sky-500/25 blur-3xl"></div>
    <div class="absolute top-0 -right-52 h-[720px] w-[720px] rounded-full bg-violet-500/25 blur-3xl"></div>
    <div class="absolute bottom-[-260px] left-1/3 h-[720px] w-[720px] rounded-full bg-fuchsia-500/20 blur-3xl"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,rgba(0,0,0,.40)_55%,rgba(0,0,0,.90)_100%)]"></div>
  </div>

  {{-- HEADER --}}
  <header class="max-w-7xl mx-auto px-5 sm:px-6 pt-8 pb-5 flex items-center justify-between">
    <a href="/" class="flex items-center gap-3">
      <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10 grid place-items-center">
        <img src="{{asset('img/logo-noctair.png')}}" alt="N" class="h-10 w-10 object-cover" onerror="this.innerHTML='<span class=&quot;font-bold&quot;>N</span>'">
      </div>
      <div class="leading-tight">
        <div class="font-semibold text-lg">NOCTAIR</div>
        <div class="text-[11px] text-white/60 -mt-0.5">Catálogo</div>
      </div>
    </a>
    <a href="{{$waMsg('Hola NOCTAIR 👋 Quiero el catálogo completo y precios.')}}" target="_blank" rel="noopener" class="btn-whatsapp px-5 py-2 text-sm">Comprar por WhatsApp</a>
  </header>

  {{-- FILTROS --}}
  <section class="max-w-7xl mx-auto px-5 sm:px-6 pb-5">
    <div class="rounded-2xl bg-white/5 border border-white/10 p-4 sm:p-5">
      
      {{-- Título compacto --}}
      <div class="mb-4">
        <h1 class="text-xl sm:text-2xl font-semibold">Catálogo</h1>
        <p class="text-xs text-white/60 mt-0.5">Filtra y encuentra tu perfume ideal</p>
      </div>

      {{-- Formulario compacto --}}
      <form method="GET" action="{{route('catalogo')}}" class="grid sm:grid-cols-4 gap-2.5">
        
        {{-- Buscar --}}
        <div class="sm:col-span-2">
          <input 
            name="q" 
            value="{{$q??''}}" 
            placeholder="Buscar perfume o marca..." 
            class="w-full rounded-xl bg-black/30 border border-white/10 px-3 py-2.5 text-sm outline-none placeholder:text-white/40 focus:border-sky-400/50 focus:ring-1 focus:ring-sky-400/20 transition"
          />
        </div>

        {{-- Marca --}}
        <div>
          <select 
            name="marca" 
            class="w-full rounded-xl bg-black/30 border border-white/10 px-3 py-2.5 text-sm outline-none focus:border-sky-400/50 focus:ring-1 focus:ring-sky-400/20 transition"
          >
            <option value="">Todas las marcas</option>
            @foreach($marcas??[] as $m)
              <option value="{{$m}}" @selected(($marcaSel??'')===$m)>{{$m}}</option>
            @endforeach
          </select>
        </div>

        {{-- Orden --}}
        <div>
          <select 
            name="order" 
            class="w-full rounded-xl bg-black/30 border border-white/10 px-3 py-2.5 text-sm outline-none focus:border-sky-400/50 focus:ring-1 focus:ring-sky-400/20 transition"
          >
            @foreach([
              ''=>'Ordenar',
              'price_asc'=>'Precio: menor',
              'price_desc'=>'Precio: mayor'
            ] as $k=>$v)
              <option value="{{$k}}" @selected(($orderSel??'')===$k)>{{$v}}</option>
            @endforeach
          </select>
        </div>

        {{-- Botones compactos --}}
        <div class="sm:col-span-4 flex gap-2 mt-1">
          <button class="btn-whatsapp px-4 py-2 text-xs font-semibold">Aplicar</button>
          <a href="{{route('catalogo')}}" class="rounded-lg px-4 py-2 text-xs font-semibold bg-white/10 border border-white/10 hover:bg-white/15 transition">Limpiar</a>
        </div>
      </form>

    </div>
  </section>

  {{-- PRODUCTOS --}}
  <section class="max-w-7xl mx-auto px-5 sm:px-6 pb-16">
    @if(($productos??collect())->isEmpty())
      <div class="rounded-[24px] bg-white/5 border border-white/10 p-10 text-center text-white/70">
        No se encontraron productos con esos filtros.
      </div>
    @else
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($productos as $p)
          <article class="rounded-[24px] bg-white/5 border border-white/10 overflow-hidden hover:bg-white/10 transition">
            <div class="bg-white/5 border-b border-white/10 p-4">
              <img 
                src="{{asset('img/'.$p['img'])}}" 
                onerror="this.src='{{asset('img/logo-noctair.png')}}';this.classList.add('opacity-50')" 
                alt="{{$p['nombre']}}" 
                class="w-full h-[220px] object-contain rounded-xl" 
                loading="lazy"
              >
            </div>

            <div class="p-5">
              <div class="text-xs text-white/60">{{$p['marca']}}</div>
              <h3 class="mt-1 font-semibold text-lg leading-tight">{{$p['nombre']}}</h3>

              <div class="mt-3 flex items-center justify-between gap-3">
                <div class="text-white font-semibold text-xl">S/ {{number_format($p['precio'],2)}}</div>
                <a href="{{$waMsg('Hola NOCTAIR 👋 Quiero comprar: '.$p['nombre'].' ('.$p['marca'].'). ¿Precio final y envío?')}}" target="_blank" rel="noopener" class="btn-whatsapp px-4 py-2 text-sm whitespace-nowrap">Comprar</a>
              </div>

              <a href="{{$waMsg('Hola NOCTAIR 📌 ¿Tienes recomendaciones similares a: '.$p['nombre'].'?')}}" target="_blank" rel="noopener" class="mt-3 inline-flex text-sm text-white/70 hover:text-white transition">Pedir recomendación →</a>
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </section>

</div>
@endsection