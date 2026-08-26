<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yslam Shop')</title>
    
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="shortcut icon" href="{{ asset('iconimg/yslam_shop.webp') }}" type="image/x-icon">
    
    <style>
        .text {
            color: black;
            transition: color 0.2s ease-in, text-shadow 0.2s ease-in;
            text-shadow: 0 0 0px #0048ff;
        }

        .text:hover {
            color: #0048ff;
            text-shadow: 0 0 10px #3b82f6;
        }

        .custom-tab {
            background: transparent !important;
            border: none !important;
            position: relative;
            padding-bottom: 8px !important;
            transition: color 0.2s ease;
        }

        .custom-tab.active::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            border-radius: 2px;
        }

        .custom-tab.active.tab-red { color: #dc3545 !important; }
        .custom-tab.active.tab-red::after { background-color: #dc3545; }

        .custom-tab.active.tab-green { color: #00cd00 !important; }
        .custom-tab.active.tab-green::after { background-color: #00cd00; }
    </style>
</head>

<body class="bg-light">
    @include('client.app.navbar')

    <main class="min-vh-100">
        @yield('content')
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const splideElement = document.querySelector('.splide');
            if (splideElement) {
                new Splide(splideElement, {
                    type: "loop",
                    perPage: 1,
                    autoplay: true,
                    interval: 3000,
                    arrows: false,
                    pagination: true,
                    pauseOnHover: true,
                    gap: '1rem',
                }).mount();
            }
            if (typeof AOS !== 'undefined') {
                AOS.init();
            }

            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#passwordInput');
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
            const tabLinks = document.querySelectorAll('.custom-tab');
            const confirmBlock = document.querySelector('#confirmPasswordBlock');
            const submitBtn = document.querySelector('.modal-body button[type="submit"]');
            const iki = document.querySelector('.ikinji');

            tabLinks.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    tabLinks.forEach(t => {
                        t.classList.remove('active', 'tab-red', 'tab-green');
                        t.classList.add('text-muted');
                    });

                    this.classList.remove('text-muted');
                    this.classList.add('active');

                    if (this.id === 'tabAgza') {
                        this.classList.add('tab-green');
                        if (iki) iki.classList.remove('d-none');
                        if (confirmBlock) confirmBlock.classList.remove('d-none');
                        if (submitBtn) submitBtn.textContent = 'Agza bolmak';
                    } else {
                        this.classList.add('tab-red');
                        if (iki) iki.classList.add('d-none');
                        if (confirmBlock) confirmBlock.classList.add('d-none');
                        if (submitBtn) submitBtn.textContent = 'Girmek';
                    }
                });
            });
        });
    </script>

    @if(session('openLoginModal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('loginModal');
            if (modalElement) {
                var loginModal = new bootstrap.Modal(modalElement);
                loginModal.show();
            }
        });
    </script>
    @endif
</body>
</html>