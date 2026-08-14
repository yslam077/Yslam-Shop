<nav class="navbar navbar-expand-lg bg-white sticky-top py-2 shadow-sm" data-bs-theme="light" style="z-index: 1030;">
    <div class="container-lg">

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse flex-column" id="mainNavbar">

            <div class="row w-100 align-items-center py-2 gy-3">

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-start gap-2">
                    <img src="{{ asset('iconimg/local_convenience_store_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}" alt="Store Icon" style="width: 30px;">
                    <span class="fw-bold text-dark h5 mb-0">Hyzmat 24/7</span>

                    <div class="dropdown ms-2">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle fw-bold d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe"></i>
                            <span>{{ strtoupper(in_array(app()->getLocale(), ['tk', 'tm']) ? 'TM' : app()->getLocale()) }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-1">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 fw-semibold" href="{{ route('locale', 'tk') }}">
                                    <span>🇹🇲</span> Türkmen
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 fw-semibold" href="{{ route('locale', 'ru') }}">
                                    <span>🇷🇺</span> Русский
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 fw-semibold" href="{{ route('locale', 'en') }}">
                                    <span>🇬🇧</span> English
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-4 text-center">
                    <a href="{{ route('home.index') }}" class="text-decoration-none">
                        <span class="text-primary fw-bold display-6">Yslam <span style="color: rgb(255, 136, 156);">Shop</span></span>
                    </a>
                </div>

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end gap-2">

                    @if(session()->has('is_admin_logged_in'))

                    <div class="dropdown">
                        <button class="btn btn-danger fw-bold d-flex align-items-center gap-1 dropdown-toggle" type="button" id="adminMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span>Admin</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-1" aria-labelledby="adminMenu">
                            <li>
                                <a class="dropdown-item fw-bold text-primary py-2" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
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
                        <button class="btn btn-outline-primary fw-bold d-flex align-items-center gap-1 dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-1" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item fw-bold text-dark py-2" href="{{ route('orders.my') }}">
                                    <i class="bi bi-bag-check me-2 text-primary"></i> {{ __('Sargytlarym') }}
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
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

                    <button class="btn btn-success fw-bold d-flex align-items-center gap-1" id="openBtn" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-person-fill"></i>
                        <span>{{ __('Girmek') }}</span>
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

                <div class="col-12 col-xl-8 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-2 row-gap-2">
                    <a href="{{ route('products.index') }}" class="text-decoration-none">
                        <button type="button" class="btn btn-danger fw-bold px-2 py-1" style="font-size: 0.92rem;">
                            <i class="bi bi-list me-1"></i> {{ __('Harytlar') }}
                        </button>
                    </a>

                    <a href="{{ route('home.index') }}" class="text-decoration-none text-dark fw-bold d-flex align-items-center gap-1" style="font-size: 0.94rem;">
                        <i class="bi bi-house"></i> {{ __('Baş sahypa') }}
                    </a>

                    <a href="{{ route('orders.my') }}" class="text-decoration-none text-primary fw-bold d-flex align-items-center gap-1" style="font-size: 0.94rem;">
                        <i class="bi bi-bag-check-fill"></i> {{ __('Sargytlarym') }}
                    </a>

                    <span class="text-secondary opacity-25 d-none d-lg-inline">|</span>

                    @foreach ($categories as $item)
                    <a href="{{ route('categories.show', $item->id) }}" class="text-decoration-none fw-bold text-dark text-nowrap px-1" style="font-size: 0.93rem;">
                        {{ $item->name }}
                    </a>
                    @endforeach
                </div>

                <div class="col-12 col-xl-4 ms-auto">
                    <form action="{{ route('products.search') }}" method="GET" class="w-100">
                        <div class="input-group input-group-sm">
                            <input type="text"
                                name="query"
                                class="form-control rounded-pill-start border-end-0 ps-3"
                                placeholder="{{ __('Haryt gözle...') }}"
                                value="{{ request('query') }}"
                                style="font-size: 0.9rem;"
                                required>
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