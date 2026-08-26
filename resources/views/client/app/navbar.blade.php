<nav class="navbar navbar-expand-lg bg-white sticky-top py-2 shadow-sm" data-bs-theme="light" style="z-index: 1030;">
    <div class="container-lg">
        
        <div class="d-lg-none w-100">
            <div class="d-flex align-items-center justify-content-between gap-2">
                <a href="{{ route('home.index') }}" class="text-decoration-none flex-shrink-0">
                    <span class="text-primary fw-bold fs-5">Yslam<span style="color: #ff889c;">Shop</span></span>
                </a>

                <form action="{{ route('products.search') }}" method="GET" class="flex-grow-1">
                    <div class="input-group input-group-sm">
                        <input type="text"
                            name="query"
                            class="form-control rounded-pill-start bg-light border-0 ps-3"
                            placeholder="{{ __('app.search') }}"
                            value="{{ request('query') }}"
                            required>
                        <button class="btn btn-primary rounded-pill-end px-3" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <div class="dropdown flex-shrink-0">
                    <button class="btn btn-light btn-sm rounded-pill fw-bold border-0 px-2" type="button" data-bs-toggle="dropdown">
                        <span>{{ strtoupper(in_array(app()->getLocale(), ['tk', 'tm']) ? 'TM' : app()->getLocale()) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item fw-semibold" href="{{ route('locale', 'tk') }}">🇹🇲 Türkmen</a></li>
                        <li><a class="dropdown-item fw-semibold" href="{{ route('locale', 'ru') }}">🇷🇺 Русский</a></li>
                        <li><a class="dropdown-item fw-semibold" href="{{ route('locale', 'en') }}">🇬🇧 English</a></li>
                    </ul>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 mt-2 pt-2 border-top">
                <button class="btn btn-sm btn-primary fw-bold text-nowrap rounded-pill px-3 shadow-sm d-flex align-items-center gap-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#categoriesMobileCanvas">
                    <i class="bi bi-grid-fill"></i>
                    <span>Kategoriýalar</span>
                </button>

                <div class="d-flex overflow-auto text-nowrap gap-1 py-1" style="-webkit-overflow-scrolling: touch; scrollbar-width: none;">
                    @foreach ($categories as $item)
                        <a href="{{ route('categories.show', $item->id) }}" class="btn btn-sm btn-light border-0 bg-light text-dark fw-medium rounded-pill px-3" style="font-size: 0.82rem;">
                            {{ $item->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse flex-column d-none d-lg-flex" id="mainNavbar">
            <div class="row w-100 align-items-center py-2 gy-3">
                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-start gap-2">
                    <img src="{{ asset('iconimg/local_convenience_store_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}" alt="Store Icon" style="width: 30px;">
                    <span class="fw-bold text-dark h5 mb-0">{{ __('app.Service') }}24/7</span>

                    <div class="dropdown ms-2">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle fw-bold d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe"></i>
                            <span>{{ strtoupper(in_array(app()->getLocale(), ['tk', 'tm']) ? 'TM' : app()->getLocale()) }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-1">
                            <li><a class="dropdown-item d-flex align-items-center gap-2 fw-semibold" href="{{ route('locale', 'tk') }}"><span>🇹🇲</span> Türkmen</a></li>
                            <li><a class="dropdown-item d-flex align-items-center gap-2 fw-semibold" href="{{ route('locale', 'ru') }}"><span>🇷🇺</span> Русский</a></li>
                            <li><a class="dropdown-item d-flex align-items-center gap-2 fw-semibold" href="{{ route('locale', 'en') }}"><span>🇬🇧</span> English</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-4 text-center">
                    <a href="{{ route('home.index') }}" class="text-decoration-none">
                        <span class="text-primary fw-bold display-6">Yslam <span style="color: rgb(255, 136, 156);">Shop</span></span>
                    </a>
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-end gap-2">
                    @if(Auth::check() && Auth::user()->is_admin)
                    <div class="dropdown">
                        <button class="btn btn-danger fw-bold d-flex align-items-center gap-1 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-shield-lock-fill"></i><span>Admin</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-1">
                            <li><a class="dropdown-item fw-bold text-primary py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item fw-bold text-danger py-2 w-100 text-start border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Çykmak') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @elseif(Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-outline-primary fw-bold d-flex align-items-center gap-1 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i><span>{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-1">
                            <li><a class="dropdown-item fw-bold text-dark py-2" href="{{ route('orders.my') }}"><i class="bi bi-bag-check me-2 text-primary"></i> {{ __('app.order') }}</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item fw-bold text-danger py-2 w-100 text-start border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Çykmak') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <button class="btn btn-success fw-bold d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-person-fill"></i><span>{{ __('Girmek') }}</span>
                    </button>
                    @endif

                    <a href="{{ route('cart.index') }}">
                        <button class="btn border border-primary position-relative p-2" aria-label="Корзина">
                            <span id="cart-badge-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count(session('cart', [])) }}
                            </span>
                            <img src="{{ asset('iconimg/shopping_cart_24dp_5985E1_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Cart" style="width: 22px;">
                        </button>
                    </a>
                </div>
            </div>

            <hr class="text-secondary w-100 my-2" style="opacity: 0.15;">

            <div class="row w-100 align-items-center gy-2 pb-1">
                <div class="col-12 col-xl-8 d-flex flex-wrap align-items-center justify-content-start gap-2 row-gap-2">
                    <a href="{{ route('products.index') }}" class="text-decoration-none">
                        <button type="button" class="btn btn-danger fw-bold px-2 py-1" style="font-size: 0.92rem;">
                            <i class="bi bi-list me-1"></i> {{ __('app.product_show') }}
                        </button>
                    </a>
                    <a href="{{ route('home.index') }}" class="text-decoration-none text-dark fw-bold d-flex align-items-center gap-1" style="font-size: 0.94rem;">
                        <i class="bi bi-house"></i> {{ __('app.home') }}
                    </a>
                    <a href="{{ route('orders.my') }}" class="text-decoration-none text-primary fw-bold d-flex align-items-center gap-1" style="font-size: 0.94rem;">
                        <i class="bi bi-bag-check-fill"></i> {{ __('app.order') }}
                    </a>
                    <span class="text-secondary opacity-25">|</span>
                    @foreach ($categories as $item)
                    <a href="{{ route('categories.show', $item->id) }}" class="text-decoration-none fw-bold text-dark text-nowrap px-1" style="font-size: 0.93rem;">
                        {{ $item->name }}
                    </a>
                    @endforeach
                </div>

                <div class="col-12 col-xl-4 ms-auto">
                    <form action="{{ route('products.search') }}" method="GET" class="w-100">
                        <div class="input-group input-group-sm">
                            <input type="text" name="query" class="form-control rounded-pill-start border-end-0 ps-3" placeholder="{{ __('app.search') }}" value="{{ request('query') }}" style="font-size: 0.9rem;" required>
                            <button class="btn btn-primary rounded-pill-end px-3" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</nav>
<div class="offcanvas offcanvas-start border-end shadow-lg" tabindex="-1" id="categoriesMobileCanvas" style="width: 75vw;">
    <div class="offcanvas-header bg-primary text-white py-3 px-3">
        <h5 class="offcanvas-title fw-bold m-0 d-flex align-items-center gap-2" style="font-size: 1.1rem;">
            <i class="bi bi-grid-fill"></i> Kategoriýalar
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action py-3 px-3 fw-bold border-bottom text-primary fs-6">
                <i class="bi bi-border-all me-2"></i> Ähli harytlar
            </a>
            @foreach($categories as $item)
                <a href="{{ route('categories.show', $item->id) }}" class="list-group-item list-group-item-action py-3 px-3 fw-semibold border-bottom fs-6 text-dark">
                    <i class="bi bi-chevron-right me-2 text-muted small"></i> {{ $item->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="d-lg-none fixed-bottom bg-white border-top shadow-lg py-2" style="z-index: 1040;">
    <div class="container d-flex justify-content-around align-items-center text-center px-1">
        <a href="{{ route('home.index') }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
            <i class="bi bi-house-door fs-5"></i>
            <span style="font-size: 0.7rem;" class="fw-bold">{{ __('app.home') }}</span>
        </a>

        <a href="{{ route('products.index') }}" class="text-decoration-none text-dark d-flex flex-column align-items-center">
            <i class="bi bi-grid fs-5"></i>
            <span style="font-size: 0.7rem;" class="fw-bold">{{ __('app.product_show') }}</span>
        </a>
        <a href="{{ route('cart.index') }}" class="text-decoration-none text-dark d-flex flex-column align-items-center position-relative">
            <i class="bi bi-cart3 fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                {{ count(session('cart', [])) }}
            </span>
            <span style="font-size: 0.7rem;" class="fw-bold">Sebet</span>
        </a>

        <a href="{{ route('orders.my') }}" class="text-decoration-none text-primary d-flex flex-column align-items-center">
            <i class="bi bi-bag-check fs-5"></i>
            <span style="font-size: 0.7rem;" class="fw-bold">{{ __('app.order') }}</span>
        </a>
        @if(Auth::check() && Auth::user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-danger d-flex flex-column align-items-center">
            <i class="bi bi-shield-lock fs-5"></i>
            <span style="font-size: 0.7rem;" class="fw-bold">Admin</span>
        </a>
        @elseif(Auth::check())
        <div class="dropdown">
            <a href="#" class="text-decoration-none text-dark d-flex flex-column align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-5 text-primary"></i>
                <span style="font-size: 0.7rem;" class="fw-bold text-truncate" style="max-width: 55px;">{{ Str::limit(Auth::user()->name, 6) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mb-2">
                <li class="dropdown-header fw-bold text-primary">{{ Auth::user()->name }}</li>
                <li><hr class="dropdown-divider my-1"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="dropdown-item fw-bold text-danger py-1 w-100 text-start border-0 bg-transparent" style="font-size: 0.85rem;">
                            <i class="bi bi-box-arrow-right me-2"></i> {{ __('Çykmak') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="text-decoration-none text-success d-flex flex-column align-items-center">
            <i class="bi bi-box-arrow-in-right fs-5"></i>
            <span style="font-size: 0.7rem;" class="fw-bold">{{ __('Girmek') }}</span>
        </a>
        @endif
    </div>
</div>