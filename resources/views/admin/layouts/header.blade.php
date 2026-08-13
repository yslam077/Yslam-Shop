<!DOCTYPE html>
<html lang="tm">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Yslam Shop</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons.min.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .75);
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 4px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">


            <aside class="col-md-3 col-lg-2 p-3 sidebar d-flex flex-column justify-content-between">
                <div>

                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-white text-decoration-none px-2">
                        <span class="fs-4 fw-bold text-danger">Admin Panel</span>
                    </a>

                    <hr class="text-secondary">


                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="nav-link">
                                <i class="bi bi-box-seam me-2"></i> Harytlar (Товары)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="nav-link">
                                <i class="bi bi-cart-check me-2"></i> Sargytlar (Заказы)
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="bi bi-people me-2"></i> Ulanyjylar (Пользователи)
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <hr class="text-secondary">
                    <a href="{{ route('home.index') }}" class="text-decoration-none">
                        <button type="submit" class="btn btn-outline-danger w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right"></i> Çykmak
                        </button>
                    </a>
                </div>
            </aside>
            <main class="col-md-9 col-lg-10 p-4">
                @yield('content')
            </main>

        </div>
    </div>
</body>

</html>