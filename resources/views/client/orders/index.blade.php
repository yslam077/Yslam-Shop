@extends('client.layouts.header')

@section('content')
<script>document.documentElement.classList.add('js-reveal');</script>

@php
    $imgUrl = function ($img) {
        if ($img && file_exists(public_path('img/' . $img))) return asset('img/' . $img);
        if ($img && file_exists(public_path($img))) return asset($img);
        if ($img && file_exists(public_path('storage/' . $img))) return asset('storage/' . $img);
        return asset('iconimg/yslam_shop.webp');
    };
    $statuses = [
        'on_the_way' => ['label' => 'Garaşylýar',      'icon' => 'bi-hourglass-split',   'key' => 'wait'],
        'delivered'  => ['label' => 'Kabul edildi',    'icon' => 'bi-check-circle-fill', 'key' => 'ok'],
        'canceled'   => ['label' => 'Kabul edilmedi',  'icon' => 'bi-x-circle-fill',     'key' => 'no'],
    ];

    $all = $orders->getCollection();
    $counts = [
        'all'  => $all->count(),
        'wait' => $all->where('status', 'on_the_way')->count(),
        'ok'   => $all->where('status', 'delivered')->count(),
        'no'   => $all->where('status', 'canceled')->count(),
    ];
@endphp

