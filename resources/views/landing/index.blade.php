@extends('layouts.app')

@section('content')
@php
  $wa = '51902205964';
  $waMsg = fn($txt) => "https://wa.me/{$wa}?text=".rawurlencode($txt);
  $catalogoUrl = route('catalogo');
@endphp

<div class="relative w-full pt-[76px]">

  {{-- BACKGROUND --}}
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <div class="absolute -top-52 -left-52 h-[720px] w-[720px] rounded-full bg-sky-500/25 blur-3xl"></div>
    <div class="absolute top-0 -right-52 h-[720px] w-[720px] rounded-full bg-violet-500/25 blur-3xl"></div>
    <div class="absolute bottom-[-260px] left-1/3 h-[720px] w-[720px] rounded-full bg-fuchsia-500/20 blur-3xl"></div>
    <div class="absolute inset-0 opacity-70" style="background-image:radial-gradient(circle at 20% 20%,rgba(255,255,255,.07),transparent 42%),radial-gradient(circle at 80% 0%,rgba(56,189,248,.22),transparent 38%),radial-gradient(circle at 60% 90%,rgba(168,85,247,.20),transparent 42%);"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,rgba(0,0,0,.35)_55%,rgba(0,0,0,.86)_100%)]"></div>
    <div class="absolute inset-0 opacity-[.10] pointer-events-none" style="background-image:linear-gradient(to right,rgba(255,255,255,.06) 1px,transparent 1px),linear-gradient(to bottom,rgba(255,255,255,.06) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute inset-0 opacity-[.14] mix-blend-overlay pointer-events-none" style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22240%22 height=%22240%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%22.8%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22240%22 height=%22240%22 filter=%22url(%23n)%22 opacity=%22.35%22/%3E%3C/svg%3E');"></div>
  </div>

  {{-- NAVBAR --}}
  <header class="fixed top-0 left-0 right-0 z-[9999] bg-black/60 backdrop-blur-xl supports-[backdrop-filter]:bg-black/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-[76px] flex items-center justify-between">
      <a href="#inicio" class="flex items-center gap-3 min-w-0">
        <div class="h-10 w-10 rounded-2xl bg-white/8 grid place-items-center overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,.35)]">
          <img src="{{asset('img/logo-noctair.png')}}" alt="N" class="h-10 w-10 object-cover" loading="eager" onerror="this.style.display='none';this.parentElement.innerHTML='<span class=&quot;font-bold text-lg bg-gradient-to-r from-sky-300 via-violet-300 to-fuchsia-300 bg-clip-text text-transparent&quot;>N</span>';">
        </div>
        <div class="leading-tight min-w-0">
          <div class="font-semibold tracking-wide text-base sm:text-lg truncate">NOCTAIR PERFUMES</div>
          <div class="text-[11px] text-white/55 -mt-0.5 truncate">Perfumes • Presencia • Estilo</div>
        </div>
      </a>

      <nav class="hidden md:flex items-center gap-8 text-sm text-white/70">
        @foreach(['quienes'=>'Sobre nosotros','catalogo'=>'Catálogo','faq'=>'FAQ','resenas'=>'Reseñas'] as $id=>$txt)
          <a href="{{$id==='catalogo'?$catalogoUrl:'#'.$id}}" class="hover:text-white transition">{{$txt}}</a>
        @endforeach
      </nav>

      <div class="flex items-center gap-3">
        <a href="{{$waMsg('Hola NOCTAIR Quiero asesoría para elegir un perfume. ¿Me ayudas?')}}" target="_blank" rel="noopener" class="hidden sm:inline-flex btn-whatsapp px-5 py-2 text-sm">WhatsApp</a>
        <button id="menuBtn" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition" aria-label="Menú" aria-expanded="false">
          <svg id="iconOpen" class="h-5 w-5 text-white/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
          <svg id="iconClose" class="hidden h-5 w-5 text-white/80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>
    </div>
  </header>

  {{-- MOBILE MENU --}}
  <div id="menuOverlay" class="fixed inset-0 z-[9998] hidden bg-black/60"></div>
  <aside id="mobileMenu" class="fixed top-[76px] right-0 z-[9999] hidden w-[86%] max-w-[360px] h-[calc(100vh-76px)] bg-black/70 backdrop-blur-xl border-l border-white/10">
    <div class="p-5 flex flex-col gap-3">
      @foreach(['quienes'=>'Sobre nosotros','catalogo'=>'Catálogo','faq'=>'FAQ','resenas'=>'Reseñas'] as $id=>$txt)
        <a href="{{$id==='catalogo'?$catalogoUrl:'#'.$id}}" class="mobile-link rounded-xl px-4 py-3 bg-white/5 border border-white/10 text-white/80 hover:bg-white/10 transition">{{$txt}}</a>
      @endforeach
      <a href="{{$waMsg('Hola NOCTAIR Quiero comprar el perfume del banner. ¿Precio y entrega?')}}" target="_blank" rel="noopener" class="btn-whatsapp px-4 py-3 text-center text-sm mt-2">Comprar por WhatsApp</a>
      <p class="mt-4 text-xs text-white/45">NOCTAIR • Atención rápida por WhatsApp</p>
    </div>
  </aside>

  {{-- HERO --}}
  <section id="inicio" class="max-w-7xl mx-auto px-4 sm:px-6 pt-8 sm:pt-10 pb-14 sm:pb-20">
    <div class="grid lg:grid-cols-2 gap-8 lg:gap-10 items-center">
      <div class="max-w-xl">
        <div class="inline-flex items-center gap-2 rounded-full px-4 py-2 bg-white/5 border border-white/10 text-[12px] text-white/70">
          <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_18px_rgba(52,211,153,.6)]"></span>
          Fragancias premium • Asesoría rápida por WhatsApp
        </div>

        <h1 class="mt-4 font-semibold tracking-tight leading-[1.05] text-[clamp(28px,5.5vw,58px)]">
          Perfumes con presencia,
          <span class="block bg-gradient-to-r from-sky-300 via-violet-300 to-fuchsia-300 bg-clip-text text-transparent">para día y noche</span>
        </h1>

        <p class="mt-3 text-white/70 leading-relaxed text-[15px] sm:text-[16px]">
          En <span class="text-white font-semibold">NOCTAIR</span> te ayudamos a elegir el perfume ideal según tu estilo, ocasión y clima. Recomendaciones claras, atención rápida y compra directa por WhatsApp.
        </p>

        <div class="mt-5 grid sm:flex gap-3">
          <a href="{{$catalogoUrl}}" class="btn-catalogo px-5 py-3 text-sm text-center">Ver catálogo</a>
          <a href="{{$waMsg('Hola NOCTAIR Quiero comprar el perfume del banner. ¿Precio y entrega?')}}" target="_blank" rel="noopener" class="btn-whatsapp px-5 py-3 text-sm text-center">Comprar por WhatsApp</a>
        </div>

        <div class="mt-6 grid gap-3 sm:grid-cols-3">
          @foreach([['✅','Compra segura','Te guiamos rápido','bg-emerald-500/15 border-emerald-400/20'],['🚚','Envíos','Coordinación veloz','bg-sky-500/15 border-sky-400/20'],['⚡','Respuesta','WhatsApp','bg-violet-500/15 border-violet-400/20']] as $b)
            <div class="rounded-2xl px-4 py-3 bg-white/5 border border-white/10 flex items-center gap-3 hover:bg-white/10 transition">
              <span class="h-9 w-9 rounded-xl {{$b[3]}} border grid place-items-center">{{$b[0]}}</span>
              <div>
                <div class="text-sm font-semibold">{{$b[1]}}</div>
                <div class="text-xs text-white/60">{{$b[2]}}</div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="relative mt-4 lg:mt-0">
        <div class="absolute -inset-3 rounded-[36px] bg-gradient-to-tr from-sky-500/35 via-violet-500/35 to-fuchsia-500/30 blur-2xl"></div>
        <div class="relative rounded-[28px] sm:rounded-[36px] bg-white/6 border border-white/10 p-4 sm:p-6 backdrop-blur-xl shadow-[0_30px_120px_rgba(0,0,0,.5)] overflow-hidden">
          <div class="flex items-center justify-between gap-3 mb-3">
            <div class="inline-flex items-center gap-2 text-xs text-white/70">
              <span class="px-2.5 py-1 rounded-full bg-white/10 border border-white/10">Top recomendados</span>
              <span class="px-2.5 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/20 text-emerald-200">Disponible</span>
            </div>
            <a href="{{$waMsg('Hola NOCTAIR Quiero comprar el perfume del banner. ¿Precio y entrega?')}}" target="_blank" rel="noopener" class="text-xs text-white/70 hover:text-white transition">Consultar →</a>
          </div>

          <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-white/10 to-white/5">
            <img src="{{asset('img/Principal.png')}}" alt="NOCTAIR - Producto destacado" class="w-full object-contain h-[240px] sm:h-[320px] lg:h-[360px]" loading="eager">
          </div>

          <div class="mt-3 grid grid-cols-3 gap-2">
            @foreach([['Día','Fresco'],['Noche','Intenso'],['Citas','Seductor']] as $t)
              <div class="rounded-xl p-3 bg-white/5 border border-white/10">
                <div class="text-[11px] text-white/60">{{$t[0]}}</div>
                <div class="text-sm font-semibold">{{$t[1]}}</div>
              </div>
            @endforeach
          </div>

          <div class="mt-3 grid sm:flex gap-3">
            <a href="{{$catalogoUrl}}" class="btn-catalogo flex-1 px-5 py-3 text-center text-sm">Ver catálogo</a>
            <a href="{{$waMsg('Hola NOCTAIR Quiero comprar el perfume del banner. ¿Precio y entrega?')}}" target="_blank" rel="noopener" class="btn-whatsapp flex-1 px-5 py-3 text-center text-sm">Comprar ahora</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- SOBRE NOSOTROS --}}
  <section id="quienes" class="max-w-6xl mx-auto px-5 sm:px-6 py-24">
    <div class="mb-12 text-center">
      <h2 class="text-4xl sm:text-5xl font-semibold tracking-tight">Sobre nosotros</h2>
      <p class="mt-4 text-white/60 max-w-xl mx-auto">Conoce quiénes somos, qué nos mueve y hacia dónde vamos.</p>
    </div>
    <div class="grid gap-5 md:grid-cols-3">
      @foreach([
        ['Quiénes somos','Somos NOCTAIR, una marca enfocada en perfumes con estilo y presencia. Te ayudamos a elegir según tu personalidad, clima y ocasión.','Hablar con un asesor →','wa'],
        ['Misión','Ofrecer una experiencia premium con recomendaciones claras, atención rápida y compra directa por WhatsApp.','Ver catálogo →','catalogo'],
        ['Visión','Ser una marca referente por estilo, atención y perfumes que destaquen en cada ocasión.','Consultar →','wa']
      ] as $i)
        <div class="rounded-[22px] bg-white/5 border border-white/10 p-7 hover:bg-white/10 transition">
          <h3 class="text-xl font-semibold">{{$i[0]}}</h3>
          <p class="mt-3 text-white/70 leading-relaxed">{{$i[1]}}</p>
          <a href="{{$i[3]==='catalogo'?$catalogoUrl:$waMsg('Hola NOCTAIR Quiero asesoría para elegir un perfume. ¿Me ayudas?')}}" {{$i[3]==='wa'?'target="_blank" rel="noopener"':''}} class="mt-5 inline-flex items-center text-sm text-white/60 hover:text-white transition">{{$i[2]}}</a>
        </div>
      @endforeach
    </div>
  </section>

  {{-- CATALOGO --}}
  <section id="catalogo" class="max-w-6xl mx-auto px-5 sm:px-6 py-24">
    <div class="mb-12 text-center">
      <h2 class="text-4xl sm:text-5xl font-semibold tracking-tight">Catálogo</h2>
      <p class="mt-4 text-white/60">Explora y filtra perfumes en nuestra página de catálogo.</p>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
      @foreach([
        ['Explorar catálogo','Encuentra tu perfume por marca, precio o recomendaciones para día/noche.','Ir al catálogo','catalogo','btn-catalogo'],
        ['Compra directa por WhatsApp','Consulta precio y entrega. Coordinación rápida.','Comprar por WhatsApp','wa','btn-whatsapp']
      ] as $c)
        <div class="rounded-[22px] bg-white/5 border border-white/10 p-7 hover:bg-white/10 transition">
          <h3 class="text-xl font-semibold">{{$c[0]}}</h3>
          <p class="mt-3 text-white/70 leading-relaxed">{{$c[1]}}</p>
          <a href="{{$c[3]==='catalogo'?$catalogoUrl:$waMsg('Hola NOCTAIR Quiero comprar el perfume del banner. ¿Precio y entrega?')}}" {{$c[3]==='wa'?'target="_blank" rel="noopener"':''}} class="mt-5 inline-flex {{$c[4]}} px-5 py-3 text-sm">{{$c[2]}}</a>
        </div>
      @endforeach
    </div>
  </section>

  {{-- FAQ --}}
  <section id="faq" class="max-w-4xl mx-auto px-5 sm:px-6 py-24">
    <div class="mb-12 text-center">
      <h2 class="text-4xl sm:text-5xl font-semibold tracking-tight">FAQ</h2>
      <p class="mt-4 text-white/60">Resolvemos tus dudas antes de comprar.</p>
    </div>
    <div class="grid gap-4">
      @foreach([['¿Me ayudan a elegir el perfume según mi estilo?','Sí. Te asesoramos según ocasión, clima y tipo de aroma que buscas.'],['¿Cuánto dura el aroma?','Depende de tu piel y del perfume. Te recomendamos opciones con buena duración.'],['¿Hacen envíos?','Sí. Coordinamos el envío y tiempos según tu zona.'],['¿Cuál es mejor para día o para noche?','Día: aromas frescos. Noche: aromas intensos y amaderados.']] as $f)
        <details class="group rounded-2xl bg-white/5 border border-white/10 p-6 hover:bg-white/10 transition">
          <summary class="cursor-pointer list-none flex items-center justify-between gap-4">
            <span class="font-medium text-white/90">{{$f[0]}}</span>
            <span class="text-white/50 group-open:rotate-45 transition text-2xl">+</span>
          </summary>
          <p class="mt-3 text-white/70 leading-relaxed">{{$f[1]}}</p>
          <a href="{{$waMsg('Hola NOCTAIR Quiero asesoría para elegir un perfume. ¿Me ayudas?')}}" target="_blank" rel="noopener" class="mt-4 inline-flex text-sm text-white/60 hover:text-white transition">Preguntar por WhatsApp →</a>
        </details>
      @endforeach
    </div>
  </section>

  {{-- RESEÑAS --}}
  <section id="resenas" class="max-w-6xl mx-auto px-5 sm:px-6 py-24">
    <div class="mb-12 text-center">
      <h2 class="text-4xl sm:text-5xl font-semibold tracking-tight">Reseñas</h2>
      <p class="mt-4 text-white/60">Opiniones reales de clientes.</p>
    </div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
      @foreach([['Andrea M.',5,'Me recomendaron uno para uso diario y quedó perfecto.','review-1.jpg'],['Luis R.',5,'Atención rápida. Elegí uno para noche y fue un éxito.','review-2.jpg'],['Karla S.',5,'Presentación pro y buen precio. Volvería a comprar.','review-3.jpg']] as $r)
        <article class="rounded-[22px] bg-white/5 border border-white/10 p-6 hover:bg-white/10 transition">
          <div class="flex items-center gap-3">
            <img src="{{asset('img/'.$r[3])}}" onerror="this.style.display='none'" class="h-11 w-11 rounded-full object-cover border border-white/10" alt="Cliente" loading="lazy">
            <div class="flex-1">
              <div class="flex items-center justify-between gap-3">
                <div class="font-semibold">{{$r[0]}}</div>
                <div class="flex items-center gap-1 text-yellow-400">
                  @for($i=0;$i<$r[1];$i++)<span>★</span>@endfor
                </div>
              </div>
              <div class="text-xs text-white/45">Compra verificada</div>
            </div>
          </div>
          <p class="mt-4 text-white/70 leading-relaxed">"{{$r[2]}}"</p>
          <a href="{{$catalogoUrl}}" class="mt-5 inline-flex items-center text-sm text-white/60 hover:text-white transition">Ver catálogo →</a>
        </article>
      @endforeach
    </div>
  </section>

  {{-- FOOTER --}}
  <footer class="max-w-7xl mx-auto px-5 sm:px-6 py-16">
    <div class="rounded-[28px] bg-white/5 border border-white/10 p-8 sm:p-12">
      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        
        <div>
          <div class="flex items-center gap-3 mb-4">
            <div class="h-10 w-10 rounded-2xl bg-white/8 grid place-items-center">
              <img src="{{asset('img/logo-noctair.png')}}" alt="N" class="h-10 w-10 object-cover" onerror="this.style.display='none';this.parentElement.innerHTML='<span class=&quot;font-bold text-lg bg-gradient-to-r from-sky-300 via-violet-300 to-fuchsia-300 bg-clip-text text-transparent&quot;>N</span>';">
            </div>
            <div class="font-semibold tracking-wide">NOCTAIR</div>
          </div>
          <p class="text-sm text-white/60 leading-relaxed">Perfumes con presencia para día y noche. Asesoría personalizada por WhatsApp.</p>
        </div>

        <div>
          <h3 class="font-semibold mb-4">Enlaces rápidos</h3>
          <nav class="grid gap-2 text-sm">
            @foreach(['quienes'=>'Sobre nosotros','catalogo'=>'Catálogo','faq'=>'FAQ','resenas'=>'Reseñas'] as $id=>$txt)
              <a href="{{$id==='catalogo'?$catalogoUrl:'#'.$id}}" class="text-white/60 hover:text-white transition">{{$txt}}</a>
            @endforeach
          </nav>
        </div>

        <div>
          <h3 class="font-semibold mb-4">Síguenos</h3>
          <div class="flex gap-3 mb-5">
            @foreach([
              ['https://facebook.com/noctair','M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z','Facebook'],
              ['https://instagram.com/noctair','M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M6.5 2h11A4.5 4.5 0 0122 6.5v11a4.5 4.5 0 01-4.5 4.5h-11A4.5 4.5 0 012 17.5v-11A4.5 4.5 0 016.5 2z','Instagram'],
              ['https://tiktok.com/@noctair','M9 12a4 4 0 100 8 4 4 0 000-8zm11-5.5V12a7 7 0 01-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.96 8.96 0 0013 21a9 9 0 009-9V6.5h-2z','TikTok']
            ] as $s)
              <a href="{{$s[0]}}" target="_blank" rel="noopener" class="h-10 w-10 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 grid place-items-center transition" aria-label="{{$s[2]}}">
                <svg class="h-5 w-5 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="{{$s[1]}}"/>
                </svg>
              </a>
            @endforeach
          </div>
          <a href="{{$waMsg('Hola NOCTAIR Quiero asesoría para elegir un perfume. ¿Me ayudas?')}}" target="_blank" rel="noopener" class="inline-flex btn-whatsapp px-5 py-2.5 text-sm">Contactar por WhatsApp</a>
        </div>

      </div>

      <div class="mt-8 pt-8 border-t border-white/10 text-center text-xs text-white/45">
        © {{date('Y')}} NOCTAIR • Todos los derechos reservados • Experiencia premium ✨
      </div>
    </div>
  </footer>

  {{-- WHATSAPP FLOAT --}}
  <a href="{{$waMsg('Hola NOCTAIR Quiero asesoría para elegir un perfume. ¿Me ayudas?')}}" class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp">
    <i class="fa fa-whatsapp"></i>
  </a>
</div>

<script>
(()=>{const b=document.getElementById('menuBtn'),m=document.getElementById('mobileMenu'),o=document.getElementById('menuOverlay'),iO=document.getElementById('iconOpen'),iC=document.getElementById('iconClose'),ls=document.querySelectorAll('.mobile-link');const open=()=>{m.classList.remove('hidden');o.classList.remove('hidden');iO.classList.add('hidden');iC.classList.remove('hidden');b.setAttribute('aria-expanded','true');document.documentElement.classList.add('menu-open');};const close=()=>{m.classList.add('hidden');o.classList.add('hidden');iO.classList.remove('hidden');iC.classList.add('hidden');b.setAttribute('aria-expanded','false');document.documentElement.classList.remove('menu-open');};b?.addEventListener('click',()=>b.getAttribute('aria-expanded')==='true'?close():open());o?.addEventListener('click',close);ls.forEach(a=>a.addEventListener('click',close));window.addEventListener('keydown',e=>e.key==='Escape'&&close());})();
</script>
@endsection