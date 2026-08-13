<nav class="navbar navbar-expand-lg bg-white sticky-top py-2 shadow-sm" data-bs-theme="light" style="z-index: 1030;">
    <div class="container-lg">

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse flex-column" id="mainNavbar">

            <div class="row w-100 align-items-center py-2 gy-3">

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-start gap-2">
                    <img src="{{ asset('iconimg/local_convenience_store_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}" alt="Store Icon" style="width: 32px;">
                    <span class="fw-bold text-dark h5 mb-0">Hyzmat 24/7</span>

                    <div class="dropdown ms-2 btn-group dropend">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('locale','en') }}">{{ __('app.lang_en') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('locale','tm') }}">{{ __('app.lang_tm') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('locale','ru') }}">{{ __('app.lang_ru') }}</a></li>
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
                            <i class="bi bi-shield-lock-fill fs-5"></i>
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
                                        <i class="bi bi-box-arrow-right me-2"></i> Çykmak
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    @elseif(Auth::check())

                    <div class="dropdown">
                        <button class="btn btn-outline-primary fw-bold d-flex align-items-center gap-1 dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-1" aria-labelledby="userMenu">
                            <li>
                                <a class="dropdown-item fw-bold text-dark py-2" href="{{ route('orders.my') }}">
                                    <i class="bi bi-bag-check me-2 text-primary"></i> Sargytlarym
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item fw-bold text-danger py-2 w-100 text-start border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2"></i> Çykmak
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    @else

                    <button class="btn btn-success fw-bold d-flex align-items-center gap-1" id="openBtn" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-person-fill fs-5"></i>
                        <span>Girmek</span>
                    </button>
                    @endif

                    <a href="{{ route('cart.index') }}">
                        <button class="btn border border-primary position-relative p-2" aria-label="Корзина">
                            <span id="cart-badge-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count(session('cart', [])) }}
                            </span>
                            <img src="{{ asset('iconimg/shopping_cart_24dp_5985E1_FILL0_wght400_GRAD0_opsz24.png') }}" alt="Cart" style="width: 24px;">
                        </button>
                    </a>
                </div>

            </div>

            <hr class="text-secondary w-100 my-2" style="opacity: 0.15;">

            <div class="row w-100 align-items-center gy-3 pb-1">

                <div class="align-items-center col-12 col-lg-9 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-3">
                    <a href="{{ route('products.index') }}" class="text-decoration-none">
                        <button type="button" class="btn btn-danger fw-bold">
                            <i class="bi bi-list me-1"></i> Harytlary görmek
                        </button>
                    </a>
                    <a href="{{ route('home.index') }}" class="text-decoration-none text-dark fw-bold fs-5 d-flex align-items-center gap-1">
                        <i class="bi bi-house"></i> Home
                    </a>

                    <!-- КНОПКА "МОИ ЗАКАЗЫ" С ИКОНКОЙ -->
                    <a href="{{ route('orders.my') }}" class="text-decoration-none text-primary fw-bold fs-5 d-flex align-items-center gap-1">
                        <i class="bi bi-bag-check-fill"></i> Sargytlarym
                    </a>

                    @foreach ($categories as $item)
                    <a href="{{ route('categories.show', $item->id) }}" class="text-decoration-none fw-bold fs-5 text-dark">
                        {{ $item->name }}
                    </a>
                    @endforeach
                </div>

                <div class="col-12 col-lg-3 ms-auto">
                    <form action="{{ route('products.search') }}" method="GET" class="w-100">
                        <div class="input-group">
                            <input type="text"
                                name="query"
                                class="form-control form-control-sm rounded-pill-start border-end-0 ps-3"
                                placeholder="Haryt gözle..."
                                value="{{ request('query') }}"
                                required>
                            <button class="btn btn-primary btn-sm rounded-pill-end px-3" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</nav>