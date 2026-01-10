@extends('layouts.app')

@section('content')
@php
  $wa = '51902205964';
  $waMsg = fn($txt) => "https://wa.me/{$wa}?text=".rawurlencode($txt);
  $catalogoUrl = route('catalogo');
@endphp

<div class="relative w-full">

  {{-- BACKGROUND MINIMALISTA --}}
  <div class="fixed inset-0 -z-10 overflow-hidden bg-black">
    <div class="absolute -top-1/2 -left-1/4 h-[800px] w-[800px] rounded-full bg-amber-500/8 blur-[120px]"></div>
    <div class="absolute top-1/4 -right-1/4 h-[800px] w-[800px] rounded-full bg-rose-500/6 blur-[120px]"></div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[600px] w-[600px] rounded-full bg-violet-500/5 blur-[100px]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,rgba(0,0,0,.4)_100%)]"></div>
    <div class="absolute inset-0 opacity-[.03]" style="background-image:linear-gradient(to right,rgba(255,255,255,.08) 1px,transparent 1px),linear-gradient(to bottom,rgba(255,255,255,.08) 1px,transparent 1px);background-size:64px 64px;"></div>
  </div>

  {{-- NAVBAR MINIMALISTA --}}
  <header class="fixed top-0 left-0 right-0 z-[9999] border-b border-white/5 bg-black/40 backdrop-blur-2xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        
        {{-- Logo --}}
        <a href="#inicio" class="flex items-center gap-3 group">
          <div class="relative h-11 w-11 rounded-2xl bg-gradient-to-br from-white/10 to-white/5 border border-white/10 overflow-hidden group-hover:border-white/20 transition-all">
            <img src="{{asset('img/logo-noctair.png')}}" alt="NOCTAIR" class="h-full w-full object-cover" loading="eager" onerror="this.style.display='none';this.nextElementSibling.classList.remove('hidden')">
            <span class="hidden absolute inset-0 grid place-items-center font-serif font-semibold text-lg text-white/90">N</span>
          </div>
          <div class="hidden sm:block">
            <div class="font-medium tracking-wide text-white text-lg">NOCTAIR</div>
            <div class="text-[10px] text-white/40 uppercase tracking-widest -mt-0.5">Perfumes</div>
          </div>
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden lg:flex items-center gap-1">
          @foreach(['inicio'=>'Inicio','quienes'=>'Nosotros','catalogo'=>'Catálogo','faq'=>'FAQ','resenas'=>'Reseñas'] as $id=>$txt)
            <a href="{{$id==='catalogo'?$catalogoUrl:'#'.$id}}" 
                class="px-4 py-2 text-sm text-white/60 hover:text-white hover:bg-white/5 rounded-lg transition-all">
              {{$txt}}
            </a>
          @endforeach
        </nav>

        {{-- CTA + Menu --}}
        <div class="flex items-center gap-3">
          <a href="{{$waMsg('Hola NOCTAIR, quiero información sobre perfumes')}}" 
              target="_blank" 
              class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-white text-black text-sm font-medium rounded-lg hover:bg-white/90 transition-all">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            WhatsApp
          </a>
          
          <button id="menuBtn" 
                  class="lg:hidden h-11 w-11 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 grid place-items-center transition-all"
                  aria-label="Menú"
                  aria-expanded="false">
            <svg id="iconOpen" class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" d="M3 12h18M3 6h18M3 18h18"/>
            </svg>
            <svg id="iconClose" class="hidden h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>

  {{-- MOBILE MENU --}}
  <div id="menuOverlay" class="fixed inset-0 z-[9998] hidden bg-black/80 backdrop-blur-sm"></div>
  <aside id="mobileMenu" class="fixed top-20 right-0 bottom-0 z-[9999] hidden w-full max-w-sm bg-black/95 backdrop-blur-2xl border-l border-white/10">
    <nav class="flex flex-col p-6 gap-2">
      @foreach(['inicio'=>'Inicio','quienes'=>'Nosotros','catalogo'=>'Catálogo','faq'=>'FAQ','resenas'=>'Reseñas'] as $id=>$txt)
        <a href="{{$id==='catalogo'?$catalogoUrl:'#'.$id}}" 
            class="mobile-link px-5 py-4 rounded-xl bg-white/5 border border-white/10 text-white/80 hover:bg-white/10 hover:text-white transition-all">
          {{$txt}}
        </a>
      @endforeach
      <a href="{{$waMsg('Hola NOCTAIR, quiero información sobre perfumes')}}" 
          target="_blank"
          class="mt-4 px-5 py-4 rounded-xl bg-white text-black text-center font-medium hover:bg-white/90 transition-all">
        Contactar por WhatsApp
      </a>
    </nav>
  </aside>

  {{-- HERO SECTION --}}
  <section id="inicio" class="relative pt-32 sm:pt-10 pb-20 sm:pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      {{-- Watermark --}}
      <div class="pointer-events-none absolute inset-0 flex items-center justify-center opacity-30">
        <span class="font-serif font-light tracking-[0.3em] text-[clamp(60px,12vw,180px)] text-white/[0.015] select-none">
          KHAMRAH
        </span>
      </div>

      <div class="relative grid xl:grid-cols-2 gap-12 xl:gap-20 items-center">
        
        {{-- Content --}}
        <div class="space-y-5 max-w-xl lg:max-w-none">
          
          {{-- Badge --}}
          <div class="inline-flex items-center gap-2.5 rounded-full px-4 py-2 bg-gradient-to-r from-amber-500/10 to-rose-500/10 border border-amber-500/20">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse"></span>
            <span class="text-[10px] text-amber-200/80 uppercase tracking-[0.2em] font-medium">Edición Árabe Exclusiva</span>
          </div>

          {{-- Title --}}
          <div class="space-y-4">
            <h1 class="font-serif font-normal tracking-tight text-[clamp(40px,7vw,72px)] leading-[0.9] text-white">
              Khamrah
            </h1>
            <p class="text-amber-200/50 text-sm tracking-[0.35em] uppercase font-light">
              Extrait de Parfum
            </p>
          </div>

          {{-- Description --}}
          <p class="text-white/50 text-base sm:text-lg leading-relaxed font-light max-w-lg">
            Una sinfonía olfativa oriental donde la canela especiada se entrelaza con dátiles 
            caramelizados y praliné. El ámbar dorado y la vainilla bourbon crean una estela 
            hipnótica de sofisticación absoluta.
          </p>

          {{-- Specs --}}
          <div class="flex flex-wrap gap-10 sm:gap-12 pt-4">
            <div class="space-y-2">
              <div class="text-3xl sm:text-4xl font-light text-white">100ml</div>
              <div class="text-xs text-white/30 uppercase tracking-[0.15em]">Volumen</div>
            </div>
            <div class="h-14 w-px bg-white/10"></div>
            <div class="space-y-2">
              <div class="text-3xl sm:text-4xl font-light text-white">12h+</div>
              <div class="text-xs text-white/30 uppercase tracking-[0.15em]">Duración</div>
            </div>
            <div class="h-14 w-px bg-white/10"></div>
            <div class="space-y-2">
              <div class="text-3xl sm:text-4xl font-light text-white">Unisex</div>
              <div class="text-xs text-white/30 uppercase tracking-[0.15em]">Género</div>
            </div>
          </div>

          {{-- CTAs --}}
          <div class="flex flex-col sm:flex-row gap-4 pt-6">
            <a href="{{$waMsg('Hola NOCTAIR, quiero información sobre Khamrah EDP')}}"
                target="_blank"
                class="group relative px-8 py-4 bg-white text-black text-sm font-medium tracking-wide text-center overflow-hidden hover:shadow-2xl hover:shadow-white/10 transition-all">
              <span class="relative z-10">Adquirir ahora</span>
              <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-rose-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            <a href="{{$catalogoUrl}}"
                class="px-8 py-4 border border-white/20 text-white text-sm font-medium tracking-wide text-center hover:bg-white/5 hover:border-white/30 transition-all">
              Explorar colección
            </a>
          </div>

          {{-- Notes --}}
          <div class="pt-8 space-y-4">
            <div class="text-[10px] text-white/30 uppercase tracking-[0.25em]">Notas principales</div>
            <div class="flex flex-wrap gap-2.5">
              @foreach(['Oud · Ámbar', 'Vainilla bourbon', 'Especias orientales', 'Rosa damascena'] as $nota)
                <span class="px-4 py-2 text-xs text-white/60 border border-white/10 font-light rounded hover:border-white/20 transition-colors">
                  {{ $nota }}
                </span>
              @endforeach
            </div>
          </div>
        </div>

        {{-- Product Image --}}
        <div class="relative lg:pl-12">
          
          {{-- Ambient Glow --}}
          <div class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[350px] w-[350px] rounded-full bg-gradient-to-br from-amber-500/15 via-rose-500/10 to-violet-500/5 blur-[100px]"></div>

          {{-- Decorative Rings --}}
          <div class="absolute -inset-12 rounded-full border border-white/[0.03]"></div>
          <div class="absolute -inset-20 rounded-full border border-white/[0.02]"></div>

          {{-- Image Container --}}
          <div class="relative flex justify-center items-center min-h-[400px] sm:min-h-[100px]">
            <img
              src="{{ asset('img/khamrah.png') }}"
              alt="Khamrah Extrait de Parfum by Lattafa"
              class="relative z-10 h-[500px] sm:h-[450px] lg:h-[580px] object-contain 
                      drop-shadow-[0_60px_120px_rgba(0,0,0,0.7)]
                      translate-x-4 sm:translate-x-8 lg:translate-x-12
                      hover:scale-[1.03] transition-transform duration-700 ease-out"
              loading="eager"
            />
            
            {{-- Subtle Reflection --}}
            <div class="pointer-events-none absolute bottom-0 left-1/2 -translate-x-1/2 
            h-40 w-80 bg-gradient-to-t from-white/[0.03] to-transparent blur-3xl"></div>
          </div>

          {{-- Brand Info Card --}}
          <div class="mt-05 flex items-center justify-between p-5 rounded-2xl border border-white/10 bg-black/30 backdrop-blur-xl">
            <div class="space-y-1.5">
              <div class="text-sm font-medium tracking-wide uppercase text-white/90">Lattafa Perfumes</div>
              <div class="text-xs text-white/40 font-light">Dubai, UAE · Oriental Luxury</div>
            </div>
            <div class="flex gap-1">
              @for($i = 0; $i < 5; $i++)
                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 
                  1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 
                  1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 
                  8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              @endfor
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ABOUT SECTION --}}
  <section id="quienes" class="relative py-24 sm:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="max-w-2xl mx-auto text-center mb-16 sm:mb-20">
        <h2 class="font-serif font-normal text-4xl sm:text-5xl lg:text-6xl tracking-tight text-white">
          Sobre nosotros
        </h2>
        <p class="mt-6 text-white/50 text-base sm:text-lg font-light">
          Conoce quiénes somos, qué nos mueve y hacia dónde vamos.
        </p>
      </div>

      <div class="grid gap-6 md:grid-cols-3">
        @foreach([
          ['Quiénes somos','Somos NOCTAIR, una marca enfocada en perfumes con estilo y presencia. Te ayudamos a elegir según tu personalidad, clima y ocasión.','Hablar con un asesor','wa'],
          ['Misión','Ofrecer una experiencia premium con recomendaciones claras, atención rápida y compra directa por WhatsApp.','Ver catálogo','catalogo'],
          ['Visión','Ser una marca referente por estilo, atención y perfumes que destaquen en cada ocasión.','Consultar','wa']
        ] as $item)
          <div class="group rounded-3xl bg-white/[0.02] border border-white/10 p-8 hover:bg-white/[0.04] hover:border-white/15 transition-all duration-300">
            <h3 class="text-xl sm:text-2xl font-medium text-white mb-4">{{$item[0]}}</h3>
            <p class="text-white/60 text-sm sm:text-base leading-relaxed font-light mb-6">{{$item[1]}}</p>
            <a href="{{$item[3]==='catalogo'?$catalogoUrl:$waMsg('Hola NOCTAIR, quiero asesoría para elegir un perfume')}}" 
                {{$item[3]==='wa'?'target="_blank"':''}}
                class="inline-flex items-center gap-2 text-sm text-white/50 hover:text-white transition-colors group-hover:gap-3 duration-300">
              {{$item[2]}}
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CATALOG SECTION --}}
  <section id="catalogo" class="relative py-24 sm:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="max-w-2xl mx-auto text-center mb-16 sm:mb-20">
        <h2 class="font-serif font-normal text-4xl sm:text-5xl lg:text-6xl tracking-tight text-white">
          Catálogo
        </h2>
        <p class="mt-6 text-white/50 text-base sm:text-lg font-light">
          Explora y filtra perfumes en nuestra página de catálogo.
        </p>
      </div>

      <div class="grid gap-6 md:grid-cols-2 max-w-5xl mx-auto">
        @foreach([
          ['Explorar catálogo','Encuentra tu perfume por marca, precio o recomendaciones para día/noche.','Ir al catálogo','catalogo','border-white/20 hover:bg-white/5'],
          ['Compra directa','Consulta precio y entrega. Coordinación rápida por WhatsApp.','Comprar por WhatsApp','wa','bg-white text-black hover:bg-white/90']
        ] as $c)
          <div class="group rounded-3xl bg-white/[0.02] border border-white/10 p-8 sm:p-10 hover:bg-white/[0.04] hover:border-white/15 transition-all duration-300">
            <h3 class="text-xl sm:text-2xl font-medium text-white mb-4">{{$c[0]}}</h3>
            <p class="text-white/60 text-sm sm:text-base leading-relaxed font-light mb-8">{{$c[1]}}</p>
            <a href="{{$c[3]==='catalogo'?$catalogoUrl:$waMsg('Hola NOCTAIR, quiero comprar perfumes')}}" 
                {{$c[3]==='wa'?'target="_blank"':''}}
                class="inline-flex items-center justify-center w-full px-8 py-4 border {{$c[4]}} text-sm font-medium tracking-wide transition-all">
              {{$c[2]}}
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- FAQ SECTION --}}
  <section id="faq" class="relative py-24 sm:py-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="max-w-2xl mx-auto text-center mb-16 sm:mb-20">
        <h2 class="font-serif font-normal text-4xl sm:text-5xl lg:text-6xl tracking-tight text-white">
          FAQ
        </h2>
        <p class="mt-6 text-white/50 text-base sm:text-lg font-light">
          Resolvemos tus dudas antes de comprar.
        </p>
      </div>

      <div class="space-y-4">
        @foreach([
          ['¿Me ayudan a elegir el perfume según mi estilo?','Sí. Te asesoramos según ocasión, clima y tipo de aroma que buscas.'],
          ['¿Cuánto dura el aroma?','Depende de tu piel y del perfume. Te recomendamos opciones con buena duración.'],
          ['¿Hacen envíos?','Sí. Coordinamos el envío y tiempos según tu zona.'],
          ['¿Cuál es mejor para día o para noche?','Día: aromas frescos. Noche: aromas intensos y amaderados.']
        ] as $faq)
          <details class="group rounded-2xl bg-white/[0.02] border border-white/10 p-6 sm:p-8 hover:bg-white/[0.04] hover:border-white/15 transition-all">
            <summary class="cursor-pointer list-none flex items-start justify-between gap-4">
              <span class="font-medium text-white/90 text-base sm:text-lg">{{$faq[0]}}</span>
              <span class="text-white/40 group-open:rotate-45 transition-transform duration-300 text-2xl flex-shrink-0">+</span>
            </summary>
            <div class="mt-4 space-y-4">
              <p class="text-white/60 text-sm sm:text-base leading-relaxed font-light">{{$faq[1]}}</p>
              <a href="{{$waMsg('Hola NOCTAIR, tengo una pregunta: '.$faq[0])}}" 
                  target="_blank"
                  class="inline-flex items-center gap-2 text-sm text-white/50 hover:text-white transition-colors">
                Preguntar por WhatsApp
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
              </a>
            </div>
          </details>
        @endforeach
      </div>
    </div>
  </section>

  {{-- REVIEWS SECTION --}}
  <section id="resenas" class="relative py-24 sm:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="max-w-2xl mx-auto text-center mb-16 sm:mb-20">
        <h2 class="font-serif font-normal text-4xl sm:text-5xl lg:text-6xl tracking-tight text-white">
          Reseñas
        </h2>
        <p class="mt-6 text-white/50 text-base sm:text-lg font-light">
          Opiniones reales de clientes satisfechos.
        </p>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach([
          ['Andrea M.',5,'Me recomendaron uno para uso diario y quedó perfecto. La atención fue excelente.'],
          ['Luis R.',5,'Atención rápida por WhatsApp. Elegí uno para noche y fue un éxito total.'],
          ['Karla S.',5,'Presentación profesional y buen precio. Sin duda volvería a comprar.']
        ] as $idx => $review)
          <article class="rounded-3xl bg-white/[0.02] border border-white/10 p-6 sm:p-8 hover:bg-white/[0.04]
                    hover:border-white/15 transition-all duration-300">
            <div class="flex items-center gap-4 mb-6">
              <div class="h-12 w-12 rounded-full bg-gradient-to-br from-amber-400/20 to-rose-400/20 border
                    border-white/10 grid place-items-center">
                <span class="font-serif font-medium text-white">{{substr($review[0], 0, 1)}}</span>
              </div>
              <div class="flex-1 min-w-0">
                <div class="font-medium text-white">{{$review[0]}}</div>
                <div class="flex items-center gap-2 mt-1">
                  <div class="flex gap-0.5">
                    @for($i=0;$i<$review[1];$i++)
                      <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                      </svg>
                    @endfor
                  </div>
                  <span class="text-xs text-white/30">Compra verificada</span>
                </div>
              </div>
            </div>
            <p class="text-white/60 text-sm sm:text-base leading-relaxed font-light">
              "{{$review[2]}}"
            </p>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  <footer class="relative py-20 sm:py-24 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4 mb-16">
        
        {{-- Brand --}}
        <div class="lg:col-span-2 space-y-6">
          <div class="flex items-center gap-3">
            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-white/10 to-white/5 border border-white/10 overflow-hidden">
              <img src="{{asset('img/logo-noctair.png')}}" alt="NOCTAIR" class="h-full w-full object-cover" onerror="this.style.display='none';this.nextElementSibling.classList.remove('hidden')">
              <span class="hidden grid place-items-center h-full font-serif font-semibold text-xl text-white/90">N</span>
            </div>
            <div>
              <div class="font-medium tracking-wide text-white text-lg">NOCTAIR</div>
              <div class="text-xs text-white/30 uppercase tracking-widest">Perfumes</div>
            </div>
          </div>
          <p class="text-white/50 text-sm sm:text-base leading-relaxed font-light max-w-md">
            Perfumes con presencia para día y noche. Asesoría personalizada y atención premium por WhatsApp.
          </p>
          <a href="{{$waMsg('Hola NOCTAIR, quiero información sobre perfumes')}}" 
              target="_blank"
              class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black text-sm font-medium rounded-lg hover:bg-white/90 transition-all">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Contactar por WhatsApp
          </a>
        </div>

        {{-- Quick Links --}}
        <div class="space-y-5">
          <h3 class="font-medium text-white text-sm uppercase tracking-wider">Enlaces rápidos</h3>
          <nav class="flex flex-col gap-3">
            @foreach(['inicio'=>'Inicio','quienes'=>'Nosotros','catalogo'=>'Catálogo','faq'=>'FAQ','resenas'=>'Reseñas'] as $id=>$txt)
              <a href="{{$id==='catalogo'?$catalogoUrl:'#'.$id}}" 
                  class="text-white/50 hover:text-white transition-colors text-sm">
                {{$txt}}
              </a>
            @endforeach
          </nav>
        </div>

        {{-- Social --}}
        <div class="space-y-5">
          <h3 class="font-medium text-white text-sm uppercase tracking-wider">Síguenos</h3>
          <div class="flex gap-3">
            @foreach([
              ['https://facebook.com/noctair','M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z','Facebook'],
              ['https://instagram.com/noctair','M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M6.5 2h11A4.5 4.5 0 0122 6.5v11a4.5 4.5 0 01-4.5 4.5h-11A4.5 4.5 0 012 17.5v-11A4.5 4.5 0 016.5 2z','Instagram'],
              ['https://tiktok.com/@noctair','M9 12a4 4 0 100 8 4 4 0 000-8zm11-5.5V12a7 7 0 01-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.96 8.96 0 0013 21a9 9 0 009-9V6.5h-2z','TikTok']
            ] as $social)
              <a href="{{$social[0]}}" 
                  target="_blank"
                  class="h-11 w-11 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20 grid place-items-center transition-all group"
                  aria-label="{{$social[2]}}">
                <svg class="h-5 w-5 text-white/60 group-hover:text-white transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="{{$social[1]}}"/>
                </svg>
              </a>
            @endforeach
          </div>
        </div>

      </div>

      {{-- Bottom --}}
      <div class="pt-8 border-t border-white/5 text-center">
        <p class="text-xs text-white/30 font-light">
          © {{date('Y')}} NOCTAIR · Todos los derechos reservados · Experiencia premium en perfumes
        </p>
      </div>
    </div>
  </footer>

  {{-- WHATSAPP FLOAT BUTTON --}}
  <a href="{{$waMsg('Hola NOCTAIR, quiero información sobre perfumes')}}" 
      class="fixed bottom-6 right-6 z-[9997] h-14 w-14 rounded-full bg-[#25D366] hover:bg-[#20BD5A] shadow-2xl shadow-[#25D366]/30 hover:shadow-[#25D366]/50 grid place-items-center transition-all hover:scale-110 group"
      target="_blank"
      aria-label="WhatsApp">
    <svg class="h-7 w-7 text-white group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
  </a>

