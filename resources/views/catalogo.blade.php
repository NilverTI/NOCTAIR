
@extends('layouts.app')

@section('content')
@php
  $wa = '51902205964';
@endphp

<div class="catalogo-container">
  
  {{-- Background Gradient --}}
  <div class="bg-gradients">
    <div class="gradient gradient-1"></div>
    <div class="gradient gradient-2"></div>
    <div class="gradient gradient-3"></div>
    <div class="gradient-overlay"></div>
  </div>

  {{-- Header --}}
  <header class="header-sticky">
    <div class="header-content">
      <a href="/" class="logo-link">
        <div class="logo-box">
          <img src="{{ asset('img/logo-noctair.png') }}" alt="NOCTAIR" class="logo-img" 
                onerror="this.parentElement.innerHTML='<span class=\'logo-fallback\'>N</span>'">
        </div>
        <div class="logo-text">
          <div class="logo-title">NOCTAIR</div>
          <div class="logo-subtitle">Catálogo Premium</div>
        </div>
      </a>
      
      <button onclick="Cart.open()" class="cart-btn" aria-label="Abrir carrito">
        <svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <span id="cart-badge"></span>
        <span class="cart-text">Carrito</span>
      </button>
    </div>
  </header>

  {{-- Filters Section --}}
  <section class="filters-section">
    <div class="filters-container">
      
      <div class="filters-header">
        <h1 class="filters-title">Catálogo</h1>
        <p class="filters-subtitle">Filtra y encuentra tu perfume ideal</p>
      </div>

      <form method="GET" action="{{ route('catalogo') }}" class="filters-form">
        
        {{-- Search Input --}}
        <div class="search-group">
          <input name="q" value="{{ $q ?? '' }}" placeholder="Buscar perfume..." class="search-input" />
          <button type="submit" class="search-btn" title="Buscar">🔍</button>
        </div>

        {{-- Brand Select --}}
        <select name="marca" class="filter-select">
          <option value="">Marca</option>
          @foreach($marcas ?? [] as $m)
            <option value="{{ $m }}" @selected(($marcaSel ?? '') === $m)>{{ $m }}</option>
          @endforeach
        </select>

        {{-- Order Select --}}
        <select name="order" class="filter-select">
          <option value="">Ordenar</option>
          <option value="price_asc" @selected(($orderSel ?? '') === 'price_asc')>Precio ↑</option>
          <option value="price_desc" @selected(($orderSel ?? '') === 'price_desc')>Precio ↓</option>
        </select>

        {{-- Apply Button --}}
        <button type="submit" class="filter-apply-btn">Aplicar</button>

        {{-- Clear Button --}}
        <a href="{{ route('catalogo') }}" class="filter-clear-btn" title="Limpiar filtros">🗑️</a>

      </form>

    </div>
  </section>

  {{-- Products Grid --}}
  <section class="products-section">
    @if(($productos ?? collect())->isEmpty())
      <div class="empty-state">
        <div class="empty-text">No se encontraron productos con esos filtros.</div>
      </div>
    @else
      <div class="products-grid">
        @foreach($productos as $p)
          <article class="product-card" data-product-id="{{ $p['id'] }}">
            
            {{-- Image Gallery --}}
            <div class="product-gallery">
              <div class="carousel" data-carousel="{{ $p['id'] }}">
                @foreach($p['imagenes'] as $index => $img)
                  <img 
                    src="{{ asset('img/' . $img) }}" 
                    alt="{{ $p['nombre'] }}" 
                    class="carousel-img {{ $index === 0 ? 'active' : '' }}"
                    data-index="{{ $index }}"
                    loading="lazy"
                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22320%22 height=%22320%22%3E%3Crect fill=%22%23334155%22 width=%22320%22 height=%22320%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 fill=%22%23fff%22 dy=%22.3em%22 style=%22font-family:sans-serif;font-size:16px%22%3ENo disponible%3C/text%3E%3C/svg%3E'"
                  />
                @endforeach
                
                @if(count($p['imagenes']) > 1)
                  <button onclick="Carousel.prev({{ $p['id'] }})" class="carousel-btn carousel-prev" aria-label="Anterior">
                    <svg class="carousel-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                  </button>
                  <button onclick="Carousel.next({{ $p['id'] }})" class="carousel-btn carousel-next" aria-label="Siguiente">
                    <svg class="carousel-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                  
                  <div class="carousel-indicators">
                    @foreach($p['imagenes'] as $index => $img)
                      <div class="indicator {{ $index === 0 ? 'active' : '' }}" data-indicator="{{ $p['id'] }}-{{ $index }}"></div>
                    @endforeach
                  </div>
                @endif
              </div>
            </div>

            {{-- Product Info --}}
            <div class="product-info">
              <div class="product-brand">{{ $p['marca'] }}</div>
              <h3 class="product-name">{{ $p['nombre'] }}</h3>

              <div class="product-actions">
                <div class="product-price">S/ {{ number_format($p['precio'], 2) }}</div>
                
                {{-- Quantity Selector --}}
                <div class="quantity-group">
                  <button onclick="Quantity.decrease({{ $p['id'] }})" class="qty-btn" aria-label="Disminuir">
                    <svg class="qty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                  </button>
                  
                  <input 
                    type="number" 
                    id="qty-{{ $p['id'] }}"
                    min="1" 
                    max="10" 
                    value="1"
                    onchange="Quantity.validate({{ $p['id'] }}, this.value)"
                    class="qty-input"
                    aria-label="Cantidad"
                  />
                  
                  <button onclick="Quantity.increase({{ $p['id'] }})" class="qty-btn" aria-label="Aumentar">
                    <svg class="qty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                  </button>
                  
                  <button onclick='Cart.add(@json($p))' class="add-to-cart-btn">
                    <svg class="cart-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Agregar
                  </button>
                </div>
                
                <div class="qty-hint">Máx. 10 unidades</div>
              </div>

              <div id="badge-{{ $p['id'] }}" class="product-badge hidden"></div>
            </div>
          </article>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="pagination-wrapper">
        {{ $productos->onEachSide(1)->links('vendor.pagination.noctair') }}
      </div>
    @endif
  </section>

  {{-- Cart Sidebar --}}
  <div id="cart-sidebar" class="hidden">
    <div onclick="Cart.close()" class="cart-overlay"></div>
    
    <div class="cart-panel">
      
      <div class="cart-header">
        <div class="cart-header-info">
          <svg class="cart-header-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          <h2 class="cart-title">Carrito</h2>
          <span id="cart-count" class="cart-count"></span>
        </div>
        <button onclick="Cart.close()" class="cart-close-btn" aria-label="Cerrar carrito">
          <svg class="close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <div id="cart-items" class="cart-items"></div>

      <div id="cart-footer" class="cart-footer hidden">
        <div class="cart-total">
          <span class="total-label">Total:</span>
          <span id="cart-total" class="total-amount"></span>
        </div>
        
        <button onclick="Cart.sendWhatsApp()" class="whatsapp-btn">
          Enviar pedido por WhatsApp
        </button>
        
        <button onclick="Cart.clear()" class="clear-btn">
          Vaciar carrito
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Configuración
const CONFIG = {
  waNumber: '{{ $wa }}',
  maxQuantity: 10,
  storageKey: 'noctair_carrito'
};

