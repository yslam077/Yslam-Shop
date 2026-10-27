@extends('client.layouts.header')

@section('content')
<script>document.documentElement.classList.add('js-reveal');</script>

@php
    // Kategoriýa reňki we nyşany (bannerlar bilen deň)
    $catThemes = [
        1 => ['#1a80da', 'bi-shield-check'],
        2 => ['#e0486c', 'bi-heart-fill'],
        3 => ['#6b8a36', 'bi-house-door-fill'],
        4 => ['#ff9100', 'bi-lightning-charge-fill'],
    ];
    [$catColor, $catIcon] = $catThemes[$category->id] ?? ['#0d6efd', 'bi-box-seam'];
    $themeId = isset($catThemes[$category->id]) ? $category->id : 0;

    $cartItems = session('cart', []);
    $total = $category->products->count();
@endphp

<style>
    :root {
        --ys-blue: #0d6efd;
        --ys-red: #dc3545;
        --ys-ink: #0f172a;
        --ys-line: rgba(226, 232, 240, .9);
    }

    /* ---------- Peýda bolmak ---------- */
    .js-reveal .reveal {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity .55s ease, transform .55s cubic-bezier(.16, 1, .3, 1);
        transition-delay: var(--d, 0ms);
    }

    .js-reveal .reveal.in { opacity: 1; transform: none; }

    /* ---------- Sözbaşy ---------- */
    .catalog-header-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.75rem;
        background: linear-gradient(135deg, #ffffff 0%, #f1f6ff 100%);
        border: 1px solid #e6eefb;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(13, 110, 253, .05);
    }

    .catalog-header-card::after {
        content: "";
        position: absolute;
        right: -60px;
        top: -90px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: var(--ys-blue);
        opacity: .07;
        pointer-events: none;
    }

    .catalog-title {
        display: flex;
        align-items: center;
        gap: .6rem;
        margin: 0 0 .25rem;
        font-weight: 900;
        font-size: clamp(1.4rem, 1.1rem + 1.2vw, 2rem);
        letter-spacing: -.5px;
        color: var(--ys-ink);
    }

    .catalog-title::before {
        content: "";
        width: 5px;
        height: 1.4em;
        border-radius: 4px;
        background: linear-gradient(180deg, var(--ys-blue), var(--ys-red));
    }

    .catalog-meta {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        margin: 0;
    }

    .meta-chip {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .25rem .75rem;
        border-radius: 50rem;
        background: #fff;
        border: 1px solid #e2e8f0;
        font-size: .82rem;
        font-weight: 600;
        color: #64748b;
    }

    .meta-chip b { color: var(--ys-ink); }
    .meta-chip i { color: var(--ys-blue); }

    .back-pill {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .55rem 1.15rem;
        border-radius: 50rem;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        color: #334155;
        font-weight: 700;
        font-size: .92rem;
        text-decoration: none;
        white-space: nowrap;
        transition: all .25s ease;
    }

    .back-pill i { transition: transform .25s; }

    .back-pill:hover {
        border-color: var(--ys-blue);
        color: var(--ys-blue);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 110, 253, .15);
    }

    .back-pill:hover i { transform: translateX(-4px); }

    /* ---------- Haryt kartlary ---------- */
    .catalog-grid-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 22px;
        overflow: hidden;
        transition: all .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .catalog-grid-card:hover {
        transform: translateY(-8px);
        border-color: rgba(13, 110, 253, .3);
        box-shadow: 0 20px 35px rgba(13, 110, 253, .13);
    }

    .catalog-thumb-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 200px;
        margin: 12px;
        padding: 16px;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(145deg, #f8fafc, #edf2f7);
    }

    .catalog-thumb-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, .06));
        transition: transform .4s ease, filter .4s ease;
    }

    .catalog-grid-card:hover .catalog-thumb-img {
        transform: scale(1.08) translateY(-4px);
        filter: drop-shadow(0 10px 15px rgba(0, 0, 0, .12));
    }

    .in-cart-flag {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #198754;
        color: #fff;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: .95rem;
        box-shadow: 0 4px 10px rgba(25, 135, 84, .4);
    }

    [data-cart-card].is-in-cart .in-cart-flag {
        display: flex;
        animation: flagPop .45s cubic-bezier(.34, 1.56, .64, 1);
    }

    @keyframes flagPop { from { transform: scale(0); } to { transform: scale(1); } }

    .p-name {
        display: block;
        font-size: 1rem;
        font-weight: 700;
        color: var(--ys-ink);
        text-decoration: none;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .p-name:hover { color: var(--ys-blue); }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .price-row { display: flex; align-items: baseline; gap: .3rem; margin-bottom: .85rem; }
    .price-num { font-size: 1.3rem; font-weight: 900; color: var(--ys-blue); letter-spacing: -.3px; }
    .price-cur { font-size: .8rem; font-weight: 800; color: var(--ys-blue); opacity: .8; }

    /* ---------- Düwmeler ---------- */
    .cart-row { display: flex; gap: .5rem; align-items: stretch; }

    .btn-eye {
        flex: 0 0 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #f1f5f9;
        color: #475569;
        text-decoration: none;
        font-size: 1.1rem;
        transition: all .2s ease;
    }

    .btn-eye:hover { background: #e2e8f0; color: var(--ys-ink); transform: translateY(-2px); }

    .btn-action-add {
        width: 100%;
        height: 100%;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        border: 0;
        border-radius: 12px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        font-size: .9rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(13, 110, 253, .25);
        transition: all .25s ease;
    }

    .btn-action-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, .4);
        color: #fff;
    }

    .btn-action-add:active { transform: scale(.97); }

    .js-add-form { flex: 1 1 auto; margin: 0; }

    .stepper {
        flex: 1 1 auto;
        display: flex;
        align-items: center;
        gap: .35rem;
        animation: stepIn .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    @keyframes stepIn { from { opacity: 0; transform: scale(.9); } to { opacity: 1; transform: none; } }

    .stepper-box {
        flex: 1 1 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 3px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
    }

    .st-btn {
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 10px;
        background: #fff;
        color: var(--ys-blue);
        font-size: 1.15rem;
        font-weight: 900;
        line-height: 1;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
        transition: all .2s ease;
    }

    .st-btn:hover { background: var(--ys-blue); color: #fff; }

    .st-qty { min-width: 26px; text-align: center; font-weight: 900; color: var(--ys-ink); }
    .st-qty.bump { animation: qtyBump .3s ease; }

    @keyframes qtyBump { 50% { transform: scale(1.35); color: var(--ys-blue); } }

    .st-del {
        flex: 0 0 38px;
        height: 38px;
        border: 0;
        border-radius: 12px;
        background: #fdecee;
        color: var(--ys-red);
        transition: all .2s ease;
    }

    .st-del:hover { background: var(--ys-red); color: #fff; }

    /* ---------- Boş ---------- */
    .empty-box-icon { animation: floatAnimation 3s ease-in-out infinite; }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* ---------- Sahypalama ---------- */
    .pagination { gap: 6px; flex-wrap: wrap; justify-content: center; }

    .pagination .page-item .page-link {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0;
        color: var(--ys-blue);
        font-weight: 700;
        padding: 8px 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .02);
        transition: all .2s ease;
    }

    .pagination .page-item .page-link:hover { transform: translateY(-2px); background: #eef4ff; }

    .pagination .page-item.active .page-link {
        background: var(--ys-blue);
        border-color: var(--ys-blue);
        color: #fff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, .3);
    }

    /* ---------- Habarnama (toast) ---------- */
    .ys-toast {
        position: fixed;
        left: 50%;
        bottom: 96px;
        z-index: 2000;
        display: flex;
        align-items: center;
        gap: .55rem;
        padding: .7rem 1.25rem;
        border-radius: 50rem;
        background: #0f172a;
        color: #fff;
        font-weight: 700;
        font-size: .9rem;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .3);
        opacity: 0;
        transform: translate(-50%, 20px);
        pointer-events: none;
        transition: all .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .ys-toast.show { opacity: 1; transform: translate(-50%, 0); }
    .ys-toast i { color: #4ade80; }
    .ys-toast.err i { color: #f87171; }

    @media (min-width: 992px) { .ys-toast { bottom: 32px; } }

    @media (max-width: 575.98px) {
        .catalog-header-card { padding: 1.1rem; border-radius: 20px; }
        .back-pill span { display: none; }
        .back-pill { padding: .55rem .8rem; }
        .catalog-thumb-wrapper { height: 150px; margin: 8px; padding: 10px; }
        .price-num { font-size: 1.1rem; }
    }

    @media (prefers-reduced-motion: reduce) {
        .js-reveal .reveal { opacity: 1; transform: none; transition: none; }
        .empty-box-icon, .stepper { animation: none; }
    }

    /* ---------- Kategoriýa reňki ---------- */
    .cat-theme-0 { --cat: #0d6efd; }
    .cat-theme-1 { --cat: #1a80da; }
    .cat-theme-2 { --cat: #e0486c; }
    .cat-theme-3 { --cat: #6b8a36; }
    .cat-theme-4 { --cat: #ff9100; }

    .catalog-header-card::after { background: var(--cat); opacity: .09; }
    .catalog-title::before { background: linear-gradient(180deg, var(--cat), color-mix(in srgb, var(--cat) 45%, #fff)); }
    .meta-chip i { color: var(--cat); }

    .cat-bubble {
        position: relative;
        z-index: 1;
        flex: 0 0 auto;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: color-mix(in srgb, var(--cat) 14%, #fff);
        color: var(--cat);
        font-size: 1.8rem;
        animation: bubblePop .7s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    @keyframes bubblePop { from { opacity: 0; transform: scale(.4) rotate(-20deg); } to { opacity: 1; transform: none; } }

    /* ---------- Gural paneli: gözleg + tertip ---------- */
    .toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1.5rem;
    }

    .filter-box {
        flex: 1 1 240px;
        max-width: 380px;
        display: flex;
        align-items: center;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-radius: 50rem;
        overflow: hidden;
        transition: all .25s ease;
    }

    .filter-box:focus-within {
        border-color: var(--cat);
        box-shadow: 0 0 0 .25rem color-mix(in srgb, var(--cat) 18%, transparent);
    }

    .filter-box i { padding-left: 1rem; color: #94a3b8; }

    .filter-box input {
        flex: 1 1 auto;
        min-width: 0;
        border: 0;
        outline: 0;
        padding: .6rem .75rem;
        font-weight: 600;
        background: transparent;
    }

    .sort-group { display: flex; gap: .4rem; flex-wrap: wrap; }

    .sort-chip {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .5rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 50rem;
        background: #fff;
        color: #334155;
        font-size: .88rem;
        font-weight: 700;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .sort-chip:hover { border-color: var(--cat); color: var(--cat); transform: translateY(-2px); }

    .sort-chip.active {
        background: var(--cat);
        border-color: var(--cat);
        color: #fff;
        box-shadow: 0 6px 14px color-mix(in srgb, var(--cat) 35%, transparent);
    }

    .catalog-grid-card:hover {
        border-color: color-mix(in srgb, var(--cat) 40%, transparent);
        box-shadow: 0 20px 35px color-mix(in srgb, var(--cat) 16%, transparent);
    }

    @media (max-width: 575.98px) {
        .cat-bubble { width: 48px; height: 48px; font-size: 1.4rem; }
        .filter-box { max-width: none; }
    }
</style>

<div class="container-lg py-4 cat-theme-{{ $themeId }}">

    {{-- ================= KATEGORIÝA SÖZBAŞY ================= --}}
    <div class="catalog-header-card reveal">
        <div class="d-flex align-items-center gap-3" style="position: relative; z-index: 1; min-width: 0;">
            <div class="cat-bubble"><i class="bi {{ $catIcon }}"></i></div>
            <div style="min-width: 0;">
                <h1 class="catalog-title">{{ $category->name }}</h1>
                <p class="catalog-meta">
                    <span class="meta-chip"><i class="bi bi-box-seam"></i> {{ __('app.found') }}: <b>{{ $total }}</b></span>
                </p>
            </div>
        </div>
        <a href="{{ route('home.index') }}" class="back-pill">
            <i class="bi bi-arrow-left"></i><span>{{ __('app.home') }}</span>
        </a>
    </div>

    @if($total > 1)
    {{-- ================= GURAL PANELI ================= --}}
    <div class="toolbar reveal">
        <label class="filter-box shadow-sm mb-0">
            <i class="bi bi-search"></i>
            <input type="text" id="filterInput" placeholder="Bu kategoriýada gözle..." autocomplete="off">
        </label>

        <div class="sort-group">
            <button type="button" class="sort-chip active" data-sort="default"><i class="bi bi-stars"></i> Ähli</button>
            <button type="button" class="sort-chip" data-sort="asc"><i class="bi bi-sort-numeric-down"></i> Arzan</button>
            <button type="button" class="sort-chip" data-sort="desc"><i class="bi bi-sort-numeric-up"></i> Gymmat</button>
        </div>
    </div>
    @endif

    {{-- ================= HARYTLAR ================= --}}
    <div class="row g-3 g-md-4" id="productGrid">
        @forelse($category->products as $product)
        @php
            $raw = $cartItems[$product->id] ?? 0;
            $qty = is_array($raw) ? (int) ($raw['quantity'] ?? 0) : (int) $raw;
        @endphp

        <div class="col-6 col-md-4 col-lg-3 reveal" data-col data-idx="{{ $loop->index }}" data-price="{{ $product->price }}" data-name="{{ mb_strtolower($product->name) }}" data-d="{{ ($loop->index % 4) * 70 }}">
            <div class="catalog-grid-card {{ $qty > 0 ? 'is-in-cart' : '' }}" data-cart-card data-id="{{ $product->id }}" data-qty="{{ $qty }}">
                <div>
                    <a href="{{ route('products.show', $product->id) }}" class="catalog-thumb-wrapper text-decoration-none" aria-label="{{ $product->name }}">
                        <span class="in-cart-flag"><i class="bi bi-check-lg"></i></span>

                        @if($product->image && file_exists(public_path('img/' . $product->image)))
                            <img src="{{ asset('img/' . $product->image) }}" class="catalog-thumb-img" alt="{{ $product->name }}" loading="lazy">
                        @elseif($product->image && file_exists(public_path($product->image)))
                            <img src="{{ asset($product->image) }}" class="catalog-thumb-img" alt="{{ $product->name }}" loading="lazy">
                        @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                            <img src="{{ asset('storage/' . $product->image) }}" class="catalog-thumb-img" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="catalog-thumb-img" alt="No Image" loading="lazy">
                        @endif
                    </a>

                    <div class="px-3 pt-2">
                        <a href="{{ route('products.show', $product->id) }}" class="p-name mb-1" title="{{ $product->name }}">{{ $product->name }}</a>
                        <p class="text-muted text-truncate-2 mb-0" style="font-size: .82rem; line-height: 1.4;">{{ $product->description }}</p>
                    </div>
                </div>

                <div class="p-3 pt-2">
                    <div class="price-row">
                        <span class="price-num">{{ number_format($product->price, 0, ',', ' ') }}</span>
                        <span class="price-cur">TMT</span>
                    </div>

                    <div class="cart-row">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-eye" title="{{ __('app.view') }}" aria-label="{{ __('app.view') }}">
                            <i class="bi bi-eye"></i>
                        </a>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="js-add-form {{ $qty > 0 ? 'd-none' : '' }}">
                            @csrf
                            <button type="submit" class="btn-action-add">
                                <i class="bi bi-cart-plus-fill"></i><span>{{ __('app.add') }}</span>
                            </button>
                        </form>

                        <div class="stepper js-stepper {{ $qty > 0 ? '' : 'd-none' }}">
                            <div class="stepper-box">
                                <button type="button" class="st-btn js-minus" aria-label="Azalt">−</button>
                                <span class="st-qty js-qty">{{ max($qty, 1) }}</span>
                                <button type="button" class="st-btn js-plus" aria-label="Köpelt">+</button>
                            </div>
                            <button type="button" class="st-del js-del" title="Sebetden poz" aria-label="Sebetden poz">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 reveal">
            <div class="my-4">
                <i class="bi bi-box-seam display-1 opacity-50 empty-box-icon d-inline-block" style="color: var(--cat);"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Suwagtlykça harytlar ýok</h4>
            <p class="text-muted mb-4">Bu kategoriýada entek haryt goşulmandyr.</p>
            <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="bi bi-house-door-fill me-1"></i> Baş Sahypa
            </a>
        </div>
        @endforelse
    </div>

    {{-- Süzgüçde hiç zat tapylmasa --}}
    <div id="noResult" class="text-center py-5 d-none">
        <i class="bi bi-emoji-frown display-3 text-muted opacity-50 d-block mb-3"></i>
        <h5 class="fw-bold text-dark mb-1">Hiç zat tapylmady</h5>
        <p class="text-muted mb-0">Başga söz bilen synanyşyp görüň</p>
    </div>
</div>

<div class="ys-toast" id="ysToast" role="status" aria-live="polite"><i class="bi bi-check-circle-fill"></i><span></span></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        /* ---------- Peýda bolmak ---------- */
        const items = document.querySelectorAll('.reveal');
        items.forEach(el => { if (el.dataset.d) el.style.setProperty('--d', el.dataset.d + 'ms'); });
        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
                });
            }, { threshold: .1, rootMargin: '0px 0px -30px 0px' });
            items.forEach(el => io.observe(el));
        } else {
            items.forEach(el => el.classList.add('in'));
        }

        /* ---------- Kömekçiler ---------- */
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
        const toastEl = document.getElementById('ysToast');
        let toastTimer;

        function toast(text, isError) {
            toastEl.classList.toggle('err', !!isError);
            toastEl.querySelector('i').className = isError ? 'bi bi-exclamation-circle-fill' : 'bi bi-check-circle-fill';
            toastEl.querySelector('span').textContent = text;
            toastEl.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2000);
        }

        function setBadges(n) {
            document.querySelectorAll('#cart-badge-count, .cart-badge').forEach(b => {
                b.textContent = n;
                b.classList.toggle('d-none', n <= 0);
            });
        }

        function sendQty(id, qty) {
            return fetch(`/cart/ajax-add/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ quantity: qty })
            })
            .then(r => { if (!r.ok) throw new Error(r.status); return r.json(); })
            .then(d => { if (d.cart_count !== undefined) setBadges(d.cart_count); return d; });
        }

        /* ---------- Kartlaryň ýagdaýy ---------- */
        const timers = new WeakMap();

        function render(card, qty) {
            card.dataset.qty = qty;
            card.classList.toggle('is-in-cart', qty > 0);
            card.querySelector('.js-add-form').classList.toggle('d-none', qty > 0);
            card.querySelector('.js-stepper').classList.toggle('d-none', qty <= 0);

            const q = card.querySelector('.js-qty');
            q.textContent = Math.max(qty, 1);
            q.classList.remove('bump'); void q.offsetWidth; q.classList.add('bump');
        }

        function setQty(card, qty, message) {
            const prev = parseInt(card.dataset.qty) || 0;
            render(card, qty);
            clearTimeout(timers.get(card));
            timers.set(card, setTimeout(() => {
                sendQty(card.dataset.id, qty)
                    .then(() => { if (message) toast(message); })
                    .catch(() => { render(card, prev); toast('Ýalňyşlyk ýüze çykdy', true); });
            }, 250));
        }

        /* ---------- Gözleg we tertip ---------- */
        const grid = document.getElementById('productGrid');
        const filter = document.getElementById('filterInput');
        const noResult = document.getElementById('noResult');
        const chips = document.querySelectorAll('.sort-chip');

        if (grid) {
            const cols = Array.from(grid.querySelectorAll('[data-col]'));
            let sortMode = 'default';

            function applyView() {
                const q = (filter ? filter.value : '').trim().toLowerCase();
                const list = cols.slice();

                if (sortMode === 'asc') list.sort((a, b) => a.dataset.price - b.dataset.price);
                else if (sortMode === 'desc') list.sort((a, b) => b.dataset.price - a.dataset.price);
                else list.sort((a, b) => a.dataset.idx - b.dataset.idx);

                list.forEach(el => grid.appendChild(el));

                let visible = 0;
                cols.forEach(el => {
                    const show = !q || el.dataset.name.includes(q);
                    el.classList.toggle('d-none', !show);
                    if (show) { visible++; el.classList.add('in'); }
                });

                if (noResult) noResult.classList.toggle('d-none', visible > 0);
            }

            chips.forEach(chip => chip.addEventListener('click', () => {
                chips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                sortMode = chip.dataset.sort;
                applyView();
            }));

            if (filter) filter.addEventListener('input', applyView);
        }

        /* ---------- Hadysalar ---------- */
        document.addEventListener('submit', function (e) {
            const form = e.target.closest('.js-add-form');
            if (!form) return;
            e.preventDefault();
            setQty(form.closest('[data-cart-card]'), 1, 'Sebede goşuldy');
        });

        document.addEventListener('click', function (e) {
            const card = e.target.closest('[data-cart-card]');
            if (!card) return;
            const qty = parseInt(card.dataset.qty) || 0;

            if (e.target.closest('.js-plus')) setQty(card, qty + 1);
            else if (e.target.closest('.js-minus')) qty > 1 ? setQty(card, qty - 1) : setQty(card, 0, 'Sebetden aýryldy');
            else if (e.target.closest('.js-del')) setQty(card, 0, 'Sebetden aýryldy');
        });
    });
</script>
@endsection