</div>

{{-- SCRIPTS --}}
<script>
(function() {
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  const menuOverlay = document.getElementById('menuOverlay');
  const iconOpen = document.getElementById('iconOpen');
  const iconClose = document.getElementById('iconClose');
  const mobileLinks = document.querySelectorAll('.mobile-link');

  function openMenu() {
    mobileMenu?.classList.remove('hidden');
    menuOverlay?.classList.remove('hidden');
    iconOpen?.classList.add('hidden');
    iconClose?.classList.remove('hidden');
    menuBtn?.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    mobileMenu?.classList.add('hidden');
    menuOverlay?.classList.add('hidden');
    iconOpen?.classList.remove('hidden');
    iconClose?.classList.add('hidden');
    menuBtn?.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }

  menuBtn?.addEventListener('click', () => {
    menuBtn.getAttribute('aria-expanded') === 'true' ? closeMenu() : openMenu();
  });

  menuOverlay?.addEventListener('click', closeMenu);
  mobileLinks.forEach(link => link.addEventListener('click', closeMenu));
  
  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeMenu();
  });

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (href !== '#' && href.length > 1) {
        e.preventDefault();
        const target = document.querySelector(href);
        if (target) {
          const offsetTop = target.offsetTop - 80;
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }
      }
    });
  });
})();
</script>
@endsection