// Utilidades
const Storage = {
  get: () => JSON.parse(localStorage.getItem(CONFIG.storageKey) || '[]'),
  set: (data) => localStorage.setItem(CONFIG.storageKey, JSON.stringify(data))
};

// Módulo de Carrusel
const Carousel = {
  navigate(prodId, direction) {
    const carousel = document.querySelector(`[data-carousel="${prodId}"]`);
    const images = carousel.querySelectorAll('.carousel-img');
    const indicators = carousel.querySelectorAll('.indicator');
    
    let currentIndex = Array.from(images).findIndex(img => img.classList.contains('active'));
    images[currentIndex].classList.remove('active');
    indicators[currentIndex]?.classList.remove('active');
    
    currentIndex = (currentIndex + direction + images.length) % images.length;
    
    images[currentIndex].classList.add('active');
    indicators[currentIndex]?.classList.add('active');
  },
  
  prev: (prodId) => Carousel.navigate(prodId, -1),
  next: (prodId) => Carousel.navigate(prodId, 1)
};

// Módulo de Cantidad
const Quantity = {
  decrease(prodId) {
    const input = document.getElementById(`qty-${prodId}`);
    input.value = Math.max(1, parseInt(input.value) - 1);
  },
  
  increase(prodId) {
    const input = document.getElementById(`qty-${prodId}`);
    input.value = Math.min(CONFIG.maxQuantity, parseInt(input.value) + 1);
  },
  
  validate(prodId, value) {
    const input = document.getElementById(`qty-${prodId}`);
    const num = parseInt(value) || 1;
    input.value = Math.max(1, Math.min(CONFIG.maxQuantity, num));
  }
};

