@extends('client.layouts.header')

@section('title', $product->name)

@section('content')
<style>
    :root {
        --ys-blue: #0d6efd;
        --ys-red: #dc3545;
        --ys-ink: #0f172a;
    }

    .anim-in { animation: pdIn .7s cubic-bezier(.16, 1, .3, 1) both; animation-delay: var(--d, 0ms); }

    @keyframes pdIn {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: none; }
    }

    .breadcrumb { --bs-breadcrumb-divider: '›'; flex-wrap: nowrap; overflow-x: auto; white-space: nowrap; scrollbar-width: none; }
    .breadcrumb::-webkit-scrollbar { display: none; }
    .breadcrumb-item a { transition: color .2s; }
    .breadcrumb-item a:hover { color: var(--ys-blue) !important; }

    .product-detail-card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, .04);
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(15, 23, 42, .06);
    }

    .product-image-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(145deg, #f8fafc, #edf2f7);
        border: 1px solid rgba(226, 232, 240, .8);
    }

    .product-image-wrapper::before,
    .product-image-wrapper::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .product-image-wrapper::before { width: 320px; height: 320px; background: var(--ys-blue); opacity: .06; top: -110px; right: -90px; }
    .product-image-wrapper::after  { width: 200px; height: 200px; background: var(--ys-red); opacity: .05; bottom: -70px; left: -60px; }

    .product-main-img {
        position: relative;
        z-index: 1;
        max-width: 100%;
        max-height: 380px;
        object-fit: contain;
        filter: drop-shadow(0 12px 18px rgba(0, 0, 0, .1));
        transition: transform .5s cubic-bezier(.34, 1.56, .64, 1), filter .5s ease;
        animation: pdFloat 6s ease-in-out infinite;
    }

    .product-image-wrapper:hover .product-main-img {
        transform: scale(1.08) translateY(-6px);
        filter: drop-shadow(0 22px 28px rgba(0, 0, 0, .16));
    }

    @keyframes pdFloat {
        0%, 100% { translate: 0 0; }
        50%      { translate: 0 -8px; }
    }

    .category-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .45rem 1rem;
        border-radius: 50rem;
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #fff !important;
        font-size: .9rem;
        font-weight: 700;
        letter-spacing: .3px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(13, 110, 253, .25);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .category-badge-pill:hover { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(13, 110, 253, .35); }

    .pd-title {
        margin: 0 0 .75rem;
        font-size: clamp(1.6rem, 1.1rem + 1.8vw, 2.5rem);
        font-weight: 900;
        line-height: 1.15;
        letter-spacing: -.6px;
        color: var(--ys-ink);
        word-break: break-word;
    }

    .pd-desc-box {
        padding: 1rem 1.15rem;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
    }

    .pd-desc-title {
        display: flex;
        align-items: center;
        gap: .4rem;
        margin: 0 0 .4rem;
        font-size: .8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #64748b;
    }

    .pd-desc-title i { color: var(--ys-blue); }

    .price-display-wrapper {
        display: inline-flex;
        align-items: baseline;
        gap: 6px;
        padding: 12px 22px;
        border-radius: 20px;
        background: linear-gradient(135deg, #f0f7ff, #e8f2ff);
        border: 1.5px solid #d0e3ff;
    }

    .price-number {
        display: inline-block;
        font-size: 2.4rem;
        font-weight: 900;
        letter-spacing: -.5px;
        color: var(--ys-blue);
    }

    .price-number.tick { animation: priceTick .35s ease; }

    @keyframes priceTick {
        0%   { transform: translateY(0); }
        40%  { transform: translateY(-6px); opacity: .5; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .unit-line { font-size: .85rem; font-weight: 600; color: #64748b; }

    .btn-add-cart-wow {
        position: relative;
        overflow: hidden;
        border: 0;
        border-radius: 18px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        font-size: 1.1rem;
        font-weight: 800;
        box-shadow: 0 8px 25px rgba(13, 110, 253, .35);
        transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .btn-add-cart-wow::after {
        content: "";
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .35), transparent);
        transform: skewX(-20deg);
        animation: shine 3.5s ease-in-out infinite;
    }

    @keyframes shine {
        0%, 60% { left: -80%; }
        100%    { left: 140%; }
    }

    .btn-add-cart-wow:hover {
        transform: translateY(-3px) scale(1.01);
        box-shadow: 0 12px 30px rgba(13, 110, 253, .5);
        color: #fff;
    }

    .btn-add-cart-wow:active { transform: translateY(-1px) scale(.99); }

    #quantity-control-block { animation: qtyIn .4s cubic-bezier(.34, 1.56, .64, 1); }

    @keyframes qtyIn { from { opacity: 0; transform: scale(.92); } to { opacity: 1; transform: none; } }

    .qty-control-wrapper {
        padding: 4px;
        border-radius: 18px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
    }

    .btn-qty-action {
        width: 46px;
        height: 46px;
        border: none !important;
        border-radius: 14px !important;
        background: #fff;
        color: var(--ys-blue);
        font-size: 1.3rem;
        font-weight: 900;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .06);
        transition: all .2s ease;
    }

    .btn-qty-action:hover { background: var(--ys-blue); color: #fff; transform: scale(1.06); }

    #qty-number.bump { animation: qtyBump .3s ease; display: inline-block; }

    @keyframes qtyBump { 50% { transform: scale(1.4); color: var(--ys-blue); } }

    .btn-wishlist-toggle {
        border: 2px solid #fee2e2;
        border-radius: 18px !important;
        background: #fff5f5;
        color: var(--ys-red);
        transition: all .3s ease;
    }

    .btn-wishlist-toggle:hover {
        background: var(--ys-red);
        border-color: var(--ys-red);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, .3);
    }

    .feature-card-item {
        display: flex;
        align-items: center;
        gap: .6rem;
        height: 100%;
        padding: 12px 14px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        transition: all .3s ease;
    }

    .feature-card-item:hover {
        background: #fff;
        border-color: var(--ys-blue);
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(13, 110, 253, .1);
    }

    .feature-card-item i { font-size: 1.5rem; }

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

    @media (max-width: 767.98px) {
        .product-image-wrapper { min-height: 280px; }
        .product-main-img { max-height: 250px; }
        .price-number { font-size: 2rem; }
    }

    @media (prefers-reduced-motion: reduce) {
        .anim-in, .product-main-img, .btn-add-cart-wow::after, #quantity-control-block { animation: none !important; }
    }
</style>

<div class="container-lg py-4">
    <nav aria-label="breadcrumb" class="mb-4 anim-in">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="text-decoration-none fw-bold text-secondary">Baş sahypa</a></li>
            @if($product->category)
            <li class="breadcrumb-item">
                <a href="{{ route('categories.show', $product->category->id) }}" class="text-decoration-none fw-bold text-secondary">
                    {{ $product->category->name }}
                </a>
            </li>
            @endif
            <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="product-detail-card p-3 p-md-4 p-lg-5 mb-5 anim-in" style="--d: 60ms">
        <div class="row g-4 g-lg-5 align-items-center">

            {{-- ================= SURAT ================= --}}
            <div class="col-md-6 anim-in" style="--d: 150ms">
                <div class="product-image-wrapper p-4">
                    @if($product->image && file_exists(public_path('img/' . $product->image)))
                    <img src="{{ asset('img/' . $product->image) }}" class="img-fluid product-main-img" alt="{{ $product->name }}">
                    @elseif($product->image && file_exists(public_path($product->image)))
                    <img src="{{ asset($product->image) }}" class="img-fluid product-main-img" alt="{{ $product->name }}">
                    @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid product-main-img" alt="{{ $product->name }}">
                    @else
                    <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="img-fluid product-main-img" alt="No Image">
                    @endif
                </div>
            </div>

            {{-- ================= MAGLUMAT ================= --}}
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div class="anim-in" style="--d: 220ms">
                    @if($product->category)
                    <a href="{{ route('categories.show', $product->category->id) }}" class="category-badge-pill mb-3">
                        <i class="bi bi-grid-fill"></i> {{ $product->category->name }}
                    </a>
                    @endif

                    <h1 class="pd-title">{{ $product->name }}</h1>

                    <div class="pd-desc-box mb-4">
                        <h2 class="pd-desc-title"><i class="bi bi-card-text"></i> Beýany</h2>
                        <p class="text-muted mb-0 lh-base" style="word-break: break-word;">
                            {{ $product->description ?? 'Barada maglumat ýok' }}
                        </p>
                    </div>
                </div>

                <div class="anim-in" style="--d: 300ms">
                    @php
                    $cart = session()->get('cart', []);
                    $inCart = isset($cart[$product->id]);
                    $currentQty = $inCart ? $cart[$product->id]['quantity'] : 1;
                    $unitPrice = $product->price;
                    $totalPrice = $unitPrice * $currentQty;
                    @endphp

                    <div class="mb-4">
                        <div class="price-display-wrapper shadow-sm" id="price-container" data-unit-price="{{ $unitPrice }}">
                            <span class="price-number" id="product-total-price">{{ number_format($totalPrice, 0, ',', ' ') }}</span>
                            <span class="fw-bold fs-4 text-primary">TMT</span>
                        </div>
                        <div class="unit-line mt-2 {{ $currentQty > 1 ? '' : 'd-none' }}" id="unit-line">
                            <i class="bi bi-tag-fill text-primary me-1"></i>Bir sanysy: {{ number_format($unitPrice, 0, ',', ' ') }} TMT
                        </div>
                    </div>

                    <div class="row g-2 align-items-center">
                        <div class="col-9 col-sm-10" id="cart-control-container" data-product-id="{{ $product->id }}">

                            <button id="add-to-cart-btn" class="btn btn-add-cart-wow w-100 py-3 d-flex align-items-center justify-content-center gap-2 {{ $inCart ? 'd-none' : '' }}">
                                <i class="bi bi-cart-plus-fill fs-4"></i>
                                <span>Sebede goş</span>
                            </button>

                            <div id="quantity-control-block" class="d-flex align-items-center gap-2 {{ !$inCart ? 'd-none' : '' }}">
                                <div class="qty-control-wrapper d-flex align-items-center flex-grow-1 justify-content-between">
                                    <button class="btn btn-qty-action d-flex align-items-center justify-content-center" type="button" id="btn-minus" aria-label="Azalt">−</button>
                                    <span class="fw-bold fs-4 text-dark px-3" id="qty-number">{{ $currentQty }}</span>
                                    <button class="btn btn-qty-action d-flex align-items-center justify-content-center" type="button" id="btn-plus" aria-label="Köpelt">+</button>
                                </div>

                                <button class="btn btn-outline-danger p-3 rounded-4" type="button" id="btn-delete" title="Sebetden poz" aria-label="Sebetden poz">
                                    <i class="bi bi-trash3-fill fs-5"></i>
                                </button>
                            </div>

                        </div>

                        <div class="col-3 col-sm-2">
                            {{-- TODO: Halanlara goşmak üçin route gelende, bu düwmäni forma ýa-da AJAX bilen baglaň --}}
                            <button type="button" class="btn btn-wishlist-toggle w-100 py-3 d-flex align-items-center justify-content-center" title="Halanlara goş" aria-label="Halanlara goş">
                                <i class="bi bi-heart-fill fs-4"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row g-2 mt-4 pt-3 border-top">
                        <div class="col-12 col-sm-4">
                            <div class="feature-card-item">
                                <i class="bi bi-truck text-primary"></i>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: .85rem;">Tiz eltip bermek</div>
                                    <div class="text-muted" style="font-size: .75rem;">24 sagadyň içinde</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="feature-card-item">
                                <i class="bi bi-shield-check text-success"></i>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: .85rem;">Kepillik bar</div>
                                    <div class="text-muted" style="font-size: .75rem;">100% Original</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="feature-card-item">
                                <i class="bi bi-headset text-danger"></i>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: .85rem;">Hyzmat 24/7</div>
                                    <div class="text-muted" style="font-size: .75rem;">Hemişe hyzmatyňyzda</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="ys-toast" id="ysToast" role="status" aria-live="polite"><i class="bi bi-check-circle-fill"></i><span></span></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('cart-control-container');
        if (!container) return;

        const productId = container.dataset.productId;
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const quantityBlock = document.getElementById('quantity-control-block');
        const qtyNumber = document.getElementById('qty-number');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');
        const btnDelete = document.getElementById('btn-delete');

        const priceContainer = document.getElementById('price-container');
        const priceDisplay = document.getElementById('product-total-price');
        const unitLine = document.getElementById('unit-line');
        const unitPrice = parseFloat(priceContainer.dataset.unitPrice) || 0;

        const toastEl = document.getElementById('ysToast');
        let toastTimer;
        let currentQuantity = parseInt(qtyNumber.textContent.trim()) || 1;
        let updateTimeout = null;

        function toast(text, isError) {
            toastEl.classList.toggle('err', !!isError);
            toastEl.querySelector('i').className = isError ? 'bi bi-exclamation-circle-fill' : 'bi bi-check-circle-fill';
            toastEl.querySelector('span').textContent = text;
            toastEl.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2000);
        }

        function formatPrice(amount) {
            return new Intl.NumberFormat('ru-RU').format(amount);
        }

        function animate(el, cls) {
            el.classList.remove(cls);
            void el.offsetWidth;
            el.classList.add(cls);
        }

        function updatePriceUI(qty) {
            const displayQty = qty > 0 ? qty : 1;
            priceDisplay.textContent = formatPrice(unitPrice * displayQty);
            animate(priceDisplay, 'tick');
            unitLine.classList.toggle('d-none', displayQty <= 1);
        }

        function setQtyUI(qty) {
            qtyNumber.textContent = qty;
            animate(qtyNumber, 'bump');
        }

        function setBadges(n) {
            document.querySelectorAll('#cart-badge-count, .cart-badge').forEach(b => {
                b.textContent = n;
                b.classList.toggle('d-none', n <= 0);
            });
        }

        function debouncedCartUpdate(qty, message) {
            clearTimeout(updateTimeout);
            updateTimeout = setTimeout(() => sendCartUpdate(qty, message), 300);
        }

        function sendCartUpdate(qty, message) {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch(`/cart/ajax-add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ quantity: qty })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Server error: ' + response.status);
                    return response.json();
                })
                .then(data => {
                    if (data.cart_count !== undefined) setBadges(data.cart_count);
                    if (message) toast(message);
                })
                .catch(error => {
                    console.error('Cart error:', error);
                    toast('Ýalňyşlyk ýüze çykdy', true);
                });
        }

        function showAddButton() {
            quantityBlock.classList.add('d-none');
            addToCartBtn.classList.remove('d-none');
            currentQuantity = 1;
            qtyNumber.textContent = 1;
            updatePriceUI(1);
            debouncedCartUpdate(0, 'Sebetden aýryldy');
        }

        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            addToCartBtn.classList.add('d-none');
            quantityBlock.classList.remove('d-none');

            currentQuantity = 1;
            qtyNumber.textContent = 1;

            updatePriceUI(1);
            debouncedCartUpdate(1, 'Sebede goşuldy');
        });

        btnPlus.addEventListener('click', function() {
            currentQuantity++;
            setQtyUI(currentQuantity);
            updatePriceUI(currentQuantity);
            debouncedCartUpdate(currentQuantity);
        });

        btnMinus.addEventListener('click', function() {
            if (currentQuantity > 1) {
                currentQuantity--;
                setQtyUI(currentQuantity);
                updatePriceUI(currentQuantity);
                debouncedCartUpdate(currentQuantity);
            } else {
                showAddButton();
            }
        });

        btnDelete.addEventListener('click', showAddButton);
    });
</script>
@endsection