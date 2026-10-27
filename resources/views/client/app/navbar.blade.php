<style>
    :root {
        --ys-blue: #0d6efd;
        --ys-blue-dark: #0b5ed7;
        --ys-red: #dc3545;
        --ys-ink: #0f172a;
        --ys-muted: #64748b;
        --ys-line: #e2e8f0;
        --ys-soft: #f1f5f9;
    }

    @media (max-width: 991.98px) {
        body { padding-bottom: calc(78px + env(safe-area-inset-bottom)); }
    }

    .ys-navbar {
        background: rgba(255, 255, 255, .92) !important;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-bottom: 1px solid #eef2f7;
        transition: box-shadow .3s ease;
        z-index: 1030;
    }

    .ys-navbar.is-scrolled {
        box-shadow: 0 8px 30px rgba(15, 23, 42, .08);
    }

    .brand-logo {
        font-weight: 900;
        font-size: 1.9rem;
        letter-spacing: -.8px;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        gap: .1rem;
        text-decoration: none !important;
        transition: transform .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .brand-logo:hover { transform: translateY(-2px) scale(1.05); }
    .brand-logo .brand-first { color: var(--ys-blue); }
    .brand-logo .brand-second { color: var(--ys-red); }

    .brand-logo .brand-first,
    .brand-logo .brand-second {
        animation: ysGlow 3.5s infinite alternate ease-in-out;
    }

    .brand-logo .brand-second { animation-delay: 1.7s; }

    @keyframes ysGlow {
        from { text-shadow: 0 0 0 transparent; }
        to   { text-shadow: 0 0 14px rgba(13, 110, 253, .28); }
    }

    .search-input-box {
        background: #f8f9fa;
        border: 1.5px solid var(--ys-line);
        border-radius: 50rem;
        overflow: hidden;
        transition: all .25s ease;
    }

    .search-input-box:focus-within {
        background: #fff;
        border-color: var(--ys-blue);
        box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
    }

    .search-input-box .form-control {
        background: transparent;
        border: 0;
        box-shadow: none;
        font-weight: 600;
    }

    .search-input-box .btn {
        border: 0;
        border-radius: 0;
        padding-inline: 1.15rem;
    }

    .search-wrapper-pc {
        flex: 1 1 auto;
        max-width: 620px;
        margin-inline: auto;
    }

    .lang-dropdown-btn {
        background: #fff;
        border: 1.5px solid var(--ys-line);
        color: var(--ys-ink);
        font-weight: 700;
        transition: all .25s ease;
    }

    .lang-dropdown-btn:hover,
    .lang-dropdown-btn:focus,
    .lang-dropdown-btn.show {
        background: #fff;
        border-color: var(--ys-blue);
        color: var(--ys-ink);
        box-shadow: 0 4px 12px rgba(13, 110, 253, .12);
    }

    .user-btn {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        background: #fff;
        border: 1.5px solid var(--ys-line);
        border-radius: 50rem;
        padding: .25rem .85rem .25rem .3rem;
        font-weight: 700;
        color: var(--ys-ink);
        transition: all .25s ease;
    }

    .user-btn:hover,
    .user-btn.active {
        border-color: var(--ys-blue);
        color: var(--ys-ink);
        box-shadow: 0 4px 12px rgba(13, 110, 253, .12);
    }

    .user-btn { text-decoration: none; }
    .user-btn:hover { transform: translateY(-2px); }
    .user-btn.active { border-color: var(--ys-blue); background: #eaf2ff; }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--ys-red);
        color: #fff;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .user-name {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ys-menu {
        border: 0;
        border-radius: 1.1rem;
        box-shadow: 0 14px 40px rgba(15, 23, 42, .15);
        padding: .5rem;
        margin-top: .6rem !important;
        animation: ysMenu .2s ease both;
    }

    .ys-menu .dropdown-item {
        border-radius: .7rem;
        font-weight: 700;
        padding: .55rem .8rem;
    }

    .ys-menu .dropdown-item:hover { background: #eef4ff; }
    .ys-menu .dropdown-item.active { background: var(--ys-blue); color: #fff; }
    .ys-menu .dropdown-item.text-danger:hover { background: #fdecee; }

    @keyframes ysMenu {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: none; }
    }

    .cart-btn {
        position: relative;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid var(--ys-blue);
        color: var(--ys-blue);
        font-size: 1.25rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .cart-btn:hover {
        background: var(--ys-blue);
        color: #fff;
        transform: translateY(-2px) rotate(-8deg) scale(1.08);
        box-shadow: 0 8px 22px rgba(13, 110, 253, .4);
    }

    .cart-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 50rem;
        background: var(--ys-red);
        color: #fff;
        border: 2px solid #fff;
        font-size: .72rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }
    .cart-badge.bump { animation: ysBump .5s ease; }

    @keyframes ysBump {
        0%, 100% { transform: scale(1); }
        40% { transform: scale(1.5); box-shadow: 0 0 0 6px rgba(220, 53, 69, .25); }
    }

    .nav-action-btn {
        transition: all .25s cubic-bezier(.4, 0, .2, 1) !important;
    }

    .nav-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, .1) !important;
    }

    .nav-row-2 { border-top: 1px solid #eef2f7; }

    .nav-pill {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .5rem 1rem;
        border-radius: 50rem;
        font-weight: 700;
        font-size: .93rem;
        white-space: nowrap;
        text-decoration: none !important;
        color: var(--ys-ink);
        background: #fff;
        border: 1.5px solid var(--ys-line);
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .nav-pill i { color: var(--ys-blue); transition: color .25s; }

    .nav-pill:hover {
        border-color: var(--ys-blue);
        color: var(--ys-blue);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(13, 110, 253, .12);
    }

    .nav-pill.active {
        background: #eaf2ff;
        border-color: var(--ys-blue);
        color: var(--ys-blue);
    }

    .nav-pill.primary {
        background: var(--ys-red);
        border-color: var(--ys-red);
        color: #fff;
        box-shadow: 0 4px 14px rgba(220, 53, 69, .25);
    }

    .nav-pill.primary i { color: #fff; }
    .nav-pill.primary:hover { color: #fff; box-shadow: 0 8px 20px rgba(220, 53, 69, .35); }

    .categories-horizontal-scroll {
        display: flex;
        align-items: center;
        gap: .5rem;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
        -ms-overflow-style: none;
        -webkit-overflow-scrolling: touch;
        padding: 4px 14px;
        -webkit-mask-image: linear-gradient(90deg, transparent 0, #000 14px, #000 calc(100% - 14px), transparent 100%);
        mask-image: linear-gradient(90deg, transparent 0, #000 14px, #000 calc(100% - 14px), transparent 100%);
    }

    .categories-horizontal-scroll::-webkit-scrollbar { display: none; }

    .category-nav-link {
        flex-shrink: 0;
        display: inline-block;
        color: #334155 !important;
        background: var(--ys-soft);
        border: 1px solid var(--ys-line);
        font-weight: 700;
        font-size: .9rem;
        padding: .4rem 1rem;
        border-radius: 50rem;
        text-decoration: none !important;
        transition: all .25s cubic-bezier(.4, 0, .2, 1);
    }

    .category-nav-link:hover,
    .category-nav-link.active {
        color: #fff !important;
        background: linear-gradient(135deg, var(--ys-blue), var(--ys-blue-dark));
        border-color: var(--ys-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(13, 110, 253, .3);
    }

    .delivery-badge {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .4rem .9rem;
        border-radius: 50rem;
        background: linear-gradient(135deg, #fff, #f0f6ff);
        border: 1.5px solid var(--ys-blue);
        font-weight: 800;
        font-size: .88rem;
        color: var(--ys-ink);
        white-space: nowrap;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #198754;
        animation: statusPulse 1.6s infinite;
    }

    @keyframes statusPulse {
        0%   { box-shadow: 0 0 0 0 rgba(25, 135, 84, .7); }
        70%  { box-shadow: 0 0 0 6px rgba(25, 135, 84, 0); }
        100% { box-shadow: 0 0 0 0 rgba(25, 135, 84, 0); }
    }

    .m-all-btn {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .85rem;
        font-weight: 700;
        padding: .4rem .85rem;
        border: 0;
        border-radius: 50rem;
        color: #fff;
        background: linear-gradient(135deg, var(--ys-blue), var(--ys-blue-dark));
        box-shadow: 0 4px 12px rgba(13, 110, 253, .3);
    }

    .m-lang-btn {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        background: #fff;
        border: 1.5px solid var(--ys-line);
        border-radius: 50rem;
        padding: .3rem .75rem;
        font-weight: 700;
        font-size: .85rem;
        color: var(--ys-ink);
    }

    .offcanvas-custom {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .mobile-cat-item {
        font-size: 1rem;
        font-weight: 600;
        color: #2b2b2b;
        border-radius: 12px !important;
    }

    .mobile-bottom-nav {
        background: rgba(255, 255, 255, .96);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-top: 1px solid #eef2f7;
        box-shadow: 0 -8px 30px rgba(15, 23, 42, .08);
        padding: .35rem .5rem calc(.35rem + env(safe-area-inset-bottom));
        z-index: 1040;
    }

    .bn-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        align-items: end;
        max-width: 520px;
        margin: 0 auto;
    }

    .bn-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        padding: .4rem 0 .2rem;
        color: var(--ys-muted);
        text-decoration: none !important;
        background: none;
        border: 0;
        font-size: .68rem;
        font-weight: 700;
        transition: color .2s;
    }

    .bn-item i {
        font-size: 1.3rem;
        line-height: 1;
        transition: transform .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .bn-item.active { color: var(--ys-blue); }
    .bn-item.active i { transform: translateY(-2px) scale(1.12); }

    .bn-item.active::before {
        content: "";
        position: absolute;
        top: -.35rem;
        left: 50%;
        width: 26px;
        height: 3px;
        border-radius: 0 0 4px 4px;
        background: var(--ys-blue);
        transform: translateX(-50%);
    }

    .bn-item:active i { transform: scale(.9); }
    .bn-item.admin { color: var(--ys-red); }

    .bn-cart {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        text-decoration: none !important;
        color: var(--ys-muted);
        font-size: .68rem;
        font-weight: 700;
    }

    .bn-cart-circle {
        position: relative;
        width: 54px;
        height: 54px;
        margin-top: -26px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--ys-blue), var(--ys-blue-dark));
        color: #fff;
        font-size: 1.45rem;
        border: 4px solid #fff;
        box-shadow: 0 8px 20px rgba(13, 110, 253, .4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .bn-cart:active .bn-cart-circle { transform: scale(.92); }
    .bn-cart.active { color: var(--ys-blue); }

    .bn-cart .cart-badge {
        top: -4px;
        right: -6px;
        min-width: 20px;
        height: 20px;
        font-size: .65rem;
    }

    @media (prefers-reduced-motion: reduce) {
        .brand-logo .brand-first, .brand-logo .brand-second,
        .status-dot, .ys-menu, .cart-badge.bump { animation: none !important; }
    }
</style>

<nav class="navbar sticky-top ys-navbar py-2" id="ysNavbar">
    <div class="container-lg">

        <div class="d-lg-none w-100">
            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                <a href="{{ route('home.index') }}" class="brand-logo flex-shrink-0" style="font-size: 1.65rem;">
                    <span class="brand-first">Yslam</span><span class="brand-second">Shop</span>
                </a>

                <div class="dropdown">
                    <button class="m-lang-btn shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe text-primary"></i>
                        <span>{{ in_array(app()->getLocale(), ['tk', 'tm']) ? 'TK' : strtoupper(app()->getLocale()) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end ys-menu">
                        <li><a class="dropdown-item {{ in_array(app()->getLocale(), ['tk', 'tm']) ? 'active' : '' }}" href="{{ route('locale', 'tk') }}">🇹🇲 Türkmen</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ route('locale', 'ru') }}">🇷🇺 Русский</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('locale', 'en') }}">🇬🇧 English</a></li>
                    </ul>
                </div>
            </div>

            <form action="{{ route('products.search') }}" method="GET" class="w-100 mb-2">
                <div class="input-group search-input-box">
                    <span class="input-group-text bg-transparent border-0 pe-0 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="query" class="form-control py-2" placeholder="{{ __('app.search') }}..." value="{{ request('query') }}" style="font-size: .9rem;" required>
                    <button class="btn btn-primary" type="submit">{{ __('app.search') }}</button>
                </div>
            </form>

            <div class="d-flex align-items-center gap-2">
                <button class="m-all-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#categoriesMobileCanvas">
                    <i class="bi bi-grid-fill"></i><span>Ähli</span>
                </button>

                <div class="categories-horizontal-scroll flex-grow-1">
                    @foreach ($categories as $item)
                    <a href="{{ route('categories.show', $item->id) }}"
                        class="category-nav-link {{ request()->url() === route('categories.show', $item->id) ? 'active' : '' }}"
                        style="font-size: .85rem; padding: .35rem .9rem;">
                        {{ $item->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="d-none d-lg-flex flex-column w-100">

            {{-- 1-nji setir: logo | gözleg | hasap --}}
            <div class="d-flex align-items-center gap-4 py-2">
                <a href="{{ route('home.index') }}" class="brand-logo flex-shrink-0">
                    <span class="brand-first">Yslam</span><span class="brand-second">Shop</span>
                </a>

                <div class="search-wrapper-pc">
                    <form action="{{ route('products.search') }}" method="GET" class="w-100">
                        <div class="input-group search-input-box shadow-sm">
                            <span class="input-group-text bg-transparent border-0 pe-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" name="query" class="form-control py-2" placeholder="{{ __('app.search') }}..." value="{{ request('query') }}" required>
                            <button class="btn btn-primary fw-bold" type="submit">{{ __('app.search') }}</button>
                        </div>
                    </form>
                </div>

                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <div class="dropdown">
                        <button class="btn rounded-pill d-flex align-items-center gap-2 px-3 py-2 lang-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe text-primary"></i>
                            <span class="small">{{ in_array(app()->getLocale(), ['tk', 'tm']) ? 'TK' : strtoupper(app()->getLocale()) }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end ys-menu">
                            <li><a class="dropdown-item d-flex align-items-center gap-2 {{ in_array(app()->getLocale(), ['tk', 'tm']) ? 'active' : '' }}" href="{{ route('locale', 'tk') }}"><span>🇹🇲</span> Türkmen</a></li>
                            <li><a class="dropdown-item d-flex align-items-center gap-2 {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ route('locale', 'ru') }}"><span>🇷🇺</span> Русский</a></li>
                            <li><a class="dropdown-item d-flex align-items-center gap-2 {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('locale', 'en') }}"><span>🇬🇧</span> English</a></li>
                        </ul>
                    </div>

                    @if(Auth::check() && Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger rounded-pill fw-bold d-flex align-items-center gap-2 px-3 py-2 shadow-sm nav-action-btn">
                        <i class="bi bi-shield-lock-fill"></i><span>Admin Panel</span>
                    </a>
                    @elseif(Auth::check())
                    <a href="{{ route('profile.index') }}" class="user-btn {{ request()->routeIs('profile.index') ? 'active' : '' }}" title="Profile">
                        <span class="user-avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    @else
                    <button class="btn btn-success rounded-pill fw-bold px-4 py-2 d-flex align-items-center gap-2 shadow-sm nav-action-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-person-fill fs-5"></i><span>{{ __('Girmek') }}</span>
                    </button>
                    @endif

                    <a href="{{ route('cart.index') }}" class="cart-btn ms-1" aria-label="Sebet">
                        <i class="bi bi-cart3"></i>
                        <span id="cart-badge-count" class="cart-badge shadow-sm">{{ count(session('cart', [])) }}</span>
                    </a>
                </div>
            </div>

            <div class="nav-row-2 d-flex align-items-center gap-3 py-2">
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <a href="{{ route('products.index') }}" class="nav-pill primary">
                        <i class="bi bi-grid-3x3-gap-fill"></i> {{ __('app.product_show') }}
                    </a>
                    <a href="{{ route('home.index') }}" class="nav-pill {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i> {{ __('app.home') }}
                    </a>
                    <a href="{{ route('orders.my') }}" class="nav-pill {{ request()->routeIs('orders.my') ? 'active' : '' }}">
                        <i class="bi bi-bag-check-fill"></i> {{ __('app.order') }}
                    </a>
                </div>

                <div class="categories-horizontal-scroll flex-grow-1" style="min-width: 0;">
                    @foreach ($categories as $item)
                    <a href="{{ route('categories.show', $item->id) }}"
                        class="category-nav-link {{ request()->url() === route('categories.show', $item->id) ? 'active' : '' }}">
                        {{ $item->name }}
                    </a>
                    @endforeach
                </div>

                <div class="delivery-badge d-none d-xl-inline-flex flex-shrink-0">
                    <span class="status-dot"></span>
                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                    <span>Tiz Eltip Bermek 24/7</span>
                </div>
            </div>
        </div>

    </div>
</nav>

<div class="offcanvas offcanvas-start border-0 shadow-lg offcanvas-custom" tabindex="-1" id="categoriesMobileCanvas" style="width: 85vw; max-width: 360px;">
    <div class="offcanvas-header bg-primary text-white py-3 px-4" style="border-top-right-radius: 20px;">
        <h5 class="offcanvas-title fw-bold m-0 d-flex align-items-center gap-2 fs-5">
            <i class="bi bi-grid-fill"></i> Kategoriýalar
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="list-group list-group-flush gap-1">
            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action py-3 px-3 fw-bold border-0 text-primary d-flex align-items-center justify-content-between rounded-3 bg-light">
                <span class="fs-6"><i class="bi bi-border-all me-2"></i> Ähli harytlar</span>
                <i class="bi bi-chevron-right small opacity-50"></i>
            </a>
            <hr class="my-2 opacity-10">
            @foreach($categories as $item)
            <a href="{{ route('categories.show', $item->id) }}" class="list-group-item list-group-item-action py-3 px-3 border-0 d-flex align-items-center justify-content-between mobile-cat-item">
                <span>{{ $item->name }}</span>
                <i class="bi bi-chevron-right small text-muted"></i>
            </a>
            @endforeach
        </div>
    </div>
</div>
<div class="d-lg-none fixed-bottom mobile-bottom-nav">
    <div class="bn-grid">
        <a href="{{ route('home.index') }}" class="bn-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
            <i class="bi {{ request()->routeIs('home.index') ? 'bi-house-door-fill' : 'bi-house-door' }}"></i>
            <span>{{ __('app.home') }}</span>
        </a>

        <a href="{{ route('products.index') }}" class="bn-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="bi {{ request()->routeIs('products.index') ? 'bi-grid-fill' : 'bi-grid' }}"></i>
            <span>{{ \Illuminate\Support\Facades\Lang::has('app.products') ? __('app.products') : 'Harytlar' }}</span>
        </a>

        <a href="{{ route('cart.index') }}" class="bn-cart {{ request()->routeIs('cart.index') ? 'active' : '' }}">
            <span class="bn-cart-circle">
                <i class="bi bi-cart3"></i>
                <span class="cart-badge">{{ count(session('cart', [])) }}</span>
            </span>
            <span>Sebet</span>
        </a>

        <a href="{{ route('orders.my') }}" class="bn-item {{ request()->routeIs('orders.my') ? 'active' : '' }}">
            <i class="bi {{ request()->routeIs('orders.my') ? 'bi-bag-check-fill' : 'bi-bag-check' }}"></i>
            <span>{{ __('app.order') }}</span>
        </a>

        @if(Auth::check() && Auth::user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" class="bn-item admin {{ request()->routeIs('admin.*') ? 'active' : '' }}">
            <i class="bi bi-shield-lock-fill"></i>
            <span>Admin</span>
        </a>
        @elseif(Auth::check())
        <a href="{{ route('profile.index') }}" class="bn-item {{ request()->routeIs('profile.index') ? 'active' : '' }}">
            <i class="bi {{ request()->routeIs('profile.index') ? 'bi-person-circle' : 'bi-person' }}"></i>
            <span>{{ Str::limit(Auth::user()->name, 7) }}</span>
        </a>
        @else
        <button type="button" class="bn-item text-success" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>{{ __('Girmek') }}</span>
        </button>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nav = document.getElementById('ysNavbar');
        const onScroll = () => nav.classList.toggle('is-scrolled', window.scrollY > 8);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
        document.querySelectorAll('.categories-horizontal-scroll').forEach(box => {
            box.addEventListener('wheel', e => {
                if (box.scrollWidth <= box.clientWidth) return;
                e.preventDefault();
                box.scrollLeft += e.deltaY;
            }, { passive: false });
        });

        document.querySelectorAll('.cart-badge').forEach(badge => {
            new MutationObserver(() => {
                badge.classList.remove('bump');
                void badge.offsetWidth;
                badge.classList.add('bump');
            }).observe(badge, { childList: true, characterData: true, subtree: true });
        });
    });
</script>