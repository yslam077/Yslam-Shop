@extends('client.layouts.header')
@section('content')
@include('client.app.splide')
<div data-aos="fade-down" data-aos-delay="200">
    <div class="container-lg my-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-stars text-warning me-2"></i>Täze gelen harytlar
                </h3>
                <p class="text-muted small m-0">Iň soňky goşulan täze harytlar bilen tanyş babyň</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                Ählisini gör <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($latestProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">

                    
                    <span class="position-absolute top-0 start-0 badge bg-danger m-3 px-2 py-1 rounded-pill z-1">
                        <i class="bi bi-lightning-fill me-1"></i>Täze
                    </span>

                    
                    <div class="position-relative text-center p-3 bg-light">
                        @if($product->image && file_exists(public_path('img/' . $product->image)))
                        <img src="{{ asset('img/' . $product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 180px; object-fit: contain;">
                        @elseif($product->image && file_exists(public_path($product->image)))
                        <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 180px; object-fit: contain;">
                        @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="height: 180px; object-fit: contain;">
                        @else
                        <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="card-img-top img-fluid" alt="No Image" style="height: 180px; object-fit: contain;">
                        @endif
                    </div>

                    
                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <div>
                            <h5 class="card-title fw-bold text-dark h6 text-truncate" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text text-muted small text-truncate-2" style="font-size: 0.85rem;">
                                {{ $product->description }}
                            </p>
                        </div>

                        <div class="mt-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold text-primary h5 mb-0">{{ number_format($product->price, 0, ',', ' ') }} TMT</span>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm rounded-3 fw-bold">
                                    Görmek
                                </a>

                                
                                @if(session()->has('cart.'.$product->id))
                                <div class="d-flex gap-1">
                                    <button class="btn btn-success btn-sm rounded-3 w-100 fw-bold disabled">
                                        <i class="bi bi-check-circle-fill me-1"></i> Sebede goşuldy
                                    </button>
                                    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" title="Sebetden poz">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                                @else
                                <!-- <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold">
                                        <i class="bi bi-cart-plus me-1"></i> Sebede goş
                                    </button>
                                </form> -->
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4 text-muted">
                Täze harytlar ýok
            </div>
            @endforelse
        </div>
    </div>
    <div class="container-lg mt-3">
        <div class="row g-3">
            
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ route('categories.show', 1) }}" class="text-decoration-none h-100 d-block">
                    <div class="d-flex px-3 py-3 align-items-center rounded-4 h-100 border bg-white shadow-sm hover-shadow transition">
                        <div class="col-4">
                            <img src="{{ asset('img/boy.jpg') }}"
                                alt="Saglyk we gözelik" class="w-100 rounded-circle object-fit-cover" style="aspect-ratio: 1/1;">
                        </div>
                        <div class="col-8 ps-3">
                            <div class="text-dark fw-bolder h6 mb-1">Saglyk we gözelik</div>
                            <div class="text-secondary small fw-semibold">
                                Saglyk we gözelik harytlary<br>
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ route('categories.show', 2) }}" class="text-decoration-none h-100 d-block">
                    <div class="d-flex px-3 py-3 align-items-center rounded-4 h-100 border bg-white shadow-sm hover-shadow transition">
                        <div class="col-4">
                            <img src="{{ asset('img/PiuPiu Teddy Bear 🧸 _ Cozy Friend for Every Nap.jpg') }}"
                                alt="Çagalar üçin" class="w-100 rounded-circle object-fit-cover" style="aspect-ratio: 1/1;">
                        </div>
                        <div class="col-8 ps-3">
                            <div class="text-dark fw-bolder h6 mb-1">Çagalar üçin</div>
                            <div class="text-secondary small fw-semibold">
                                Çagalaryňyzyň sagdyn ösmegi<br>
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

           
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ route('categories.show', 3) }}" class="text-decoration-none h-100 d-block">
                    <div class="d-flex px-3 py-3 align-items-center rounded-4 h-100 border bg-white shadow-sm hover-shadow transition">
                        <div class="col-4">
                            <img src="{{ asset('img/3d modern house or home isometric modern building and architecture.jpg') }}"
                                alt="Öý hojalyk" class="w-100 rounded-circle object-fit-cover" style="aspect-ratio: 1/1;">
                        </div>
                        <div class="col-8 ps-3">
                            <div class="text-dark fw-bolder h6 mb-1">Öý hojalyk</div>
                            <div class="text-secondary small fw-semibold">
                                Rahatlyk siziň öýüňizde<br>
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ route('categories.show', 4) }}" class="text-decoration-none h-100 d-block">
                    <div class="d-flex px-3 py-3 align-items-center rounded-4 h-100 border bg-white shadow-sm hover-shadow transition">
                        <div class="col-4">
                            <img src="{{ asset('img/Muscle forge.jpg') }}"
                                alt="Sport harytlar" class="w-100 rounded-circle object-fit-cover" style="aspect-ratio: 1/1;">
                        </div>
                        <div class="col-8 ps-3">
                            <div class="text-dark fw-bolder h6 mb-1">Sport harytlar</div>
                            <div class="text-secondary small fw-semibold">
                                Jan saglygym baş baýlygym<br>
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container-lg rounded-3 mt-3" style="background-color: #F6F8FC;">
        <div class="d-flex pt-3 pb-3 ">
            <div class="col-3 ms-4">
                <div class="d-flex">
                    <div class="col-2 text-center p-1 bg-white rounded-circle"><img
                            src="{{ asset('./iconimg/local_shipping_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}"
                            class="text-primery mt-1" alt=""></div>
                    <div class="col-10 ms-2">
                        <div class="fw-bold h5">
                            Tiz eltmek
                            <div class="h6 text-primary">Bütin Türkmenistan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex">
                    <div class="col-2 text-center p-1 bg-white rounded-circle"><img
                            src="{{ asset('./iconimg/health_and_safety_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}"
                            class="text-primery mt-1" alt=""></div>
                    <div class="col-10 ms-2">
                        <div class="fw-bold h5">
                            Garantiýa hilline
                            <div class="h6 text-primary">Barlagdan geçirilen</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex">
                    <div class="col-2 text-center p-1 bg-white rounded-circle"><img
                            src="{{ asset('./iconimg/percent_discount_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}"
                            class="text-primery mt-1" alt=""></div>
                    <div class="col-10 ms-2">
                        <div class="fw-bold h5">
                            Arzanlaşyk
                            <div class="h6 text-primary">Hemişeki müşderimize</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex">
                    <div class="col-2 text-center p-1 bg-white rounded-circle"><img
                            src="{{ asset('./iconimg/local_convenience_store_34dp_5985E1_FILL0_wght400_GRAD0_opsz40.png') }}"
                            class="text-primery mt-1" alt=""></div>
                    <div class="col-10 ms-2">
                        <div class="fw-bold h5">
                            Hyzmat 24/7
                            <div class="h6 text-primary">Hemişe siziň hyzmatyňyzda</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('client.app.modal')
@include('client.app.offcanvas')
@endsection