@php
    // Her banner üçin maglumatlar: täze banner goşmak üçin diňe bir element goşuň
    $banners = [
        [
            'route' => 1, 'icon' => 'bi-shield-check', 'badge' => __('app.cat2'),
            'l1' => 'Iň gowsy siziň', 'l2' => 'Saglygyňyz üçin',
            'desc' => 'Dyzlyklar, guşaklar, kremler saglygyňyzy goramak üçin sagdyn we rahatlygy',
            'img' => 'img/Polish_20260628_140003723.png', 'alt' => 'Saglyk we Gözelik', 'imgClass' => 'banner-img-health',
            'theme' => 'health',
        ],
        [
            'route' => 2, 'icon' => 'bi-heart-fill', 'badge' => __('app.cat4'),
            'l1' => 'Iň gowsy siziň', 'l2' => 'Çagalaryňyz üçin',
            'desc' => 'Ýasyklar, sumkalar, saglygy goramak üçin çagalaryň sagdyn ösmegine we ene-ataň rahatlygy',
            'img' => 'img/miska.png', 'alt' => 'Çagalar üçin', 'imgClass' => '',
            'theme' => 'kids',
        ],
        [
            'route' => 3, 'icon' => 'bi-house-door-fill', 'badge' => __('app.cat1'),
            'l1' => 'Rahatlyk we Komfort', 'l2' => 'Siziň öýüňizde',
            'desc' => 'Polkalar, Weşilkalar we birnäçe öý hojalyk harytlary',
            'img' => 'img/Polish_20260628_140016500.png', 'alt' => 'Öý hojalyk', 'imgClass' => '',
            'theme' => 'home',
        ],
        [
            'route' => 4, 'icon' => 'bi-lightning-charge-fill', 'badge' => __('app.cat3'),
            'l1' => 'Sport harytlar', 'l2' => 'Siziň üçin',
            'desc' => 'Sport harytlar, sport egin eşikler birnäçe sport harytlary',
            'img' => 'img/Muscle forge.jpg', 'alt' => 'Sport harytlary', 'imgClass' => 'banner-img-sport',
            'theme' => 'sport',
        ],
    ];
@endphp

