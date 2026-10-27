@extends('client.layouts.header')

@section('title', 'Sebet')

@section('content')
<script>document.documentElement.classList.add('js-reveal');</script>

@php
    $cart = (isset($cart) && is_array($cart)) ? $cart : [];

    $totalItemsCount = 0;
    $totalPrice = 0;
    foreach ($cart as $item) {
        $qty = (int) ($item['quantity'] ?? 0);
        $price = (float) ($item['price'] ?? 0);
        $totalItemsCount += $qty;
        $totalPrice += $price * $qty;
    }

    // Suratyň ýoluny tapýar
    $imgUrl = function ($img) {
        if ($img && file_exists(public_path('img/' . $img))) return asset('img/' . $img);
        if ($img && file_exists(public_path($img))) return asset($img);
        if ($img && file_exists(public_path('storage/' . $img))) return asset('storage/' . $img);
        return asset('iconimg/yslam_shop.webp');
    };
@endphp

<style>
    :root {
        --ys-blue: #0d6efd;
        --ys-red: #dc3545;
        --ys-green: #198754;
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
    .cart-header-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.4rem 1.75rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f1f6ff 100%);
        border: 1px solid #e6eefb;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(13, 110, 253, .05);
    }

    .cart-header-card::after {
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

    .cart-header-card > * { position: relative; z-index: 1; }

    .ch-bubble {
        flex: 0 0 auto;
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e7f0ff;
        color: var(--ys-blue);
        font-size: 1.6rem;
        animation: bubblePop .7s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    @keyframes bubblePop { from { opacity: 0; transform: scale(.4) rotate(-20deg); } to { opacity: 1; transform: none; } }

    .ch-title {
        margin: 0;
        font-weight: 900;
        font-size: clamp(1.35rem, 1.1rem + 1vw, 1.9rem);
        letter-spacing: -.5px;
        color: var(--ys-ink);
    }

    .ch-title .cnt { color: var(--ys-blue); }

    .back-pill {
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
    .cart-list { display: grid; gap: .85rem; }

    .cart-item {
        display: grid;
        grid-template-columns: 84px minmax(0, 1fr) auto auto 40px;
        grid-template-areas: "thumb info qty total del";
        align-items: center;
        gap: 1rem;
        padding: .9rem 1rem;
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 22px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, .03);
        transition: box-shadow .3s ease, border-color .3s ease, transform .3s ease;
        animation: itemIn .5s cubic-bezier(.16, 1, .3, 1) both;
        animation-delay: var(--d, 0ms);
    }

    .cart-item:hover {
        border-color: rgba(13, 110, 253, .25);
        box-shadow: 0 14px 30px rgba(13, 110, 253, .08);
    }

    .cart-item.removing { animation: itemOut .35s ease forwards; pointer-events: none; }

    @keyframes itemIn  { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
    @keyframes itemOut { to { opacity: 0; transform: translateX(40px) scale(.96); } }

    .ci-thumb {
        grid-area: thumb;
        width: 84px;
        height: 84px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: 18px;
        background: linear-gradient(145deg, #f8fafc, #edf2f7);
        overflow: hidden;
    }

    .ci-thumb img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 3px 6px rgba(0, 0, 0, .08));
        transition: transform .35s ease;
    }

    .cart-item:hover .ci-thumb img { transform: scale(1.1) rotate(-3deg); }

    .ci-info { grid-area: info; min-width: 0; }

    .ci-name {
        display: block;
        font-weight: 800;
        color: var(--ys-ink);
        text-decoration: none;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ci-name:hover { color: var(--ys-blue); }
    .ci-unit { font-size: .85rem; font-weight: 600; color: #64748b; }

    .qty-counter-group {
        grid-area: qty;
        display: inline-flex;
        align-items: center;
        padding: 3px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
    }

    .qty-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
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

    .qty-btn:hover { background: var(--ys-blue); color: #fff; }
    .qty-btn:active { transform: scale(.92); }

    .qty-number { min-width: 38px; text-align: center; font-weight: 900; color: var(--ys-ink); }

    .item-total-price {
        grid-area: total;
        min-width: 100px;
        text-align: right;
        font-weight: 900;
        color: var(--ys-blue);
        white-space: nowrap;
    }

    .bump { animation: bump .3s ease; display: inline-block; }

    @keyframes bump { 50% { transform: scale(1.18); } }

    .btn-delete {
        grid-area: del;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 12px;
        background: #f8fafc;
        color: #94a3b8;
        transition: all .2s ease;
    }

    .btn-delete:hover { background: #fdecee; color: var(--ys-red); transform: rotate(-8deg) scale(1.08); }

    /* ---------- Sargyt formasy ---------- */
    .checkout-card {
        padding: 1.5rem;
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 26px;
        box-shadow: 0 12px 32px rgba(13, 110, 253, .07);
    }

    @media (min-width: 992px) {
        .checkout-card { position: sticky; top: 150px; }
    }

    .co-title {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin: 0 0 1.25rem;
        font-weight: 900;
        font-size: 1.15rem;
        color: var(--ys-ink);
    }

    .co-title i { color: var(--ys-green); }

    .co-step {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin: 0 0 .6rem;
        font-size: .78rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #64748b;
    }

    .co-step b {
        width: 22px;
        height: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--ys-blue);
        color: #fff;
        font-size: .72rem;
    }

    .form-label { font-size: .82rem; font-weight: 700; color: #475569; margin-bottom: .3rem; }
    .form-label .ru { font-weight: 600; color: #94a3b8; }

    .checkout-card .form-control,
    .checkout-card .form-select,
    .checkout-card .input-group-text {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        font-weight: 600;
        padding-top: .65rem;
        padding-bottom: .65rem;
    }

    .checkout-card .form-control,
    .checkout-card .form-select { border-radius: 14px; }

    .checkout-card .input-group > .input-group-text { border-radius: 14px 0 0 14px; border-right: 0; color: var(--ys-ink); font-weight: 800; }
    .checkout-card .input-group > .form-control { border-radius: 0 14px 14px 0; border-left: 0; }

    .checkout-card .form-control:focus,
    .checkout-card .form-select:focus {
        background: #fff;
        border-color: var(--ys-blue);
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
    }

    .checkout-card .input-group:focus-within .input-group-text { border-color: var(--ys-blue); background: #fff; }
    .checkout-card .form-select:disabled { background: #f1f5f9; opacity: .7; }

    .summary-box {
        padding: 1rem 1.1rem;
        margin: 1.25rem 0;
        border-radius: 20px;
        background: linear-gradient(135deg, #f0f7ff, #e8f2ff);
        border: 1.5px solid #d0e3ff;
    }

    .sum-row { display: flex; justify-content: space-between; gap: 1rem; margin-bottom: .45rem; font-size: .88rem; }
    .sum-row .k { font-weight: 600; color: #64748b; }
    .sum-row .v { font-weight: 800; color: var(--ys-ink); }
    .sum-row .v.free { color: var(--ys-green); }

    .sum-total {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: .6rem;
        padding-top: .75rem;
        border-top: 1px dashed #b6d4fe;
    }

    .sum-total .k { font-weight: 800; color: var(--ys-ink); }
    .sum-total .v { font-size: 1.55rem; font-weight: 900; letter-spacing: -.5px; color: var(--ys-blue); }

    .tick { animation: tick .35s ease; display: inline-block; }

    @keyframes tick {
        0%   { transform: translateY(0); }
        40%  { transform: translateY(-5px); opacity: .5; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .btn-checkout-submit {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        width: 100%;
        padding: .95rem;
        border: 0;
        border-radius: 16px;
        background: linear-gradient(135deg, #198754, #146c43);
        color: #fff;
        font-weight: 800;
        font-size: 1rem;
        box-shadow: 0 8px 22px rgba(25, 135, 84, .3);
        transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .btn-checkout-submit::after {
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

    @keyframes shine { 0%, 60% { left: -80%; } 100% { left: 140%; } }

    .btn-checkout-submit:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(25, 135, 84, .42);
    }

    .btn-checkout-submit:disabled { opacity: .75; cursor: wait; }

    #form-errors {
        display: none;
        margin-bottom: 1rem;
        padding: .8rem 1rem;
        border-radius: 14px;
        background: #fdecee;
        border: 1px solid #f8c9ce;
        color: #b02a37;
        font-size: .88rem;
        font-weight: 700;
    }

    #form-errors.show { display: block; animation: itemIn .35s ease; }
    #form-errors ul { margin: 0; padding-left: 1.1rem; }

    /* ---------- Boş sebet ---------- */
    .empty-cart-card {
        text-align: center;
        padding: 3rem 1.5rem;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid var(--ys-line);
        border-radius: 28px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, .03);
    }

    .empty-cart-icon-wrapper {
        width: 110px;
        height: 110px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        animation: floatAnimation 3s ease-in-out infinite;
    }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .btn-shop-start {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .85rem 2rem;
        border: 0;
        border-radius: 50rem;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(13, 110, 253, .28);
        transition: all .3s ease;
    }

    .btn-shop-start:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 12px 26px rgba(13, 110, 253, .4); }

    /* ---------- Üstünlik modaly ---------- */
    .success-modal .modal-content { border: 0; border-radius: 28px; box-shadow: 0 30px 70px rgba(15, 23, 42, .3); }

    .success-ring {
        position: relative;
        width: 92px;
        height: 92px;
        margin: 0 auto 1.25rem;
    }

    .success-ring .circle {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, #198754, #146c43);
        box-shadow: 0 10px 25px rgba(25, 135, 84, .4);
    }

    .modal.show .success-ring .circle { animation: bubblePop .7s .1s cubic-bezier(.34, 1.56, .64, 1) both; }

    .success-ring .wave {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid var(--ys-green);
        opacity: 0;
    }

    .modal.show .success-ring .wave { animation: wave 2s .5s ease-out infinite; }
    .modal.show .success-ring .wave.w2 { animation-delay: 1.2s; }

    @keyframes wave { 0% { opacity: .6; transform: scale(1); } 100% { opacity: 0; transform: scale(1.7); } }

    .success-check {
        width: 46px;
        height: 46px;
        fill: none;
        stroke: #fff;
        stroke-width: 5;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 60;
        stroke-dashoffset: 60;
    }

    .modal.show .success-check { animation: drawCheck .5s .45s ease forwards; }

    @keyframes drawCheck { to { stroke-dashoffset: 0; } }

    /* ================= MOBIL ================= */
    @media (max-width: 767.98px) {
        .cart-header-card { padding: 1.1rem; border-radius: 20px; }
        .ch-bubble { width: 46px; height: 46px; font-size: 1.3rem; }
        .back-pill span { display: none; }
        .back-pill { padding: .55rem .8rem; }

        .cart-item {
            grid-template-columns: 68px minmax(0, 1fr) auto;
            grid-template-areas:
                "thumb info  del"
                "thumb qty   total";
            gap: .55rem .8rem;
            padding: .8rem;
            border-radius: 20px;
        }

        .ci-thumb { width: 68px; height: 68px; border-radius: 16px; align-self: start; }
        .qty-counter-group { justify-self: start; }
        .qty-btn { width: 32px; height: 32px; }
        .qty-number { min-width: 32px; }
        .item-total-price { min-width: 0; font-size: .98rem; }
        .btn-delete { width: 36px; height: 36px; }
        .checkout-card { padding: 1.2rem; border-radius: 22px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .js-reveal .reveal { opacity: 1; transform: none; transition: none; }
        .cart-item, .ch-bubble, .empty-cart-icon-wrapper, .btn-checkout-submit::after { animation: none !important; }
        .success-check { stroke-dashoffset: 0; animation: none !important; }
    }
</style>

<div class="container-lg py-4">

    {{-- ================= SÖZBAŞY ================= --}}
    <div class="cart-header-card reveal">
        <div class="d-flex align-items-center gap-3" style="min-width: 0;">
            <div class="ch-bubble"><i class="bi bi-cart3"></i></div>
            <h1 class="ch-title">Sebet (<span id="cart-total-count" class="cnt">{{ $totalItemsCount }}</span>)</h1>
        </div>
        <a href="{{ route('home.index') }}" class="back-pill">
            <i class="bi bi-arrow-left"></i><span>Söwda dowam etmek</span>
        </a>
    </div>

    @if(count($cart) > 0)
    <div class="row g-4" id="cart-content">

        {{-- ================= HARYTLAR ================= --}}
        <div class="col-lg-8">
            <div class="cart-list" id="cart-list">
                @foreach($cart as $id => $details)
                <div class="cart-item" id="cart-row-{{ $id }}" data-id="{{ $id }}" data-price="{{ $details['price'] }}" data-d="{{ min($loop->index, 6) * 70 }}">

                    <a href="{{ route('products.show', $id) }}" class="ci-thumb">
                        <img src="{{ $imgUrl($details['image'] ?? null) }}" alt="{{ $details['name'] }}" loading="lazy">
                    </a>

                    <div class="ci-info">
                        <a href="{{ route('products.show', $id) }}" class="ci-name" title="{{ $details['name'] }}">{{ $details['name'] }}</a>
                        <span class="ci-unit">{{ number_format($details['price'], 0, ',', ' ') }} TMT</span>
                    </div>

                    <div class="qty-counter-group">
                        <button class="qty-btn btn-minus" type="button" data-id="{{ $id }}" aria-label="Azalt">−</button>
                        <span class="qty-number" id="qty-{{ $id }}">{{ $details['quantity'] }}</span>
                        <button class="qty-btn btn-plus" type="button" data-id="{{ $id }}" aria-label="Köpelt">+</button>
                    </div>

                    <div class="item-total-price" id="total-{{ $id }}">
                        {{ number_format($details['price'] * $details['quantity'], 0, ',', ' ') }} TMT
                    </div>

                    <button class="btn-delete" type="button" data-id="{{ $id }}" title="Pozmak" aria-label="Pozmak">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ================= SARGYT ETMEK ================= --}}
        <div class="col-lg-4">
            <div class="checkout-card reveal" data-d="150">
                <h2 class="co-title"><i class="bi bi-bag-check-fill"></i>Sargyt etmek <span class="text-muted fw-semibold small">/ Оформление</span></h2>

                <form id="checkout-form" action="{{ route('orders.store') }}" method="POST" novalidate>
                    @csrf

                    <div id="form-errors" role="alert"></div>

                    <div class="co-step"><b>1</b> Aragatnaşyk</div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefon belgisi <span class="ru">/ Номер телефона</span></label>
                        <div class="input-group">
                            <span class="input-group-text px-3">+993</span>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="6XXXXXXX"
                                inputmode="numeric" maxlength="8" autocomplete="tel-national" required>
                        </div>
                    </div>

                    <div class="co-step mt-4"><b>2</b> Eltip bermek</div>
                    <div class="mb-3">
                        <label for="welayat" class="form-label">Welaýat <span class="ru">/ Регион</span></label>
                        <select name="welayat" id="welayat" class="form-select" required>
                            <option value="" disabled selected>Welaýaty saýlaň...</option>
                            <option value="ashgabat">Aşgabat</option>
                            <option value="ahal">Ahal</option>
                            <option value="balkan">Balkan</option>
                            <option value="lebap">Lebap</option>
                            <option value="mary">Mary</option>
                            <option value="dasoguz">Daşoguz</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Şäher / Etrap <span class="ru">(Город / Район)</span></label>
                        <select name="city" id="city" class="form-select" disabled required>
                            <option value="" disabled selected>Öňünçä welaýaty saýlaň...</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="address" class="form-label">Eltip bermeli salgy <span class="ru">/ Точный адрес</span></label>
                        <textarea name="address" id="address" rows="2" class="form-control" placeholder="Köçe, öý/öýjük..." required></textarea>
                    </div>

                    <div class="summary-box">
                        <div class="sum-row">
                            <span class="k">Harytlaryň sany:</span>
                            <span class="v" id="summary-items-count">{{ $totalItemsCount }}</span>
                        </div>
                        <div class="sum-row">
                            <span class="k">Harytlaryň bahasy:</span>
                            <span class="v" id="summary-subtotal">{{ number_format($totalPrice, 0, ',', ' ') }} TMT</span>
                        </div>
                        <div class="sum-row mb-0">
                            <span class="k">Eltip bermek <span style="color:#94a3b8">(Доставка)</span>:</span>
                            <span class="v free" id="summary-delivery">0 TMT</span>
                        </div>
                        <div class="sum-total">
                            <span class="k">Jemi baha:</span>
                            <span class="v" id="cart-grand-total">{{ number_format($totalPrice, 0, ',', ' ') }} TMT</span>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn-checkout-submit">
                        <i class="bi bi-check-circle-fill"></i><span id="submit-label">Sargydy tassyklamak</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @else
    {{-- ================= BOŞ ================= --}}
    <div class="empty-cart-card reveal my-4">
        <div class="mb-4">
            <div class="empty-cart-icon-wrapper">
                <i class="bi bi-cart-x fs-1 text-primary"></i>
            </div>
        </div>
        <h4 class="fw-bold text-dark mb-2">Sebetiňiz boş</h4>
        <p class="text-muted small mb-4 mx-auto" style="max-width: 380px; line-height: 1.5;">
            Siziň sebediňizde häzirlikçe hiç hili haryt ýok. Kataloga geçip özüňize göwünli harytlary saýlap bilersiňiz!
        </p>
        <a href="{{ route('home.index') }}" class="btn-shop-start">
            <i class="bi bi-bag-plus-fill fs-5"></i>Söwda başlamak
        </a>
    </div>
    @endif
</div>

{{-- ================= ÜSTÜNLIK MODALY ================= --}}
<div class="modal fade success-modal" id="orderSuccessModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4 p-md-5">
                <div class="success-ring">
                    <span class="wave"></span>
                    <span class="wave w2"></span>
                    <div class="circle">
                        <svg class="success-check" viewBox="0 0 52 52"><path d="M12 27l10 10 18-20"></path></svg>
                    </div>
                </div>

                <h4 class="fw-bold text-dark mb-2" style="font-weight: 800;">Sargyt kabul edildi!</h4>
                <p class="text-muted small mb-4" style="font-size: .95rem; line-height: 1.5;">
                    Siziň sargydyňyz üstünlikli öndürildi. Tiz arada operatorymyz siziň bilen habarlaşar!
                </p>

                <div class="p-3 bg-light rounded-4 mb-4 text-start border border-1 border-light-subtle">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small fw-semibold">Jemi baha:</span>
                        <span class="fw-bold text-primary" id="modal-order-total">0 TMT</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small fw-semibold">Eltip bermeli salgy:</span>
                        <span class="fw-bold text-dark text-truncate ms-2" style="max-width: 180px;" id="modal-order-address">-</span>
                    </div>
                </div>

                <a href="{{ route('home.index') }}" class="btn btn-success btn-lg w-100 fw-bold py-3 shadow-sm rounded-4 text-decoration-none"
                    style="background: linear-gradient(135deg, #198754, #146c43); border: none;">
                    Baş sahypa geçmek
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        /* ---------- Peýda bolmak ---------- */
        const reveals = document.querySelectorAll('.reveal');
        document.querySelectorAll('[data-d]').forEach(el => el.style.setProperty('--d', el.dataset.d + 'ms'));

        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
                });
            }, { threshold: .08, rootMargin: '0px 0px -30px 0px' });
            reveals.forEach(el => io.observe(el));
        } else {
            reveals.forEach(el => el.classList.add('in'));
        }

        /* ---------- Eltip bermek tarifleri: [ady, baha] ---------- */
        const deliveryRates = {
            ashgabat: [['Aşgabat şäheri', 20], ['Täze Gurtly', 30], ['Gurtly', 30], ['Çoganly', 30]],
            ahal: [['Änew', 30], ['Änew Magtymguly', 40], ['Gökdepe', 40], ['Bäherden', 50], ['Kaka', 50], ['Tejen', 50]],
            balkan: [['Türkmenbaşy ş.', 50], ['Mikraýon', 50], ['Janga', 60], ['Ufra', 60], ['Awaza', 100], ['Gyýanlyk', 70], ['Guwlumaýak', 70], ['Belek', 60], ['Jebel', 70], ['Nebitdag', 70], ['Gyzylarbat', 70], ['Bizmergen', 80], ['Çeleken / Hazar', 80], ['Bekdaş / Garabogaz', 80], ['Gumdag', 80], ['Gazanjyk / Bereket', 90], ['Serdar', 90], ['Esenguly', 90], ['Etrek', 100]],
            lebap: [['Türkmenabat ş.', 50], ['Serdarabat', 70], ['Dänew', 70], ['Sakar', 70], ['Seýdi', 80], ['Saýat', 80], ['Garabekewül', 80], ['Farap', 80], ['Darganata', 80], ['Halaç', 80], ['Kerki', 80], ['Hojambaz', 90], ['Amyderýa', 90], ['Köýtendag', 100], ['Gazojak', 100], ['Magdanly', 100], ['Döwletli', 100]],
            mary: [['Mary ş.', 50], ['Ýölöten', 70], ['Murgap', 70], ['Türkmengala', 70], ['Baýramaly', 70], ['Wekilbazar', 70], ['Garagum', 80], ['Sakarçäge', 80], ['Oguzhan', 80], ['Şatlyk', 80], ['Tagtabazar', 90]],
            dasoguz: [['Daşoguz ş.', 50], ['Akdepe', 70], ['Gurbansoltan', 70], ['Gubadag', 70], ['S.A.Nyýazow', 70], ['Şabat', 80], ['Türkmenbaşy etr.', 80], ['Boldumsaz', 70], ['Görogly', 80], ['Köneürgenç', 100], ['Ruhybelent', 60], ['Täze oba', 60], ['Gülüstan', 60]] };

        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
        let currentDeliveryPrice = 0;

        function formatPrice(amount) {
            return new Intl.NumberFormat('ru-RU').format(amount) + ' TMT';
        }

        function setText(el, text) {
            if (!el || el.textContent === text) return;
            el.textContent = text;
            el.classList.remove('tick'); void el.offsetWidth; el.classList.add('tick');
        }

        function setBadges(n) {
            document.querySelectorAll('#cart-badge-count, .cart-badge').forEach(b => {
                b.textContent = n;
                b.classList.toggle('d-none', n <= 0);
            });
        }

        /* ---------- Jemi hasaplamak ---------- */
        function recalc() {
            let subtotal = 0, qtyTotal = 0;

            document.querySelectorAll('.cart-item:not(.removing)').forEach(row => {
                const price = parseFloat(row.dataset.price) || 0;
                const qty = parseInt(row.querySelector('.qty-number').textContent) || 0;
                subtotal += price * qty;
                qtyTotal += qty;
            });

            setText(document.getElementById('summary-subtotal'), formatPrice(subtotal));
            setText(document.getElementById('summary-delivery'), formatPrice(currentDeliveryPrice));
            setText(document.getElementById('cart-grand-total'), formatPrice(subtotal + currentDeliveryPrice));
            setText(document.getElementById('cart-total-count'), String(qtyTotal));
            setText(document.getElementById('summary-items-count'), String(qtyTotal));
        }

        /* ---------- Welaýat / şäher ---------- */
        const welayatSelect = document.getElementById('welayat');
        const citySelect = document.getElementById('city');

        if (welayatSelect && citySelect) {
            welayatSelect.addEventListener('change', function () {
                citySelect.innerHTML = '<option value="" disabled selected>Şäheri / Etrapy saýlaň...</option>';
                citySelect.disabled = false;

                (deliveryRates[this.value] || []).forEach(([name, price]) => {
                    const opt = document.createElement('option');
                    opt.value = name;
                    opt.dataset.price = price;
                    opt.textContent = `${name} (${price} TMT)`;
                    citySelect.appendChild(opt);
                });

                currentDeliveryPrice = 0;
                recalc();
            });

            citySelect.addEventListener('change', function () {
                currentDeliveryPrice = parseFloat(this.options[this.selectedIndex].dataset.price) || 0;
                recalc();
            });
        }

        /* ---------- Sebet serwere ugratmak ---------- */
        const timers = {};

        function sendCartUpdate(id, qty, reloadIfEmpty) {
            fetch(`/cart/ajax-add/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ quantity: qty })
            })
            .then(r => r.json())
            .then(data => {
                if (data.cart_count !== undefined) {
                    setBadges(data.cart_count);
                    if (reloadIfEmpty || data.cart_count === 0) location.reload();
                }
            })
            .catch(err => console.error('Error:', err));
        }

        function queueUpdate(id, qty, reloadIfEmpty) {
            clearTimeout(timers[id]);
            timers[id] = setTimeout(() => sendCartUpdate(id, qty, reloadIfEmpty), 250);
        }

        function setQty(row, qty) {
            const id = row.dataset.id;
            const price = parseFloat(row.dataset.price) || 0;
            const qtyEl = row.querySelector('.qty-number');
            const totalEl = row.querySelector('.item-total-price');

            qtyEl.textContent = qty;
            setText(totalEl, formatPrice(price * qty));
            qtyEl.classList.remove('bump'); void qtyEl.offsetWidth; qtyEl.classList.add('bump');

            recalc();
            queueUpdate(id, qty, false);
        }

        function removeRow(row) {
            const id = row.dataset.id;
            row.classList.add('removing');

            setTimeout(() => {
                row.remove();
                recalc();
                const left = document.querySelectorAll('.cart-item').length;
                clearTimeout(timers[id]);
                sendCartUpdate(id, 0, left === 0);
            }, 320);
        }

        document.querySelectorAll('.cart-item').forEach(row => {
            row.querySelector('.btn-plus').addEventListener('click', () => {
                setQty(row, (parseInt(row.querySelector('.qty-number').textContent) || 0) + 1);
            });

            row.querySelector('.btn-minus').addEventListener('click', () => {
                const q = (parseInt(row.querySelector('.qty-number').textContent) || 0) - 1;
                q > 0 ? setQty(row, q) : removeRow(row);
            });

            row.querySelector('.btn-delete').addEventListener('click', () => removeRow(row));
        });

        /* ---------- Sargyt formasy (AJAX) ---------- */
        const form = document.getElementById('checkout-form');

        if (form) {
            const phone = document.getElementById('phone');
            const submitBtn = document.getElementById('submit-btn');
            const submitLabel = document.getElementById('submit-label');
            const errBox = document.getElementById('form-errors');

            // diňe sanlar
            phone.addEventListener('input', () => { phone.value = phone.value.replace(/\D/g, '').slice(0, 8); });

            form.addEventListener('input', e => e.target.classList?.remove('is-invalid'));

            function setLoading(on) {
                submitBtn.disabled = on;
                submitLabel.textContent = on ? 'Ugradylýar...' : 'Sargydy tassyklamak';
                submitBtn.querySelector('i').className = on ? 'bi bi-hourglass-split' : 'bi bi-check-circle-fill';
            }

            function showErrors(messages, fields) {
                errBox.innerHTML = '<ul>' + messages.map(m => `<li>${m.replace(/[<>&]/g, '')}</li>`).join('') + '</ul>';
                errBox.classList.add('show');
                fields.forEach(name => form.querySelector(`[name="${name}"]`)?.classList.add('is-invalid'));
                errBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                errBox.classList.remove('show');

                // ýönekeý barlag (boş meýdanlar)
                const missing = [];
                ['phone', 'welayat', 'city', 'address'].forEach(n => {
                    const el = form.elements[n];
                    if (!el || !String(el.value).trim()) missing.push(n);
                });

                if (missing.length) {
                    showErrors(['Ähli meýdanlary dolduryň'], missing);
                    return;
                }

                setLoading(true);

                const grandTotalText = document.getElementById('cart-grand-total')?.textContent || '0 TMT';
                const addressText = document.getElementById('address')?.value || '';

                fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                    body: new FormData(form)
                })
                .then(async response => {
                    if (response.ok) {
                        document.getElementById('modal-order-total').textContent = grandTotalText;
                        document.getElementById('modal-order-address').textContent = addressText;
                        setBadges(0);
                        new bootstrap.Modal(document.getElementById('orderSuccessModal')).show();
                        return; // düwme ýapyk galýar: iki gezek sargyt edilmesin
                    }

                    if (response.status === 422) {
                        const data = await response.json().catch(() => ({}));
                        const errors = data.errors || {};
                        const msgs = Object.values(errors).flat();
                        showErrors(msgs.length ? msgs : [data.message || 'Maglumatlary barlaň'], Object.keys(errors));
                        setLoading(false);
                        return;
                    }

                    throw new Error('Server error: ' + response.status);
                })
                .catch(error => {
                    console.error('Submit error:', error);
                    form.submit(); // adaty ugratma
                });
            });
        }

        recalc();
    });
</script>
@endsection