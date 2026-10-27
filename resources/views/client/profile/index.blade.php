@extends('client.layouts.header')

@section('content')
<style>
   
    .pf-page {
        background: #f8fafc;
        min-height: 70vh;
    }
    .pf-side {
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .04);
        overflow: hidden;
        text-align: center;
        animation: pf-in .6s cubic-bezier(.2, .8, .2, 1) both;
    }

    @media (min-width: 992px) {
        .pf-side {
            position: sticky;
            top: 150px;
        }
    }

    .pf-cover {
        height: 96px;
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        position: relative;
        overflow: hidden;
    }

    .pf-cover::before {
        content: "";
        position: absolute;
        inset: -50%;
        background-image:
            radial-gradient(circle at 25% 35%, rgba(255, 255, 255, .16) 0 5px, transparent 6px),
            radial-gradient(circle at 75% 70%, rgba(255, 255, 255, .10) 0 9px, transparent 10px);
        background-size: 60px 60px, 90px 90px;
        animation: pf-drift 24s linear infinite;
    }

    .pf-avatar-box {
        position: relative;
        width: 96px;
        height: 96px;
        margin: -48px auto 0;
    }

    .pf-avatar {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 5px solid #fff;
        background: #dc3545;
        color: #fff;
        font-size: 2.3rem;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 22px rgba(220, 53, 69, .35);
        animation: pf-pop .75s .15s cubic-bezier(.34, 1.56, .64, 1) both;
    }

    .pf-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid #dc3545;
        opacity: 0;
        animation: pf-ring 2.8s 1s ease-out infinite;
    }

    .pf-ring.r2 { animation-delay: 2s; }

    .pf-name {
        font-weight: 800;
        font-size: 1.35rem;
        letter-spacing: -.3px;
        color: #0f172a;
        margin: 14px 16px 2px;
        word-break: break-word;
        animation: pf-fade .5s .4s both;
    }

    .pf-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .82rem;
        font-weight: 700;
        color: #198754;
        animation: pf-fade .5s .5s both;
    }

    .pf-role .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #198754;
        animation: pf-pulse 1.6s infinite;
    }

    .pf-side-actions {
        padding: 18px 20px 22px;
        display: grid;
        gap: 10px;
        animation: pf-fade .5s .7s both;
    }

    .pf-panel {
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, .04);
        padding: 1.5rem;
        animation: pf-in .6s .1s cubic-bezier(.2, .8, .2, 1) both;
    }

    .pf-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #0f172a;
        margin: 0 0 1rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .pf-title i { color: #0d6efd; }

    .pf-info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    @media (min-width: 768px) {
        .pf-info-grid { grid-template-columns: 1fr 1fr; }
        .pf-info-grid .wide { grid-column: 1 / -1; }
    }

    .pf-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        background: #f8f9fa;
        border: 1.5px solid #e2e8f0;
        border-radius: 1rem;
        text-decoration: none;
        color: inherit;
        min-width: 0;
        animation: pf-up .5s both;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .pf-row:nth-child(1) { animation-delay: .35s; }
    .pf-row:nth-child(2) { animation-delay: .45s; }
    .pf-row:nth-child(3) { animation-delay: .55s; }

    a.pf-row:hover {
        background: #fff;
        border-color: #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 110, 253, .12);
        color: inherit;
    }

    .pf-ico {
        flex: 0 0 44px;
        height: 44px;
        border-radius: 50%;
        background: #e7f0ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        transition: all .25s;
    }

    a.pf-row:hover .pf-ico {
        background: #0d6efd;
        color: #fff;
    }

    .pf-label {
        font-size: .76rem;
        font-weight: 600;
        color: #64748b;
        line-height: 1.2;
    }

    .pf-value {
        font-weight: 800;
        color: #0f172a;
        overflow-wrap: anywhere;
    }

    .pf-row > div:last-child { min-width: 0; }

    .pf-empty {
        color: #94a3b8;
        font-weight: 600;
    }

    .pf-tiles {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
    }

    @media (min-width: 576px) {
        .pf-tiles { grid-template-columns: 1fr 1fr; }
    }

    .pf-tile {
        position: relative;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        border-radius: 1.25rem;
        text-decoration: none;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        color: #0f172a;
        animation: pf-up .5s both;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .pf-tile:nth-child(1) { animation-delay: .7s; }
    .pf-tile:nth-child(2) { animation-delay: .8s; }

    .pf-tile-ico {
        flex: 0 0 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        transition: transform .5s cubic-bezier(.34, 1.56, .64, 1);
    }

    .pf-tile.fav .pf-tile-ico { background: #fdecee; color: #dc3545; }
    .pf-tile.ord .pf-tile-ico { background: #e7f0ff; color: #0d6efd; }

    .pf-tile .t {
        font-weight: 800;
        font-size: 1.05rem;
        line-height: 1.2;
    }

    .pf-tile .s {
        font-size: .8rem;
        color: #64748b;
        font-weight: 600;
    }

    .pf-tile .go {
        margin-left: auto;
        color: #94a3b8;
        transition: all .25s;
    }

    .pf-tile:hover {
        transform: translateY(-2px);
        color: #0f172a;
    }

    .pf-tile.fav:hover {
        border-color: #dc3545;
        box-shadow: 0 6px 18px rgba(220, 53, 69, .18);
    }

    .pf-tile.ord:hover {
        border-color: #0d6efd;
        box-shadow: 0 6px 18px rgba(13, 110, 253, .18);
    }

    .pf-tile:hover .pf-tile-ico { transform: rotateY(360deg) scale(1.08); }
    .pf-tile:hover .go { transform: translateX(4px); color: #0f172a; }
    @media (max-width: 991.98px) {
        .pf-page { padding-bottom: 96px; }
        .pf-panel { padding: 1.15rem; }
    }
    @keyframes pf-in    { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: none; } }
    @keyframes pf-up    { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
    @keyframes pf-fade  { from { opacity: 0; } to { opacity: 1; } }
    @keyframes pf-pop   { from { opacity: 0; transform: scale(.3); } to { opacity: 1; transform: scale(1); } }
    @keyframes pf-ring  { 0% { opacity: .6; transform: scale(1); } 100% { opacity: 0; transform: scale(1.65); } }
    @keyframes pf-drift { to { transform: translate(60px, 60px); } }
    @keyframes pf-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(25, 135, 84, .7); }
        70%  { box-shadow: 0 0 0 6px rgba(25, 135, 84, 0); }
        100% { box-shadow: 0 0 0 0 rgba(25, 135, 84, 0); }
    }

    @media (prefers-reduced-motion: reduce) {
        .pf-side, .pf-panel, .pf-cover::before, .pf-avatar, .pf-ring, .pf-name,
        .pf-role, .pf-role .dot, .pf-side-actions, .pf-row, .pf-tile {
            animation: none !important;
        }
    }
</style>

<div class="pf-page py-4 py-lg-5">
    <div class="container-lg">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-4 justify-content-center">
            <div class="col-12 col-md-8 col-lg-4">
                <div class="pf-side">
                    <div class="pf-cover"></div>

                    <div class="pf-avatar-box">
                        <span class="pf-ring"></span>
                        <span class="pf-ring r2"></span>
                        <div class="pf-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</div>
                    </div>

                    <h1 class="pf-name">{{ $user->name }}</h1>
                    <span class="pf-role"><span class="dot"></span> Hasabym</span>

                    <div class="pf-side-actions">
                        <a href="{{ route('orders.my') }}" class="btn btn-primary rounded-pill fw-bold py-2 d-flex align-items-center justify-content-center gap-2 nav-action-btn">
                            <i class="bi bi-bag-check-fill"></i> Sargytlarym
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-pill fw-bold py-2 w-100 d-flex align-items-center justify-content-center gap-2 nav-action-btn">
                                <i class="bi bi-box-arrow-right"></i> Çykmak
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="d-grid gap-4">

                    <div class="pf-panel">
                        <h2 class="pf-title"><i class="bi bi-person-vcard-fill"></i> Şahsy maglumatlar</h2>

                        <div class="pf-info-grid">
                            <div class="pf-row wide">
                                <div class="pf-ico"><i class="bi bi-person-fill"></i></div>
                                <div>
                                    <div class="pf-label">Ady</div>
                                    <div class="pf-value">{{ $user->name }}</div>
                                </div>
                            </div>

                            <a class="pf-row" href="{{ $user->phone ? 'tel:' . $user->phone : '#' }}">
                                <div class="pf-ico"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <div class="pf-label">Telefon belgisi</div>
                                    <div class="pf-value {{ $user->phone ? '' : 'pf-empty' }}">{{ $user->phone ?: 'Görkezilmedi' }}</div>
                                </div>
                            </a>

                            <a class="pf-row" href="mailto:{{ $user->email }}">
                                <div class="pf-ico"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <div class="pf-label">E-mail</div>
                                    <div class="pf-value">{{ $user->email }}</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="pf-tiles">
                        <a href="#" class="pf-tile fav">
                            <div class="pf-tile-ico"><i class="bi bi-heart-fill"></i></div>
                            <div>
                                <div class="t">Halanlarym</div>
                                <div class="s">Saklan harytlar</div>
                            </div>
                            <i class="bi bi-chevron-right go"></i>
                        </a>

                        <a href="{{ route('orders.my') }}" class="pf-tile ord">
                            <div class="pf-tile-ico"><i class="bi bi-bag-check-fill"></i></div>
                            <div>
                                <div class="t">Sargytlarym</div>
                                <div class="s">Sargyt taryhy</div>
                            </div>
                            <i class="bi bi-chevron-right go"></i>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection