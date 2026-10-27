<!DOCTYPE html>
<html lang="tm">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Yslam Shop</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons.min.css') }}">

    <style>
        :root {
            --a-blue: #0d6efd;
            --a-red: #dc3545;
            --a-green: #198754;
            --a-ink: #0f172a;
            --a-muted: #64748b;
            --a-line: #e2e8f0;
            --a-bg: #f4f7fb;
            --a-side: 272px;
        }

        body {
            background: var(--a-bg);
            color: var(--a-ink);
        }

        /* ================= KARKAS ================= */
        .adm-shell { display: flex; min-height: 100vh; }

        .adm-main {
            flex: 1 1 auto;
            min-width: 0;
            padding: 1rem;
            animation: admFade .5s ease both;
        }

        @media (min-width: 768px) { .adm-main { padding: 1.75rem 2rem 2.5rem; } }

        @keyframes admFade { from { opacity: 0; } to { opacity: 1; } }

        /* ================= YAN PANEL ================= */
        .adm-sidebar {
            flex: 0 0 var(--a-side);
            width: var(--a-side);
            position: sticky;
            top: 0;
            height: 100vh;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.25rem 1rem;
            background: linear-gradient(180deg, #111a2e 0%, #0b1220 100%);
            color: #cbd5e1;
            overflow-y: auto;
        }

        .adm-brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .25rem .5rem 1.25rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            text-decoration: none;
        }

        .adm-brand-logo {
            font-size: 1.45rem;
            font-weight: 900;
            letter-spacing: -.6px;
            line-height: 1;
        }

        .adm-brand-logo .b1 { color: #5b9dff; }
        .adm-brand-logo .b2 { color: #ff6b7a; }

        .adm-brand-tag {
            padding: .15rem .55rem;
            border-radius: 50rem;
            background: rgba(255, 255, 255, .1);
            color: #e2e8f0;
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .6px;
            text-transform: uppercase;
        }

        .adm-nav-label {
            margin: 0 .5rem .5rem;
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
        }

        .adm-nav { display: grid; gap: .3rem; }

        .adm-nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .7rem .9rem;
            border-radius: 14px;
            color: #94a3b8;
            font-weight: 700;
            text-decoration: none;
            transition: all .25s cubic-bezier(.4, 0, .2, 1);
        }

        .adm-nav-link i { font-size: 1.2rem; transition: transform .3s cubic-bezier(.34, 1.56, .64, 1); }
        .adm-nav-link .ru { display: block; margin-top: -2px; font-size: .68rem; font-weight: 600; opacity: .6; }

        .adm-nav-link:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
            transform: translateX(3px);
        }

        .adm-nav-link:hover i { transform: scale(1.15) rotate(-6deg); }

        .adm-nav-link.active {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: #fff;
            box-shadow: 0 8px 20px rgba(13, 110, 253, .35);
        }

        .adm-nav-link.active .ru { opacity: .8; }

        .adm-side-foot { padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, .08); }

        .adm-user {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .6rem .5rem;
            margin-bottom: .75rem;
        }

        .adm-user-avatar {
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--a-red);
            color: #fff;
            font-weight: 800;
        }

        .adm-user-name { color: #fff; font-weight: 800; font-size: .9rem; line-height: 1.2; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .adm-user-role { color: #64748b; font-size: .75rem; font-weight: 600; }

        .adm-side-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            width: 100%;
            padding: .6rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .12);
            background: transparent;
            color: #cbd5e1;
            font-weight: 700;
            font-size: .9rem;
            text-decoration: none;
            transition: all .25s ease;
        }

        .adm-side-btn:hover { background: rgba(255, 255, 255, .08); color: #fff; }
        .adm-side-btn.danger { color: #ff8a96; border-color: rgba(255, 107, 122, .35); }
        .adm-side-btn.danger:hover { background: var(--a-red); border-color: var(--a-red); color: #fff; }

        /* ================= MOBIL ÝOKARKY PANEL ================= */
        .adm-topbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .75rem 1rem;
            background: rgba(11, 18, 32, .96);
            backdrop-filter: blur(12px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .18);
        }

        .adm-menu-btn {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 12px;
            background: rgba(255, 255, 255, .1);
            color: #fff;
            font-size: 1.4rem;
        }

        .offcanvas.adm-offcanvas {
            width: 290px;
            background: linear-gradient(180deg, #111a2e 0%, #0b1220 100%);
            color: #cbd5e1;
        }

        /* ================= SAHYPA ULGAMY (paýlaşylýan) ================= */
        .adm-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .adm-title {
            display: flex;
            align-items: center;
            gap: .65rem;
            margin: 0;
            font-weight: 900;
            font-size: clamp(1.35rem, 1.1rem + 1vw, 1.85rem);
            letter-spacing: -.5px;
        }

        .adm-title::before {
            content: "";
            width: 5px;
            height: 1.4em;
            border-radius: 4px;
            background: linear-gradient(180deg, var(--a-blue), var(--a-red));
        }

        .adm-sub { margin: .25rem 0 0 1.15rem; color: var(--a-muted); font-size: .88rem; font-weight: 600; }

        .adm-card {
            background: #fff;
            border: 1px solid var(--a-line);
            border-radius: 22px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .04);
        }

        .adm-card-pad { padding: 1.25rem; }
        @media (min-width: 768px) { .adm-card-pad { padding: 1.5rem; } }

        .adm-card-title {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin: 0 0 1rem;
            font-size: .8rem;
            font-weight: 800;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: var(--a-muted);
        }

        .adm-card-title i { color: var(--a-blue); font-size: 1rem; }

        /* animasiýa */
        .adm-in {
            animation: admIn .6s cubic-bezier(.16, 1, .3, 1) both;
            animation-delay: var(--d, 0ms);
        }

        @keyframes admIn { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }

        /* düwmeler */
        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .6rem 1.25rem;
            border: 0;
            border-radius: 50rem;
            background: linear-gradient(135deg, #198754, #146c43);
            color: #fff;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 6px 16px rgba(25, 135, 84, .3);
            transition: all .25s cubic-bezier(.34, 1.56, .64, 1);
        }

        .btn-main:hover { color: #fff; transform: translateY(-3px); box-shadow: 0 12px 24px rgba(25, 135, 84, .4); }
        .btn-main.blue { background: linear-gradient(135deg, #0d6efd, #0a58ca); box-shadow: 0 6px 16px rgba(13, 110, 253, .3); }
        .btn-main.blue:hover { box-shadow: 0 12px 24px rgba(13, 110, 253, .4); }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .55rem 1.1rem;
            border: 1.5px solid var(--a-line);
            border-radius: 50rem;
            background: #fff;
            color: #334155;
            font-weight: 700;
            font-size: .9rem;
            text-decoration: none;
            transition: all .25s ease;
        }

        .btn-ghost:hover { border-color: var(--a-blue); color: var(--a-blue); transform: translateY(-2px); box-shadow: 0 6px 15px rgba(13, 110, 253, .12); }
        .btn-ghost i { transition: transform .25s; }
        .btn-ghost:hover i.bi-arrow-left { transform: translateX(-4px); }

        .btn-soft {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .35rem;
            padding: .45rem .85rem;
            border: 0;
            border-radius: 12px;
            font-weight: 700;
            font-size: .85rem;
            text-decoration: none;
            transition: all .2s ease;
        }

        .btn-soft.primary { background: #e7f0ff; color: #0b5ed7; }
        .btn-soft.primary:hover { background: var(--a-blue); color: #fff; transform: translateY(-2px); }
        .btn-soft.danger { background: #fdecee; color: #c02a38; }
        .btn-soft.danger:hover { background: var(--a-red); color: #fff; transform: translateY(-2px); }
        .btn-soft.gray { background: #f1f5f9; color: #475569; }
        .btn-soft.gray:hover { background: #e2e8f0; color: var(--a-ink); }

        /* gözleg we süzgüç */
        .adm-search {
            display: flex;
            align-items: center;
            max-width: 380px;
            background: #fff;
            border: 1.5px solid var(--a-line);
            border-radius: 50rem;
            overflow: hidden;
            transition: all .25s ease;
        }

        .adm-search:focus-within { border-color: var(--a-blue); box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15); }
        .adm-search i { padding-left: 1rem; color: #94a3b8; }

        .adm-search input {
            flex: 1 1 auto;
            min-width: 0;
            padding: .6rem .8rem;
            border: 0;
            outline: 0;
            background: transparent;
            font-weight: 600;
        }

        .adm-toolbar { display: flex; flex-wrap: wrap; align-items: center; gap: .75rem; margin-bottom: 1rem; }
        .adm-toolbar .adm-search { flex: 1 1 260px; }

        .adm-chip {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .45rem .95rem;
            border: 1.5px solid var(--a-line);
            border-radius: 50rem;
            background: #fff;
            color: #334155;
            font-size: .85rem;
            font-weight: 700;
            transition: all .25s ease;
        }

        .adm-chip small {
            min-width: 22px;
            padding: 0 .4rem;
            border-radius: 50rem;
            background: #f1f5f9;
            color: var(--a-muted);
            font-weight: 800;
            text-align: center;
            line-height: 1.4rem;
        }

        .adm-chip:hover { border-color: var(--a-blue); color: var(--a-blue); transform: translateY(-2px); }
        .adm-chip.active { background: var(--a-blue); border-color: var(--a-blue); color: #fff; box-shadow: 0 6px 14px rgba(13, 110, 253, .3); }
        .adm-chip.active small { background: rgba(255, 255, 255, .22); color: #fff; }

        /* tablisa */
        .table.adm-table { margin: 0; --bs-table-bg: transparent; }

        .adm-table thead th {
            padding: .9rem 1rem;
            border-bottom: 1px solid var(--a-line);
            background: #f8fafc;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
            color: var(--a-muted);
            white-space: nowrap;
        }

        .adm-table tbody td { padding: .9rem 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .adm-table tbody tr { transition: background .2s ease; }
        .adm-table tbody tr:hover { background: #f6faff; }
        .adm-table tbody tr:last-child td { border-bottom: 0; }

        /* mobil kartlar */
        .m-card { padding: 1rem; border-bottom: 1px solid #eef2f7; }
        .m-card:last-child { border-bottom: 0; }

        /* status nyşanlary */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .35rem .8rem;
            border: 1px solid var(--pl);
            border-radius: 50rem;
            background: var(--pb);
            color: var(--pc);
            font-size: .78rem;
            font-weight: 800;
            white-space: nowrap;
        }

        .pill-pending { --pc: #475569; --pb: #f1f5f9; --pl: #e2e8f0; }
        .pill-way     { --pc: #b45309; --pb: #fef3c7; --pl: #fde68a; }
        .pill-ok      { --pc: #15803d; --pb: #dcfce7; --pl: #bbf7d0; }
        .pill-no      { --pc: #b91c1c; --pb: #fee2e2; --pl: #fecaca; }
        .pill-info    { --pc: #0b5ed7; --pb: #e7f0ff; --pl: #cfe0ff; }
        .pill-none    { --pc: #64748b; --pb: #f8fafc; --pl: #e2e8f0; }

        /* surat we awatar */
        .adm-thumb {
            flex: 0 0 auto;
            width: 52px;
            height: 52px;
            padding: 4px;
            border: 1px solid var(--a-line);
            border-radius: 14px;
            background: #f8fafc;
            object-fit: contain;
            transition: transform .3s ease;
        }

        tr:hover .adm-thumb, .m-card:hover .adm-thumb { transform: scale(1.08) rotate(-3deg); }

        .adm-avatar {
            flex: 0 0 auto;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            color: #fff;
            font-weight: 800;
        }

        .adm-empty { padding: 3rem 1rem; text-align: center; color: var(--a-muted); font-weight: 600; }
        .adm-empty i { display: block; margin-bottom: .75rem; font-size: 2.6rem; opacity: .4; }

        /* habarlar */
        .adm-alert {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .85rem 1.1rem;
            margin-bottom: 1.25rem;
            border: 0;
            border-radius: 16px;
            font-weight: 700;
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
            animation: admIn .45s cubic-bezier(.16, 1, .3, 1) both;
        }

        .adm-alert.ok { background: #dcfce7; color: #166534; }
        .adm-alert.err { background: #fee2e2; color: #991b1b; }
        .adm-alert i { font-size: 1.25rem; }

        /* formalar */
        .adm-form .form-label { margin-bottom: .35rem; font-size: .82rem; font-weight: 800; color: #475569; }

        .adm-form .form-control,
        .adm-form .form-select,
        .adm-form .input-group-text {
            padding-top: .7rem;
            padding-bottom: .7rem;
            border: 1.5px solid var(--a-line);
            background: #f8fafc;
            font-weight: 600;
        }

        .adm-form .form-control, .adm-form .form-select { border-radius: 14px; }
        .adm-form .input-group > .form-control { border-radius: 14px 0 0 14px; }
        .adm-form .input-group > .input-group-text { border-radius: 0 14px 14px 0; border-left: 0; font-weight: 800; color: var(--a-blue); }

        .adm-form .form-control:focus,
        .adm-form .form-select:focus {
            background: #fff;
            border-color: var(--a-blue);
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .15);
        }

        .adm-form .is-invalid { border-color: var(--a-red) !important; }

        /* sahypalama */
        .pagination { gap: 6px; flex-wrap: wrap; justify-content: center; margin: 0; }

        .pagination .page-item .page-link {
            padding: 8px 16px;
            border: 1px solid var(--a-line);
            border-radius: 12px !important;
            color: var(--a-blue);
            font-weight: 700;
            transition: all .2s ease;
        }

        .pagination .page-item .page-link:hover { background: #eef4ff; transform: translateY(-2px); }

        .pagination .page-item.active .page-link {
            background: var(--a-blue);
            border-color: var(--a-blue);
            color: #fff;
            box-shadow: 0 4px 12px rgba(13, 110, 253, .3);
        }

        @media (prefers-reduced-motion: reduce) {
            .adm-main, .adm-in, .adm-alert { animation: none !important; }
        }
    </style>
</head>

<body>
    @php
        $navItems = [
            ['route' => 'admin.dashboard',      'match' => 'admin.dashboard',  'icon' => 'bi-speedometer2', 'label' => 'Dashboard',   'ru' => 'Панель'],
            ['route' => 'admin.products.index', 'match' => 'admin.products.*', 'icon' => 'bi-box-seam',     'label' => 'Harytlar',    'ru' => 'Товары'],
            ['route' => 'admin.orders.index',   'match' => 'admin.orders.*',   'icon' => 'bi-cart-check',   'label' => 'Sargytlar',   'ru' => 'Заказы'],
            ['route' => 'admin.users.index',    'match' => 'admin.users.*',    'icon' => 'bi-people',       'label' => 'Ulanyjylar',  'ru' => 'Пользователи'],
        ];
        $adminName = optional(Auth::user())->name ?? 'Admin';
        $adminInitial = mb_strtoupper(mb_substr($adminName, 0, 1));
    @endphp

    {{-- ================= MOBIL ÝOKARKY PANEL ================= --}}
    <header class="adm-topbar d-md-none">
        <a href="{{ route('admin.dashboard') }}" class="adm-brand border-0 p-0 m-0">
            <span class="adm-brand-logo"><span class="b1">Yslam</span><span class="b2">Shop</span></span>
            <span class="adm-brand-tag">Admin</span>
        </a>
        <button class="adm-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarMobile" aria-label="Menu">
            <i class="bi bi-list"></i>
        </button>
    </header>

    <div class="offcanvas offcanvas-start adm-offcanvas" tabindex="-1" id="adminSidebarMobile">
        <div class="offcanvas-header border-bottom border-secondary border-opacity-25">
            <a href="{{ route('admin.dashboard') }}" class="adm-brand border-0 p-0 m-0">
                <span class="adm-brand-logo"><span class="b1">Yslam</span><span class="b2">Shop</span></span>
                <span class="adm-brand-tag">Admin</span>
            </a>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
            <nav class="adm-nav">
                @foreach($navItems as $n)
                <a href="{{ route($n['route']) }}" class="adm-nav-link {{ request()->routeIs($n['match']) ? 'active' : '' }}">
                    <i class="bi {{ $n['icon'] }}"></i>
                    <span>{{ $n['label'] }}<span class="ru">{{ $n['ru'] }}</span></span>
                </a>
                @endforeach
            </nav>

            <div class="adm-side-foot">
                <div class="adm-user">
                    <div class="adm-user-avatar">{{ $adminInitial }}</div>
                    <div style="min-width: 0;">
                        <div class="adm-user-name">{{ $adminName }}</div>
                        <div class="adm-user-role">Administrator</div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('home.index') }}" class="adm-side-btn"><i class="bi bi-shop"></i> Saýta git</a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="adm-side-btn danger"><i class="bi bi-box-arrow-right"></i> Çykmak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="adm-shell">
        {{-- ================= KOMPÝUTER YAN PANELI ================= --}}
        <aside class="adm-sidebar d-none d-md-flex">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="adm-brand">
                    <span class="adm-brand-logo"><span class="b1">Yslam</span><span class="b2">Shop</span></span>
                    <span class="adm-brand-tag">Admin</span>
                </a>

                <div class="adm-nav-label">Menu</div>
                <nav class="adm-nav">
                    @foreach($navItems as $n)
                    <a href="{{ route($n['route']) }}" class="adm-nav-link {{ request()->routeIs($n['match']) ? 'active' : '' }}">
                        <i class="bi {{ $n['icon'] }}"></i>
                        <span>{{ $n['label'] }}<span class="ru">{{ $n['ru'] }}</span></span>
                    </a>
                    @endforeach
                </nav>
            </div>

            <div class="adm-side-foot">
                <div class="adm-user">
                    <div class="adm-user-avatar">{{ $adminInitial }}</div>
                    <div style="min-width: 0;">
                        <div class="adm-user-name">{{ $adminName }}</div>
                        <div class="adm-user-role">Administrator</div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('home.index') }}" class="adm-side-btn"><i class="bi bi-shop"></i> Saýta git</a>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="adm-side-btn danger"><i class="bi bi-box-arrow-right"></i> Çykmak</button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="adm-main">
            @if(session('success'))
            <div class="adm-alert ok alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="adm-alert err alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // animasiýa gijikdirmesi: data-d="70" -> --d: 70ms
            document.querySelectorAll('[data-d]').forEach(el => el.style.setProperty('--d', el.dataset.d + 'ms'));

            // sanlaryň 0-dan ösmegi: data-count="120"
            document.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.dataset.count) || 0;
                if (target === 0 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) { el.textContent = target; return; }

                const start = performance.now();
                const dur = 900;
                (function step(now) {
                    const p = Math.min((now - start) / dur, 1);
                    const eased = 1 - Math.pow(1 - p, 3);
                    el.textContent = Math.round(target * eased);
                    if (p < 1) requestAnimationFrame(step);
                })(start);
            });
        });
    </script>
    @stack('scripts')
</body>

</html>