// Módulo de Carrito
const Cart = {
  items: Storage.get(),
  
  add(producto) {
    const cantidad = parseInt(document.getElementById(`qty-${producto.id}`).value) || 1;
    const existente = this.items.find(item => item.id === producto.id);
    
    if (existente) {
      existente.cantidad = Math.min(existente.cantidad + cantidad, CONFIG.maxQuantity);
    } else {
      this.items.push({ ...producto, cantidad: Math.min(cantidad, CONFIG.maxQuantity) });
    }
    
    Storage.set(this.items);
    document.getElementById(`qty-${producto.id}`).value = 1;
    this.render();
  },
  
  updateQuantity(id, cantidad) {
    if (cantidad === 0) {
      this.items = this.items.filter(item => item.id !== id);
    } else {
      const item = this.items.find(i => i.id === id);
      if (item) item.cantidad = Math.min(cantidad, CONFIG.maxQuantity);
    }
    Storage.set(this.items);
    this.render();
  },
  
  clear() {
    if (confirm('¿Seguro que deseas vaciar el carrito?')) {
      this.items = [];
      Storage.set(this.items);
      this.render();
    }
  },
  
  open() {
    document.getElementById('cart-sidebar').classList.remove('hidden');
  },
  
  close() {
    document.getElementById('cart-sidebar').classList.add('hidden');
  },
  
  sendWhatsApp() {
    let mensaje = '🛍️ *PEDIDO NOCTAIR*\n\n';
    
    this.items.forEach((item, index) => {
      mensaje += `${index + 1}. *${item.nombre}*\n`;
      mensaje += `   Marca: ${item.marca}\n`;
      mensaje += `   Cantidad: ${item.cantidad}\n`;
      mensaje += `   Precio: S/ ${item.precio.toFixed(2)}\n`;
      mensaje += `   Subtotal: S/ ${(item.precio * item.cantidad).toFixed(2)}\n\n`;
    });
    
    const total = this.items.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
    mensaje += `💰 *TOTAL: S/ ${total.toFixed(2)}*\n\n`;
    mensaje += '¿Podrías confirmar disponibilidad y costos de envío? 📦';
    
    window.open(`https://wa.me/${CONFIG.waNumber}?text=${encodeURIComponent(mensaje)}`, '_blank');
  },
  
  render() {
    const totalItems = this.items.reduce((sum, item) => sum + item.cantidad, 0);
    const totalPrecio = this.items.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
    
    // Badge del header
    const badge = document.getElementById('cart-badge');
    badge.innerHTML = totalItems > 0 
      ? `<span class="badge-count">${totalItems}</span>` 
      : '';
    
    // Badges en productos
    document.querySelectorAll('[id^="badge-"]').forEach(el => el.classList.add('hidden'));
    this.items.forEach(item => {
      const badge = document.getElementById(`badge-${item.id}`);
      if (badge) {
        badge.classList.remove('hidden');
        badge.textContent = `✓ ${item.cantidad} en el carrito`;
      }
    });
    
    // Items del carrito
    const cartItems = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartFooter = document.getElementById('cart-footer');
    const cartTotal = document.getElementById('cart-total');
    
    cartCount.textContent = `(${totalItems})`;
    
    if (this.items.length === 0) {
      cartItems.innerHTML = `
        <div class="empty-cart">
          <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          <p class="empty-text">Tu carrito está vacío</p>
        </div>
      `;
      cartFooter.classList.add('hidden');
    } else {
      cartItems.innerHTML = this.items.map(item => `
        <div class="cart-item">
          <div class="cart-item-header">
            <img src="/img/${item.imagenes[0]}" alt="${item.nombre}" class="cart-item-img"/>
            <div class="cart-item-info">
              <h4 class="cart-item-name">${item.nombre}</h4>
              <p class="cart-item-brand">${item.marca}</p>
              <p class="cart-item-price">S/ ${item.precio.toFixed(2)}</p>
            </div>
          </div>
          <div class="cart-item-actions">
            <div class="cart-qty-controls">
              <button onclick="Cart.updateQuantity(${item.id}, ${item.cantidad - 1})" class="cart-qty-btn">
                <svg class="qty-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
              </button>
              <span class="cart-qty-value">${item.cantidad}</span>
              <button onclick="Cart.updateQuantity(${item.id}, ${item.cantidad + 1})" 
                      class="cart-qty-btn" 
                      ${item.cantidad >= CONFIG.maxQuantity ? 'disabled' : ''}>
                <svg class="qty-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
              </button>
            </div>
            <button onclick="Cart.updateQuantity(${item.id}, 0)" class="cart-remove-btn">
              <svg class="remove-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
            </button>
          </div>
          <div class="cart-item-subtotal">
            Subtotal: <span class="subtotal-amount">S/ ${(item.precio * item.cantidad).toFixed(2)}</span>
          </div>
        </div>
      `).join('');
      cartFooter.classList.remove('hidden');
      cartTotal.textContent = `S/ ${totalPrecio.toFixed(2)}`;
    }
  }
};

// Inicializar
document.addEventListener('DOMContentLoaded', () => Cart.render());
</script>
@endsection