<style>
    :root {
        --ys-blue: #0d6efd;
        --ys-red: #dc3545;
        --ys-ink: #0f172a;
        --ys-line: rgba(226, 232, 240, .9);
    }

    .js-reveal .reveal {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity .55s ease, transform .55s cubic-bezier(.16, 1, .3, 1);
        transition-delay: var(--d, 0ms);
    }

    .js-reveal .reveal.in { opacity: 1; transform: none; }

    /* ---------- Sözbaşy ---------- */
    .orders-header-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.5rem 1.75rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f1f6ff 100%);
        border: 1px solid #e6eefb;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(13, 110, 253, .05);
    }

    .orders-header-card::after {
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

    .orders-header-card > * { position: relative; z-index: 1; }

    .oh-bubble {
        flex: 0 0 auto;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e7f0ff;
        color: var(--ys-blue);
        font-size: 1.7rem;
        animation: bubblePop .7s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    @keyframes bubblePop { from { opacity: 0; transform: scale(.4) rotate(-20deg); } to { opacity: 1; transform: none; } }

    .oh-title {
        margin: 0 0 .15rem;
        font-weight: 900;
        font-size: clamp(1.35rem, 1.1rem + 1vw, 1.9rem);
        letter-spacing: -.5px;
        color: var(--ys-ink);
    }

    .oh-total {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .55rem 1.1rem;
        border-radius: 50rem;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        font-weight: 800;
        white-space: nowrap;
        box-shadow: 0 6px 16px rgba(13, 110, 253, .3);
    }

    .filter-row { display: flex; gap: .5rem; flex-wrap: wrap; margin-bottom: 1.25rem; }

    .f-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .5rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 50rem;
        background: #fff;
        color: #334155;
        font-size: .88rem;
        font-weight: 700;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .f-chip small {
        min-width: 22px;
        padding: 0 .4rem;
        border-radius: 50rem;
        background: #f1f5f9;
        color: #64748b;
        font-weight: 800;
        text-align: center;
        line-height: 1.5rem;
        transition: all .25s;
    }

    .f-chip:hover { border-color: var(--ys-blue); color: var(--ys-blue); transform: translateY(-2px); }

    .f-chip.active {
        background: var(--ys-blue);
        border-color: var(--ys-blue);
        color: #fff;
        box-shadow: 0 6px 14px rgba(13, 110, 253, .3);
    }

    .f-chip.active small { background: rgba(255, 255, 255, .22); color: #fff; }

    .st-wait { --st: #d97706; --st-bg: rgba(255, 193, 7, .16); --st-line: rgba(245, 158, 11, .35); }
    .st-ok   { --st: #15803d; --st-bg: rgba(25, 135, 84, .14); --st-line: rgba(34, 197, 94, .35); }
    .st-no   { --st: #dc2626; --st-bg: rgba(220, 53, 69, .13); --st-line: rgba(239, 68, 68, .35); }
    .st-none { --st: #64748b; --st-bg: #f1f5f9; --st-line: #e2e8f0; }

    .order-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .03);
        overflow: hidden;
        transition: box-shadow .3s ease, border-color .3s ease, transform .3s ease;
    }

    .order-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: var(--st);
    }

    .order-card:hover {
        transform: translateY(-3px);
        border-color: var(--st-line);
        box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
    }

    .order-card[open] { border-color: var(--st-line); }

    .order-sum {
        display: grid;
        grid-template-columns: 1.2fr auto auto auto 28px;
        grid-template-areas: "id thumbs status total chev";
        align-items: center;
        gap: 1rem 1.25rem;
        padding: 1.1rem 1.25rem 1.1rem 1.6rem;
        cursor: pointer;
        list-style: none;
        user-select: none;
    }

    .order-sum::-webkit-details-marker { display: none; }
    .order-sum::marker { content: ""; }

    .os-id { grid-area: id; min-width: 0; }
    .os-thumbs { grid-area: thumbs; }
    .os-status { grid-area: status; }
    .os-total { grid-area: total; text-align: right; }
    .os-chev { grid-area: chev; color: #94a3b8; transition: transform .35s cubic-bezier(.34, 1.56, .64, 1), color .2s; justify-self: end; }

    .order-card[open] .os-chev { transform: rotate(180deg); color: var(--st); }
    .order-sum:hover .os-chev { color: var(--st); }

    .os-num { font-size: 1.15rem; font-weight: 900; color: var(--ys-ink); letter-spacing: -.3px; }

    .os-date {
        display: flex;
        align-items: center;
        gap: .35rem;
        margin-top: .15rem;
        font-size: .82rem;
        font-weight: 600;
        color: #64748b;
    }

    .os-date i { color: var(--ys-blue); }

    .os-thumbs { display: flex; align-items: center; }

    .os-thumbs img,
    .os-more {
        width: 40px;
        height: 40px;
        margin-left: -12px;
        border-radius: 50%;
        border: 2px solid #fff;
        background: #f8fafc;
        object-fit: contain;
        padding: 3px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
        transition: transform .25s ease;
    }

    .os-thumbs > :first-child { margin-left: 0; }
    .order-sum:hover .os-thumbs img { transform: translateY(-3px); }

    .os-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--st-bg);
        color: var(--st);
        font-size: .75rem;
        font-weight: 800;
        padding: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .45rem .95rem;
        border-radius: 50rem;
        background: var(--st-bg);
        border: 1px solid var(--st-line);
        color: var(--st);
        font-size: .85rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .os-sum-num { font-size: 1.2rem; font-weight: 900; color: var(--ys-blue); letter-spacing: -.3px; white-space: nowrap; }
    .os-sum-cur { font-size: .8rem; font-weight: 800; color: var(--ys-blue); opacity: .8; }
    .os-sum-qty { display: block; font-size: .75rem; font-weight: 600; color: #94a3b8; }

    .order-body {
        padding: 0 1.25rem 1.25rem 1.6rem;
        border-top: 1px dashed #e2e8f0;
        animation: bodyIn .45s cubic-bezier(.16, 1, .3, 1);
    }

    @keyframes bodyIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: none; } }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem;
        margin: 1.1rem 0;
    }

    .info-box {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .8rem 1rem;
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 16px;
        min-width: 0;
    }

    .info-ico {
        flex: 0 0 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.1rem;
    }

    .info-ico.phone { background: #e7f0ff; color: var(--ys-blue); }
    .info-ico.addr  { background: #fdecee; color: var(--ys-red); }

    .info-label { font-size: .75rem; font-weight: 600; color: #64748b; line-height: 1.2; }
    .info-value { font-weight: 800; color: var(--ys-ink); overflow-wrap: anywhere; }

    .items-title {
        display: flex;
        align-items: center;
        gap: .45rem;
        margin: 0 0 .6rem;
        font-size: .8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #64748b;
    }

    .items-title i { color: var(--ys-blue); }

    .item-row {
        display: grid;
        grid-template-columns: 56px 1fr auto auto;
        align-items: center;
        gap: .85rem;
        padding: .7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .item-row:last-child { border-bottom: 0; }

    .item-thumb {
        width: 56px;
        height: 56px;
        object-fit: contain;
        padding: 4px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        transition: transform .3s ease;
    }

    .item-row:hover .item-thumb { transform: scale(1.08) rotate(-3deg); }

    .item-name {
        display: block;
        font-weight: 700;
        color: var(--ys-ink);
        text-decoration: none;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    a.item-name:hover { color: var(--ys-blue); }
    .item-name.gone { color: #94a3b8; font-style: italic; }
    .item-unit { font-size: .82rem; font-weight: 600; color: #64748b; }

    .item-qty {
        padding: .25rem .7rem;
        border-radius: 50rem;
        background: #f1f5f9;
        color: #475569;
        font-size: .82rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .item-sum { min-width: 90px; text-align: right; font-weight: 900; color: var(--ys-blue); white-space: nowrap; }

    .order-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: .6rem;
        padding: 1rem 1.15rem;
        border-radius: 18px;
        background: linear-gradient(135deg, #f0f7ff, #e8f2ff);
        border: 1.5px solid #d0e3ff;
    }

    .order-foot .lbl { font-weight: 700; color: #475569; }
    .order-foot .sum { font-size: 1.7rem; font-weight: 900; letter-spacing: -.5px; color: var(--ys-blue); }
    .order-foot .cur { font-weight: 800; color: var(--ys-blue); }

    .empty-card {
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .03);
    }

    .empty-orders-icon { animation: floatAnimation 3s ease-in-out infinite; }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .pagination { gap: 6px; flex-wrap: wrap; justify-content: center; }

    .pagination .page-item .page-link {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0;
        color: var(--ys-blue);
        font-weight: 700;
        padding: 8px 16px;
        transition: all .2s ease;
    }

    .pagination .page-item .page-link:hover { transform: translateY(-2px); background: #eef4ff; }

    .pagination .page-item.active .page-link {
        background: var(--ys-blue);
        border-color: var(--ys-blue);
        color: #fff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, .3);
    }

    @media (max-width: 767.98px) {
        .orders-header-card { padding: 1.1rem; border-radius: 20px; }
        .oh-bubble { width: 48px; height: 48px; font-size: 1.35rem; }
        .oh-total { padding: .45rem .85rem; font-size: .85rem; }

        .order-sum {
            grid-template-columns: 1fr auto 24px;
            grid-template-areas:
                "id     status chev"
                "thumbs total  chev";
            padding: 1rem 1rem 1rem 1.3rem;
        }

        .order-body { padding: 0 1rem 1rem 1.3rem; }
        .info-grid { grid-template-columns: 1fr; }

        .item-row {
            grid-template-columns: 48px 1fr auto;
            grid-template-areas:
                "thumb name  sum"
                "thumb unit  qty";
            row-gap: .1rem;
        }

        .item-thumb { grid-area: thumb; width: 48px; height: 48px; }
        .item-info { display: contents; }
        .item-name { grid-area: name; }
        .item-unit { grid-area: unit; }
        .item-qty { grid-area: qty; justify-self: end; }
        .item-sum { grid-area: sum; min-width: 0; }
    }

    @media (max-width: 420px) {
        .oh-total .lbl-long { display: none; }
        .status-badge { font-size: .78rem; padding: .35rem .7rem; }
    }

    @media (prefers-reduced-motion: reduce) {
        .js-reveal .reveal { opacity: 1; transform: none; transition: none; }
        .oh-bubble, .order-body, .empty-orders-icon { animation: none; }
    }
</style>

<div class="container-lg py-4">

    <div class="orders-header-card reveal">
        <div class="d-flex align-items-center gap-3" style="min-width: 0;">
            <div class="oh-bubble"><i class="bi bi-bag-check-fill"></i></div>
            <div style="min-width: 0;">
                <h1 class="oh-title">Sargytlarym</h1>
                <p class="text-muted m-0 small">Siziň eden ähli sargytlaryňyzyň sanawy</p>
            </div>
        </div>
        <span class="oh-total">
            <i class="bi bi-receipt"></i> <span><span class="lbl-long">Jemi: </span>{{ $orders->total() }} sargyt</span>
        </span>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fw-bold border-0 shadow-sm rounded-4 mb-4 p-3 d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill fs-5 text-success"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($orders->isEmpty())
    <div class="empty-card text-center py-5 px-3 my-4 reveal">
        <div class="my-4">
            <i class="bi bi-cart-x display-1 text-primary opacity-50 empty-orders-icon d-inline-block"></i>
        </div>
        <h4 class="fw-bold text-dark mb-2">Sizde heniz sargyt ýok</h4>
        <p class="text-muted mb-4">Sargyt eden harytlaryňyz bu ýerde peýda bolar.</p>
        <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
            <i class="bi bi-shop me-1"></i> Harytlary görmek
        </a>
    </div>
    @else

    @if($counts['all'] > 1)
    <div class="filter-row reveal">
        <button type="button" class="f-chip active" data-filter="all"><i class="bi bi-list-ul"></i> Ählisi <small>{{ $counts['all'] }}</small></button>
        @if($counts['wait'])<button type="button" class="f-chip" data-filter="wait"><i class="bi bi-hourglass-split"></i> Garaşylýar <small>{{ $counts['wait'] }}</small></button>@endif
        @if($counts['ok'])<button type="button" class="f-chip" data-filter="ok"><i class="bi bi-check-circle-fill"></i> Kabul edildi <small>{{ $counts['ok'] }}</small></button>@endif
        @if($counts['no'])<button type="button" class="f-chip" data-filter="no"><i class="bi bi-x-circle-fill"></i> Kabul edilmedi <small>{{ $counts['no'] }}</small></button>@endif
    </div>
    @endif

    <div class="row g-3 g-md-4" id="ordersList">
        @foreach($orders as $order)
        @php
            $st = $statuses[$order->status] ?? ['label' => $order->status, 'icon' => 'bi-question-circle', 'key' => 'none'];
            $items = $order->items;
            $shown = $items->take(3);
            $extra = $items->count() - $shown->count();
        @endphp

        <div class="col-12 reveal" data-order data-status="{{ $st['key'] }}" data-d="{{ min($loop->index, 6) * 70 }}">
            <details class="order-card st-{{ $st['key'] }}" {{ $loop->first ? 'open' : '' }}>
                <summary class="order-sum">
                    <div class="os-id">
                        <div class="os-num">Sargyt №{{ $order->id }}</div>
                        <div class="os-date"><i class="bi bi-clock"></i>{{ $order->created_at->format('d.m.Y H:i') }}</div>
                    </div>

                    <div class="os-thumbs">
                        @foreach($shown as $it)
                        <img src="{{ $imgUrl($it->product->image ?? null) }}" alt="{{ $it->product->name ?? '' }}" loading="lazy">
                        @endforeach
                        @if($extra > 0)<span class="os-more">+{{ $extra }}</span>@endif
                    </div>

                    <div class="os-status">
                        <span class="status-badge"><i class="bi {{ $st['icon'] }}"></i> {{ $st['label'] }}</span>
                    </div>

                    <div class="os-total">
                        <span class="os-sum-num">{{ number_format($order->total_price, 0, ',', ' ') }}</span>
                        <span class="os-sum-cur">TMT</span>
                        <span class="os-sum-qty">{{ $items->sum('quantity') }} sany</span>
                    </div>

                    <i class="bi bi-chevron-down os-chev"></i>
                </summary>

                <div class="order-body">
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-ico phone"><i class="bi bi-telephone-fill"></i></div>
                            <div style="min-width: 0;">
                                <div class="info-label">Telefon belgi:</div>
                                <div class="info-value">{{ $order->phone }}</div>
                            </div>
                        </div>
                        <div class="info-box">
                            <div class="info-ico addr"><i class="bi bi-geo-alt-fill"></i></div>
                            <div style="min-width: 0;">
                                <div class="info-label">Salgysy:</div>
                                <div class="info-value">{{ $order->address }}</div>
                            </div>
                        </div>
                    </div>

                    <h2 class="items-title"><i class="bi bi-box-seam-fill"></i> Harytlar</h2>

                    @foreach($items as $item)
                    @php $product = $item->product; @endphp
                    <div class="item-row">
                        <img src="{{ $imgUrl($product->image ?? null) }}" class="item-thumb" alt="{{ $product->name ?? 'No Image' }}" loading="lazy">

                        <div class="item-info" style="min-width: 0;">
                            @if($product)
                            <a href="{{ route('products.show', $product->id) }}" class="item-name">{{ $product->name }}</a>
                            @else
                            <span class="item-name gone">Haryt öçürilen</span>
                            @endif
                            <div class="item-unit">{{ number_format($item->price, 0, ',', ' ') }} TMT</div>
                        </div>

                        <span class="item-qty">{{ $item->quantity }} sany</span>
                        <div class="item-sum">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} TMT</div>
                    </div>
                    @endforeach

                    <div class="order-foot">
                        <span class="lbl">Jemi sargyt summasy:</span>
                        <span>
                            <span class="sum">{{ number_format($order->total_price, 0, ',', ' ') }}</span>
                            <span class="cur">TMT</span>
                        </span>
                    </div>
                </div>
            </details>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $orders->links() }}
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.reveal');
        items.forEach(el => { if (el.dataset.d) el.style.setProperty('--d', el.dataset.d + 'ms'); });

        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
                });
            }, { threshold: .08, rootMargin: '0px 0px -30px 0px' });
            items.forEach(el => io.observe(el));
        } else {
            items.forEach(el => el.classList.add('in'));
        }
        const chips = document.querySelectorAll('.f-chip');
        const orders = document.querySelectorAll('[data-order]');

        chips.forEach(chip => chip.addEventListener('click', () => {
            chips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');

            const f = chip.dataset.filter;
            orders.forEach(o => {
                const show = f === 'all' || o.dataset.status === f;
                o.classList.toggle('d-none', !show);
                if (show) o.classList.add('in');
            });
        }));
    });
</script>
@endsection