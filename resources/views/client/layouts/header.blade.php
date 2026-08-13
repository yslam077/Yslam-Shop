<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('./css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./icons/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/aos.css') }}">
    <link rel="shortcut icon" href="{{ asset('iconimg/yslam_shop.webp') }}" type="image/x-icon">
    <style>
        .text {
            color: black;
            transition: color 0.2s ease-in,
                text-shadow 0.2s ease-in;
            text-shadow: 0 0 0px #0048ff;
        }

        .text:hover {
            color: #0048ff;
            text-shadow: 0 0 10px #3b82f6 0 0 10px #3b82f6;
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


        .custom-tab.active.tab-red {
            color: #dc3545 !important;
            /* Красный текст */
        }

        .custom-tab.active.tab-red::after {
            background-color: #dc3545;

        }


        .custom-tab.active.tab-green {
            color: #00cd00 !important;

        }

        .custom-tab.active.tab-green::after {
            background-color: #00cd00;

        }
    </style>
</head>

<body>
    @include('client.app.navbar')
    <div class="container-fluid mx-auto vh-100">
        @yield('content')
    </div>
    <script src="{{ asset('./js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('./js/splide.min.js') }}"></script>
    <script src="{{ asset('./js/aos.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.splide', {
                perPage: 1, // Her sahypada gorkezilmeli slide sany
                type: "loop",
                autoplay: true, // true or false (Automatic gecip durar yaly)
                arrows: false, // true or false (Sag we cep geciryan duwmejikler)
                interval: 2500, //3000 gecir tizligi 3000 = 3 sekunt
                pauseOnHover: true, // true or false (Ustune sycanjygy eltende durmak)
                pagination: false, // true or false (Pagination)
                perMove: true, // Her slide gecir sany (bir-birden ya-da...)
                gap: '0rem', // Slide aralyklaryndaky aralyk 
                breakpoints: { // ekran olcegine gora uytgedis
                    576: {
                        perPage: 1,
                    },
                    768: {
                        perPage: 1,
                    },
                    992: {
                        perPage: 1,
                    },
                },
            }).mount();
            new Splide('.splide', {
                classes: {
                    arrows: 'splide__arrows your-class-arrows',
                    arrow: 'splide__arrow your-class-arrow',
                    prev: 'splide__arrow--prev your-class-prev',
                    next: 'splide__arrow--next your-class-next',
                },
            });
        })
        AOS.init();
        const togglepaswor = document.querySelector('#togglePassword')
        const paswor = document.querySelector('#passwordInput')
        togglepaswor.addEventListener('click', function() {
            const type = paswor.getAttribute('type') === 'password' ? 'text' : 'password';
            paswor.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');

        })
        document.addEventListener("DOMContentLoaded", function() {
            const tabLinks = document.querySelectorAll('.custom-tab');
            const confirmBlock = document.querySelector('#confirmPasswordBlock');
            const submitBtn = document.querySelector('.modal-body button[type="submit"]');
            let iki = document.querySelector('.ikinji')

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
                        iki.classList.remove('d-none')

                        if (confirmBlock) confirmBlock.classList.remove('d-none');
                        submitBtn.textContent = 'Agza bolmak';
                    } else {

                        this.classList.add('tab-red');
                        iki.classList.add('d-none')

                        if (confirmBlock) confirmBlock.classList.add('d-none');
                        submitBtn.textContent = 'Girmek';
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
            } else {
                console.error('Modal element #loginModal not found!');
            }
        });
    </script>
    @endif
</body>