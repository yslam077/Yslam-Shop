<div class="container-fluid px-2 px-md-4 px-lg-5 mt-3 mt-lg-4">
    <section id="banner" class="splide" aria-label="Баннеры">
        <div class="splide__track rounded-4 rounded-lg-5">
            <ul class="splide__list">
                <li class="splide__slide">
                    <a href="{{ route('categories.show', 1) }}" class="text-decoration-none d-block">
                        <div class="d-flex flex-row align-items-center w-100 rounded-4 rounded-lg-5 p-4 p-md-5" style="background-color: #FBFBFC; min-height: 350px;">
                            <div class="col-7 ps-2 ps-md-4">
                                <div class="w-auto d-inline-block px-3 fw-bold fs-6 fs-md-5 py-1 rounded-pill text-light mb-3" style="background-color: #1a80da;">
                                    {{ __('app.cat2') }}
                                </div>
                                <div class="text-dark fw-bold fs-3 fs-md-1 mb-3">
                                    Iň gowsy siziň<br>Saglygyňyz üçin
                                </div>
                                <div class="d-none d-sm-block mt-2 fs-6 fs-md-5 fw-bold mb-4" style="color: #004a8a;">
                                    Dyzlyklar, guşaklar, kremler saglygyňyzy goramak üçin<br class="d-none d-md-inline">sagdyn we rahatlygy
                                </div>
                                <div class="d-flex mt-2">
                                    <span class="btn text-light px-4 fw-bolder py-2" style="background-color: #1a80da;">
                                        {{ __('app.view') }} <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-5 text-center text-md-end">
                                <img src="{{ asset('img/Polish_20260628_140003723.png') }}" alt="Saglyk we Gözelik" class="img-fluid rounded-4" style="max-height: 320px; width: auto; object-fit: contain;">
                            </div>
                        </div>
                    </a>
                </li>
                <li class="splide__slide">
                    <a href="{{ route('categories.show', 2) }}" class="text-decoration-none d-block">
                        <div class="d-flex flex-row align-items-center w-100 rounded-4 rounded-lg-5 p-4 p-md-5" style="background-color: #FBFBFC; min-height: 350px;">
                            <div class="col-7 ps-2 ps-md-4">
                                <div class="w-auto d-inline-block px-3 fw-bold fs-6 fs-md-5 py-1 rounded-pill text-light mb-3" style="background-color: #ff799daf;">
                                    <i class="bi bi-heart-fill me-2" style="color: #ff5e84;"></i>{{ __('app.cat4') }}
                                </div>
                                <div class="text-dark fw-bold fs-3 fs-md-1 mb-3">
                                    Iň gowsy siziň<br> çagalaryňyz üçin
                                </div>
                                <div class="d-none d-sm-block mt-2 fs-6 fs-md-5 fw-bold mb-4" style="color: #F37E9A;">
                                    Ýasyklar, sumkalar, saglygy goramak üçin<br class="d-none d-md-inline">çagalaryň sagdyn ösmegine we ene-ataň rahatlygy
                                </div>
                                <div class="d-flex mt-2">
                                    <span class="btn text-light px-4 fw-bolder py-2" style="background-color: #F37E9A;">
                                        {{ __('app.view') }} <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-5 text-center text-md-end">
                                <img src="{{ asset('img/miska.png') }}" alt="Çagalar üçin" class="img-fluid rounded-4" style="max-height: 320px; width: auto; object-fit: contain;">
                            </div>
                        </div>
                    </a>
                </li>
                <li class="splide__slide">
                    <a href="{{ route('categories.show', 3) }}" class="text-decoration-none d-block">
                        <div class="d-flex flex-row align-items-center w-100 rounded-4 rounded-lg-5 p-4 p-md-5" style="background-color: #E3F2D1; min-height: 350px;">
                            <div class="col-7 ps-2 ps-md-4">
                                <div class="w-auto d-inline-block px-3 fw-bold fs-6 fs-md-5 py-1 rounded-pill text-light mb-3" style="background-color: #ACC47A;">
                                    <i class="bi bi-house-fill me-2" style="color: #E3F2D1;"></i>{{ __('app.cat1') }}
                                </div>
                                <div class="text-dark fw-bold fs-3 fs-md-1 mb-3">
                                    Rahatlyk we Komfort<br>siziň öýüňizde
                                </div>
                                <div class="d-none d-sm-block mt-2 fs-6 fs-md-5 fw-bold mb-4" style="color: #ACC47A;">
                                    Polkalar, Weşilkalar we birnäçe<br class="d-none d-md-inline">öý hojalyk harytlary
                                </div>
                                <div class="d-flex mt-2">
                                    <span class="btn text-light px-4 fw-bolder py-2" style="background-color: #ACC47A;">
                                        {{ __('app.view') }} <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-5 text-center text-md-end">
                                <img src="{{ asset('img/Polish_20260628_140016500.png') }}" alt="Öý hojalyk" class="img-fluid rounded-4" style="max-height: 320px; width: auto; object-fit: contain;">
                            </div>
                        </div>
                    </a>
                </li>
                <li class="splide__slide">
                    <a href="{{ route('categories.show', 4) }}" class="text-decoration-none d-block">
                        <div class="d-flex flex-row align-items-center w-100 rounded-4 rounded-lg-5 p-4 p-md-5" style="background-color: #000000; min-height: 350px;">
                            <div class="col-7 ps-2 ps-md-4">
                                <div class="w-auto d-inline-block px-3 fw-bold fs-6 fs-md-5 py-1 rounded-pill text-light mb-3" style="background-color: #ff9100;">
                                    {{ __('app.cat3') }}
                                </div>
                                <div class="text-light fw-bold fs-3 fs-md-1 mb-3">
                                    Sport harytlar<br>siziň üçin
                                </div>
                                <div class="d-none d-sm-block mt-2 fs-6 fs-md-5 fw-bold mb-4" style="color: #ff9100;">
                                    Sport harytlar, sport egin eşikler birnäçe<br class="d-none d-md-inline">sport harytlary
                                </div>
                                <div class="d-flex mt-2">
                                    <span class="btn text-light px-4 fw-bolder py-2" style="background-color: #ff9100;">
                                        {{ __('app.view') }} <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-5 text-center text-md-end">
                                <img src="{{ asset('img/Muscle forge.jpg') }}" alt="Sport harytlary" class="img-fluid rounded-4" style="max-height: 320px; width: auto; object-fit: contain;">
                            </div>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </section>
</div>