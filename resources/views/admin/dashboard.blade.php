@extends('admin.layouts.header')

@section('title', 'Dashboard')

@section('content')
<style>
    .stat-card {
        position: relative;
        display: block;
        overflow: hidden;
        height: 100%;
        padding: 1.25rem 1.25rem 1.1rem;
        border-radius: 24px;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 14px 30px var(--glow);
        transition: transform .35s cubic-bezier(.34, 1.56, .64, 1), box-shadow .35s ease;
    }

    .stat-card:hover { color: #fff; transform: translateY(-6px); box-shadow: 0 22px 40px var(--glow); }

    .stat-card::before,
    .stat-card::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: #fff;
        pointer-events: none;
    }

    .stat-card::before { width: 150px; height: 150px; right: -40px; top: -60px; opacity: .13; }
    .stat-card::after  { width: 90px; height: 90px; right: 30px; bottom: -50px; opacity: .1; }

    .stat-blue  { background: linear-gradient(135deg, #0d6efd, #0a4fc4); --glow: rgba(13, 110, 253, .3); }
    .stat-green { background: linear-gradient(135deg, #22a06b, #146c43); --glow: rgba(25, 135, 84, .3); }
    .stat-amber { background: linear-gradient(135deg, #f5a623, #e07b00); --glow: rgba(245, 166, 35, .35); }

    .stat-ico {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .9rem;
        border-radius: 14px;
        background: rgba(255, 255, 255, .2);
        font-size: 1.4rem;
        transition: transform .4s cubic-bezier(.34, 1.56, .64, 1);
    }

    .stat-card:hover .stat-ico { transform: rotate(-10deg) scale(1.12); }

    .stat-num { margin: 0; font-size: clamp(1.8rem, 1.3rem + 2vw, 2.6rem); font-weight: 900; letter-spacing: -1px; line-height: 1; }
    .stat-lbl { display: flex; align-items: center; justify-content: space-between; margin-top: .35rem; font-weight: 700; opacity: .92; }
    .stat-lbl i { transition: transform .25s; }
    .stat-card:hover .stat-lbl i { transform: translateX(5px); }

    .quick-link {
        display: flex;
        align-items: center;
        gap: .8rem;
        padding: .85rem 1rem;
        border: 1.5px solid var(--a-line);
        border-radius: 16px;
        background: #fff;
        color: var(--a-ink);
        font-weight: 800;
        text-decoration: none;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .quick-link .qi {
        flex: 0 0 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #e7f0ff;
        color: var(--a-blue);
        font-size: 1.15rem;
        transition: all .25s;
    }

    .quick-link:hover { color: var(--a-ink); border-color: var(--a-blue); transform: translateY(-3px); box-shadow: 0 10px 22px rgba(13, 110, 253, .12); }
    .quick-link:hover .qi { background: var(--a-blue); color: #fff; }

    .live-dot {
        display: inline-block;
        width: 9px;
        height: 9px;
        margin-right: .35rem;
        border-radius: 50%;
        background: var(--a-red);
        animation: livePulse 1.6s infinite;
    }

    @keyframes livePulse {
        0%   { box-shadow: 0 0 0 0 rgba(220, 53, 69, .6); }
        70%  { box-shadow: 0 0 0 7px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }

    .order-id { font-weight: 900; color: var(--a-ink); }
</style>

@php
    $hour = (int) now()->format('H');
    $greet = $hour < 6 ? 'Gijäňiz haýyrly' : ($hour < 12 ? 'Ertiriňiz haýyrly' : ($hour < 18 ? 'Günüňiz haýyrly' : 'Agşamyňyz haýyrly'));
    $pending = isset($pendingOrders) ? $pendingOrders : collect();
@endphp

<div class="adm-head adm-in">
    <div>
        <h1 class="adm-title">Dashboard</h1>
        <p class="adm-sub">{{ $greet }}, {{ optional(Auth::user())->name ?? 'Admin' }} 👋</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn-main"><i class="bi bi-plus-lg"></i> Täze haryt goş</a>
</div>

{{-- ================= STATISTIKA ================= --}}
<div class="row g-3 g-md-4 mb-4">
    <div class="col-12 col-sm-4 adm-in" data-d="60">
        <a href="{{ route('admin.products.index') }}" class="stat-card stat-blue">
            <div class="stat-ico"><i class="bi bi-box-seam-fill"></i></div>
            <p class="stat-num" data-count="{{ $productsCount }}">{{ $productsCount }}</p>
            <div class="stat-lbl"><span>Harytlar</span><i class="bi bi-arrow-right"></i></div>
        </a>
    </div>
    <div class="col-12 col-sm-4 adm-in" data-d="130">
        <a href="{{ route('admin.users.index') }}" class="stat-card stat-green">
            <div class="stat-ico"><i class="bi bi-people-fill"></i></div>
            <p class="stat-num" data-count="{{ $usersCount }}">{{ $usersCount }}</p>
            <div class="stat-lbl"><span>Agzalar</span><i class="bi bi-arrow-right"></i></div>
        </a>
    </div>
    <div class="col-12 col-sm-4 adm-in" data-d="200">
        <a href="{{ route('admin.orders.index') }}" class="stat-card stat-amber">
            <div class="stat-ico"><i class="bi bi-cart-check-fill"></i></div>
            <p class="stat-num" data-count="{{ $ordersCount }}">{{ $ordersCount }}</p>
            <div class="stat-lbl"><span>Sargytlar</span><i class="bi bi-arrow-right"></i></div>
        </a>
    </div>
</div>

<div class="row g-3 g-md-4">
    {{-- ================= TÄZE SARGYTLAR ================= --}}
    <div class="col-lg-8 adm-in" data-d="260">
        <div class="adm-card h-100">
            <div class="d-flex justify-content-between align-items-center p-3 p-md-4 pb-3">
                <h2 class="adm-card-title mb-0" style="font-size: .9rem;">
                    <i class="bi bi-bell-fill text-warning"></i>Täze sargytlar
                </h2>
                @if($pending->count() > 0)
                <span class="pill pill-no"><span class="live-dot"></span>{{ $pending->count() }} täze</span>
                @endif
            </div>

            @if($pending->count() > 0)
            <div class="table-responsive d-none d-md-block">
                <table class="table adm-table align-middle">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Telefon</th>
                            <th>Salgy</th>
                            <th>Jemi baha</th>
                            <th>Wagty</th>
                            <th class="text-end">Sazlamalar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pending as $order)
                        <tr>
                            <td class="order-id">#{{ $order->id }}</td>
                            <td>{{ $order->phone }}</td>
                            <td class="text-muted">{{ Str::limit($order->address, 25) }}</td>
                            <td class="fw-bold text-primary text-nowrap">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</td>
                            <td class="small text-muted text-nowrap">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-soft primary"><i class="bi bi-eye"></i> Seretmek</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-md-none">
                @foreach($pending as $order)
                <div class="m-card">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="order-id fs-6">#{{ $order->id }}</span>
                        <span class="small text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="small text-muted mb-1"><i class="bi bi-telephone me-1 text-primary"></i>{{ $order->phone }}</div>
                    <div class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-danger"></i>{{ Str::limit($order->address, 30) }}</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-primary">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</span>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-soft primary"><i class="bi bi-eye"></i> Seretmek</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="adm-empty">
                <i class="bi bi-check2-circle"></i>
                Täze sargyt ýok. Hemmesi görülen!
            </div>
            @endif
        </div>
    </div>

    {{-- ================= ÇAKYŞ ================= --}}
    <div class="col-lg-4 adm-in" data-d="320">
        <div class="adm-card adm-card-pad h-100">
            <h2 class="adm-card-title"><i class="bi bi-lightning-charge-fill"></i>Çalt hereketler</h2>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.products.create') }}" class="quick-link">
                    <span class="qi"><i class="bi bi-plus-circle-fill"></i></span>Täze haryt goşmak
                </a>
                <a href="{{ route('admin.orders.index') }}" class="quick-link">
                    <span class="qi"><i class="bi bi-receipt"></i></span>Ähli sargytlar
                </a>
                <a href="{{ route('admin.products.index') }}" class="quick-link">
                    <span class="qi"><i class="bi bi-boxes"></i></span>Harytlary dolandyrmak
                </a>
                <a href="{{ route('admin.users.index') }}" class="quick-link">
                    <span class="qi"><i class="bi bi-person-lines-fill"></i></span>Ulanyjylar
                </a>
                <a href="{{ route('home.index') }}" class="quick-link">
                    <span class="qi"><i class="bi bi-shop"></i></span>Saýta git
                </a>
            </div>
        </div>
    </div>
</div>
@endsection