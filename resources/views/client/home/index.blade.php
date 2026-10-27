@extends('client.layouts.header')

@section('content')
{{-- skript işlemese hem hemme zat görünsin: "js-reveal" diňe JS bar wagty goşulýar --}}
<script>document.documentElement.classList.add('js-reveal');</script>

@include('client.app.splide')

<style>
    :root {
        --ys-blue: #0d6efd;
        --ys-red: #dc3545;
        --ys-ink: #0f172a;
        --ys-line: rgba(226, 232, 240, .9);
    }

    .js-reveal .reveal {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s ease, transform .6s cubic-bezier(.16, 1, .3, 1);
        transition-delay: var(--d, 0ms);
    }

    .js-reveal .reveal.in { opacity: 1; transform: none; }

    
    .sec-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .sec-title {
        display: flex;
        align-items: center;
        gap: .6rem;
        margin: 0;
        font-weight: 900;
        font-size: clamp(1.25rem, 1rem + 1vw, 1.7rem);
        letter-spacing: -.4px;
        color: var(--ys-ink);
    }

    .sec-title::before {
        content: "";
        width: 5px;
        height: 1.5em;
        border-radius: 4px;
        background: linear-gradient(180deg, var(--ys-blue), var(--ys-red));
    }

    .sec-sub { margin: .2rem 0 0 1.05rem; color: #64748b; font-size: .88rem; }

    .sec-link {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .5rem 1.1rem;
        border-radius: 50rem;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        color: var(--ys-blue);
        font-weight: 800;
        font-size: .9rem;
        text-decoration: none;
        white-space: nowrap;
        transition: all .25s ease;
    }

    .sec-link i { transition: transform .25s; }

    .sec-link:hover {
        border-color: var(--ys-blue);
        box-shadow: 0 6px 15px rgba(13, 110, 253, .15);
        transform: translateY(-2px);
        color: var(--ys-blue);
    }

    .sec-link:hover i { transform: translateX(4px); }

    .cq-1 { --cat: #1a80da; }
    .cq-2 { --cat: #e0486c; }
    .cq-3 { --cat: #6b8a36; }
    .cq-4 { --cat: #ff9100; }

    .category-quick-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .75rem;
        text-align: center;
        height: 100%;
        padding: 1.1rem .8rem;
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 22px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04);
        transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .category-quick-card:hover {
        transform: translateY(-6px);
        border-color: var(--cat);
        box-shadow: 0 16px 30px color-mix(in srgb, var(--cat) 22%, transparent);
    }

    .cat-img {
        flex: 0 0 auto;
        width: 76px;
        height: 76px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--cat);
        padding: 3px;
        background: #fff;
        transition: transform .4s cubic-bezier(.34, 1.56, .64, 1);
    }

    .category-quick-card:hover .cat-img { transform: scale(1.1) rotate(-4deg); }

    .cat-name { font-weight: 800; color: var(--ys-ink); line-height: 1.2; }
    .cat-desc { font-size: .8rem; font-weight: 600; color: #64748b; line-height: 1.35; }

    .cat-go {
        color: var(--cat);
        transition: transform .25s ease;
        display: inline-block;
    }

    .category-quick-card:hover .cat-go { transform: translateX(5px); }

    @media (min-width: 992px) {
        .category-quick-card {
            flex-direction: row;
            text-align: left;
            padding: 1rem 1.1rem;
            gap: 1rem;
        }

        .cat-img { width: 68px; height: 68px; }
    }
    .home-product-card {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 22px;
        overflow: hidden;
        transition: all .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .home-product-card:hover {
        transform: translateY(-8px);
        border-color: rgba(13, 110, 253, .3);
        box-shadow: 0 20px 35px rgba(13, 110, 253, .13);
    }

    .home-thumb-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 190px;
        margin: 12px;
        padding: 16px;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(145deg, #f8fafc, #edf2f7);
    }

    .home-thumb-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, .06));
        transition: transform .4s ease, filter .4s ease;
    }

    .home-product-card:hover .home-thumb-img {
        transform: scale(1.08) translateY(-4px);
        filter: drop-shadow(0 10px 15px rgba(0, 0, 0, .12));
    }

    .badge-new-lightning {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: .25rem;
        padding: .35rem .75rem;
        border-radius: 50rem;
        background: linear-gradient(135deg, #dc3545, #b02a37);
        box-shadow: 0 4px 10px rgba(220, 53, 69, .3);
        color: #fff;
        font-size: .75rem;
        font-weight: 700;
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .price-row { display: flex; align-items: baseline; gap: .3rem; margin-bottom: .85rem; }
    .price-num { font-size: 1.3rem; font-weight: 900; color: var(--ys-blue); letter-spacing: -.3px; }
    .price-cur { font-size: .8rem; font-weight: 800; color: var(--ys-blue); opacity: .8; }

    .btn-action-view {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .4rem;
        padding: .6rem;
        border: 0;
        border-radius: 12px;
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        color: #fff;
        font-size: .9rem;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(13, 110, 253, .25);
        transition: all .25s ease;
    }

    .btn-action-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, .4);
        color: #fff;
    }
    .benefits-bar {
        background: #fff;
        border: 1px solid var(--ys-line);
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .03);
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: .9rem;
        padding: .4rem .5rem;
        border-radius: 16px;
        transition: background .25s ease, transform .25s ease;
    }

    .benefit-item:hover { background: #f1f6ff; transform: translateY(-2px); }

    .benefit-ico {
        flex: 0 0 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(13, 110, 253, .1);
        transition: transform .5s cubic-bezier(.34, 1.56, .64, 1);
    }

    .benefit-item:hover .benefit-ico { transform: rotateY(360deg) scale(1.08); }
    .footer-section {
        margin-top: 3rem;
        padding-top: 3rem;
        background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
        color: #f8fafc;
        border-top-left-radius: 32px;
        border-top-right-radius: 32px;
    }

    .footer-brand {
        font-weight: 900;
        font-size: clamp(2rem, 1.5rem + 2vw, 2.8rem);
        letter-spacing: -1px;
        line-height: 1.1;
        margin: 0;
    }

    .social-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .12);
        color: #fff;
        text-decoration: none;
        transition: all .3s ease;
    }

    .social-link-btn:hover {
        background: #0d6efd;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, .4);
    }

    .phone-link-btn {
        color: #cbd5e1;
        text-decoration: none;
        transition: color .2s ease, transform .2s ease;
        display: inline-block;
    }

    .phone-link-btn:hover { color: #60a5fa; transform: translateX(3px); }

    @media (prefers-reduced-motion: reduce) {
        .js-reveal .reveal { opacity: 1; transform: none; transition: none; }
    }
</style>

<div class="py-2">
    <div class="container-lg my-4 my-lg-5">
        <div class="sec-head reveal">
            <h2 class="sec-title">Kategoriýalar</h2>
        </div>

        @php
            $quickCats = [
                ['id' => 1, 'color' => '#1a80da', 'img' => 'img/boy.jpg', 'alt' => 'Saglyk', 'name' => __('app.cat2'), 'desc' => 'Saglyk we gözelik harytlary'],
                ['id' => 2, 'color' => '#e0486c', 'img' => 'img/PiuPiu Teddy Bear 🧸 _ Cozy Friend for Every Nap.jpg', 'alt' => 'Çagalar', 'name' => __('app.cat4'), 'desc' => 'Çagalaryňyzyň sagdyn ösmegi'],
                ['id' => 3, 'color' => '#6b8a36', 'img' => 'img/3d modern house or home isometric modern building and architecture.jpg', 'alt' => 'Öý hojalyk', 'name' => __('app.cat1'), 'desc' => 'Rahatlyk siziň öýüňizde'],
                ['id' => 4, 'color' => '#ff9100', 'img' => 'img/Muscle forge.jpg', 'alt' => 'Sport', 'name' => __('app.cat3'), 'desc' => 'Jan saglygym baş baýlygym'],
            ];
        @endphp

        <div class="row g-3">
            @foreach($quickCats as $c)
            <div class="col-6 col-lg-3 reveal" data-d="{{ $loop->index * 80 }}">
                <a href="{{ route('categories.show', $c['id']) }}" class="text-decoration-none d-block h-100">
                    <div class="category-quick-card cq-{{ $c['id'] }}">
                        <img src="{{ asset($c['img']) }}" alt="{{ $c['alt'] }}" class="cat-img" loading="lazy">
                        <div>
                            <div class="cat-name">{{ $c['name'] }}</div>
                            <div class="cat-desc mt-1">
                                {{ $c['desc'] }}
                                <i class="bi bi-arrow-right cat-go ms-1"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container-lg my-5">
        <div class="sec-head reveal">
            <div>
                <h2 class="sec-title"><i class="bi bi-stars text-warning"></i>{{ __('app.news') }}</h2>
                <p class="sec-sub">{{ __('app.news1') }}</p>
            </div>
            <a href="{{ route('products.index') }}" class="sec-link">
                {{ __('app.view_all') }} <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-3 g-md-4">
            @forelse($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3 reveal" data-d="{{ ($loop->index % 4) * 70 }}">
                <div class="home-product-card">
                    <span class="badge-new-lightning">
                        <i class="bi bi-lightning-fill"></i>{{ __('app.news') }}
                    </span>

                    <div>
                        <div class="home-thumb-wrapper">
                            @if($product->image && file_exists(public_path('img/' . $product->image)))
                            <img src="{{ asset('img/' . $product->image) }}" class="home-thumb-img" alt="{{ $product->name }}" loading="lazy">
                            @elseif($product->image && file_exists(public_path($product->image)))
                            <img src="{{ asset($product->image) }}" class="home-thumb-img" alt="{{ $product->name }}" loading="lazy">
                            @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                            <img src="{{ asset('storage/' . $product->image) }}" class="home-thumb-img" alt="{{ $product->name }}" loading="lazy">
                            @else
                            <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="home-thumb-img" alt="No Image" loading="lazy">
                            @endif
                        </div>

                        <div class="px-3 pt-2">
                            <h3 class="fw-bold text-dark fs-6 text-truncate mb-1" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h3>
                            <p class="text-muted text-truncate-2 mb-0" style="font-size: .82rem; line-height: 1.4;">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>

                    <div class="p-3 pt-2">
                        <div class="price-row">
                            <span class="price-num">{{ number_format($product->price, 0, ',', ' ') }}</span>
                            <span class="price-cur">TMT</span>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('products.show', $product->id) }}" class="btn-action-view">
                                <i class="bi bi-eye"></i> {{ __('app.view') }}
                            </a>

                            @if(session()->has('cart.'.$product->id))
                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm rounded-3 w-100 fw-bold disabled py-2 d-flex align-items-center justify-content-center gap-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Goşuldy</span>
                                </button>
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3 py-2 px-3" title="Sebetden poz">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted fw-bold">
                Täze harytlar ýok
            </div>
            @endforelse
        </div>
    </div>
    <div class="container-lg my-5">
        <div class="benefits-bar reveal">
            <div class="row g-3">
                @php
                    $benefits = [
                        ['icon' => 'iconimg/local_shipping_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png', 'alt' => 'Shipping', 'title' => 'Tiz eltmek', 'sub' => 'Bütin Türkmenistan'],
                        ['icon' => 'iconimg/health_and_safety_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png', 'alt' => 'Safety', 'title' => 'Garantiýa hilline', 'sub' => 'Barlagdan geçirilen'],
                        ['icon' => 'iconimg/percent_discount_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png', 'alt' => 'Discount', 'title' => 'Arzanlaşyk', 'sub' => 'Hemişeki müşderimize'],
                        ['icon' => 'iconimg/local_convenience_store_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png', 'alt' => 'Service', 'title' => 'Hyzmat 24/7', 'sub' => 'Hemişe siziň hyzmatyňyzda'],
                    ];
                @endphp

                @foreach($benefits as $b)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="benefit-item">
                        <div class="benefit-ico">
                            <img src="{{ asset($b['icon']) }}" style="width: 28px;" alt="{{ $b['alt'] }}" loading="lazy">
                        </div>
                        <div>
                            <div class="fw-bold text-dark h6 mb-0">{{ $b['title'] }}</div>
                            <div class="small text-primary fw-semibold">{{ $b['sub'] }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<footer class="footer-section pb-4">
    <div class="container-lg">
        <div class="row g-4 align-items-center border-bottom border-secondary border-opacity-25 pb-4">

            <div class="col-12 col-md-4 text-center text-md-start">
                <div class="footer-brand"><span class="text-white">yslam</span> <span style="color: #ff5c6c;">shop</span></div>
                <p class="text-secondary small mb-0 mt-1">Siziň ygtybarly onlaýn dükaniňyz</p>
            </div>

            <div class="col-12 col-md-4 text-center">
                <div class="d-flex flex-column gap-2 align-items-center">
                    <a href="tel:+99361908091" class="phone-link-btn fw-bold fs-5">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>+993 61 908091
                    </a>
                    <a href="tel:+99365538177" class="phone-link-btn fw-bold fs-5">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>+993 65 538177
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-4 text-center text-md-end">
                <div class="d-inline-flex flex-wrap gap-2 justify-content-center justify-content-md-end">
                    <a href="https://www.tiktok.com/@yslam.shop.china" target="_blank" rel="noopener" class="social-link-btn fw-bold">
                        <i class="bi bi-tiktok text-danger fs-5"></i>
                        <span>yslam.shop.china</span>
                    </a>
                    <a href="https://www.instagram.com/yslam_shop_china" target="_blank" rel="noopener" class="social-link-btn fw-bold">
                        <i class="bi bi-instagram text-warning fs-5"></i>
                        <span>yslam_shop_china</span>
                    </a>
                </div>
            </div>

        </div>

        <div class="pt-4 text-center">
            <p class="text-secondary small mb-0">
                &copy; {{ date('Y') }} <span class="fw-bold text-white">yslam shop</span>. Ähli hukuklar goralan.
            </p>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.reveal');
        items.forEach(el => { if (el.dataset.d) el.style.setProperty('--d', el.dataset.d + 'ms'); });

        if (!('IntersectionObserver' in window)) {
            items.forEach(el => el.classList.add('in'));
            return;
        }

        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        items.forEach(el => io.observe(el));
    });
</script>

@include('client.app.modal')
@endsection