<style>
    .bn-theme-health {
        --bg1:#f4f8ff;
        --bg2:#e0edff;
        --line:rgba(26,128,218,.14);
        --c1:#1a80da;
        --c2:#0056b3;
        --accent:#1a80da;
        --glow:rgba(26,128,218,.35);
        --title:#0f172a;
        --text:#475569;
        --btn-text:#fff;
    }

    .bn-theme-kids {
        --bg1:#fff0f4;
        --bg2:#ffe0e8;
        --line:rgba(243,126,154,.2);
        --c1:#f37e9a;
        --c2:#e0486c;
        --accent:#e0486c;
        --glow:rgba(243,126,154,.4);
        --title:#0f172a;
        --text:#475569;
        --btn-text:#fff;
    }

    .bn-theme-home {
        --bg1:#f4f9ed;
        --bg2:#e3f2d1;
        --line:rgba(143,174,85,.25);
        --c1:#8fae55;
        --c2:#6b8a36;
        --accent:#6b8a36;
        --glow:rgba(143,174,85,.4);
        --title:#0f172a;
        --text:#475569;
        --btn-text:#fff;
    }

    .bn-theme-sport {
        --bg1:#18181b;
        --bg2:#09090b;
        --line:rgba(255,145,0,.25);
        --c1:#ff9100;
        --c2:#ff6c00;
        --accent:#ff9100;
        --glow:rgba(255,145,0,.4);
        --title:#ffffff;
        --text:#d4d4d8;
        --btn-text:#111;
    }

    .splide-banner-card {
        position: relative;
        overflow: hidden;
        min-height: 380px;
        border-radius: 28px;
        background: linear-gradient(135deg, var(--bg1), var(--bg2));
        border: 1px solid var(--line);
    }

    .splide-banner-card::before,
    .splide-banner-card::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: var(--c1);
        opacity: .13;
        pointer-events: none;
    }

    .splide-banner-card::before { width: 380px; height: 380px; right: -90px; top: -130px; }
    .splide-banner-card::after  { width: 190px; height: 190px; left: -60px; bottom: -80px; opacity: .09; }

    .banner-text { position: relative; z-index: 2; }

    .banner-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .38rem .95rem;
        margin-bottom: 1rem;
        border-radius: 50rem;
        font-size: .85rem;
        font-weight: 800;
        color: var(--btn-text);
        background: linear-gradient(135deg, var(--c1), var(--c2));
        box-shadow: 0 4px 12px var(--glow);
    }

    .banner-title {
        margin: 0 0 .9rem;
        font-weight: 900;
        line-height: 1.15;
        letter-spacing: -.5px;
        color: var(--title);
        font-size: clamp(1.4rem, 1rem + 2.2vw, 2.7rem);
    }

    .banner-title span { color: var(--accent); }

    .banner-desc {
        max-width: 36ch;
        margin: 0 0 1.4rem;
        font-size: 1.02rem;
        font-weight: 500;
        color: var(--text);
    }

    .banner-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: .75rem 1.8rem;
        border-radius: 50rem;
        font-weight: 800;
        letter-spacing: .3px;
        color: var(--btn-text);
        background: linear-gradient(135deg, var(--c1), var(--c2));
        box-shadow: 0 6px 16px var(--glow);
        transition: all .3s ease;
    }

    .splide__slide:hover .banner-btn {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px var(--glow);
    }

    .banner-btn i { transition: transform .3s ease; }
    .splide__slide:hover .banner-btn i { transform: translateX(5px); }

    .banner-img-wrapper {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .banner-img {
        max-height: 310px;
        width: auto;
        max-width: 100%;
        object-fit: contain;
        transition: transform .5s cubic-bezier(.16, 1, .3, 1);
        animation: bannerFloat 5s ease-in-out infinite;
    }

    .banner-img-health {
        border-radius: 20px;
        box-shadow: 0 12px 28px rgba(0, 0, 0, .1);
    }

    .banner-img-sport {
        border-radius: 24px;
        box-shadow: 0 14px 32px rgba(0, 0, 0, .55);
        border: 2px solid rgba(255, 145, 0, .35);
    }

    .splide__slide:hover .banner-img { transform: scale(1.05); }

    @keyframes bannerFloat {
        0%, 100% { translate: 0 0; }
        50%      { translate: 0 -8px; }
    }

    .splide.is-initialized .splide__slide:not(.is-visible) .bn-anim,
    .splide.is-initialized .splide__slide:not(.is-visible) .banner-img-wrapper { opacity: 0; }

    .splide.is-initialized .splide__slide.is-active .bn-anim {
        animation: bnUp .7s cubic-bezier(.16, 1, .3, 1) both;
        animation-delay: calc(var(--i, 0) * .09s + .1s);
    }

    .splide.is-initialized .splide__slide.is-active .banner-img-wrapper {
        animation: bnPop .9s .25s cubic-bezier(.34, 1.4, .64, 1) both;
    }

    @keyframes bnUp  { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
    @keyframes bnPop { from { opacity: 0; transform: scale(.85) translateX(24px); } to { opacity: 1; transform: none; } }

    #banner .splide__arrows { display: none !important; }

    #banner .splide__pagination {
        position: static;
        padding: 0;
        margin-top: 14px;
        justify-content: center;
        gap: 6px;
    }

    #banner .splide__pagination li { line-height: 0; }

    #banner .splide__pagination__page {
        width: 8px;
        height: 8px;
        margin: 0;
        border-radius: 50rem;
        background: #cbd5e1;
        opacity: 1;
        transform: none;
        transition: all .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    #banner .splide__pagination__page.is-active {
        width: 28px;
        background: #0d6efd;
    }
    @media (max-width: 767.98px) {
        .splide-banner-card {
            min-height: auto;
            padding: 1.25rem 1rem !important;
            border-radius: 20px;
        }

        .splide-banner-card::before { width: 240px; height: 240px; right: -80px; top: -90px; }

        .banner-chip { font-size: .75rem; padding: .3rem .75rem; margin-bottom: .7rem; }
        .banner-title { margin-bottom: .8rem; }
        .banner-img { max-height: 165px; }

        .banner-btn {
            padding: .5rem 1.15rem;
            font-size: .85rem;
        }

        .container-fluid.mt-3 { margin-top: .5rem !important; }
    }

    @media (prefers-reduced-motion: reduce) {
        .banner-img { animation: none; }
        .splide.is-initialized .splide__slide .bn-anim,
        .splide.is-initialized .splide__slide .banner-img-wrapper { opacity: 1 !important; animation: none !important; }
    }
</style>

<div class="container-fluid px-2 px-md-4 px-lg-5 mt-3 mt-lg-4">
    <section id="banner" class="splide" aria-label="Banners">
        <div class="splide__track rounded-4 shadow-sm">
            <ul class="splide__list">

                @foreach ($banners as $b)
                <li class="splide__slide">
                    <a href="{{ route('categories.show', $b['route']) }}" class="text-decoration-none d-block" aria-label="{{ $b['badge'] }}">
                        <div class="d-flex flex-row align-items-center w-100 p-4 p-md-5 splide-banner-card bn-theme-{{ $b['theme'] }}">

                            <div class="col-7 ps-2 ps-md-4 banner-text">
                                <div class="banner-chip bn-anim" style="--i:0">
                                    <i class="bi {{ $b['icon'] }}"></i> {{ $b['badge'] }}
                                </div>

                                <h2 class="banner-title bn-anim" style="--i:1">
                                    {{ $b['l1'] }}<br><span>{{ $b['l2'] }}</span>
                                </h2>

                                <p class="banner-desc d-none d-sm-block bn-anim" style="--i:2">{{ $b['desc'] }}</p>

                                <div class="bn-anim" style="--i:3">
                                    <span class="banner-btn">
                                        {{ __('app.view') }} <i class="bi bi-arrow-right-circle-fill fs-5"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-5 text-center text-md-end banner-img-wrapper">
                                <img src="{{ asset($b['img']) }}" alt="{{ $b['alt'] }}"
                                    class="banner-img {{ $b['imgClass'] }} img-fluid"
                                    loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                            </div>

                        </div>
                    </a>
                </li>
                @endforeach

            </ul>
        </div>
    </section>
</div>