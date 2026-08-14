@extends('client.layouts.header')

@section('content')
<div class="container-lg py-4">

    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <div>
            <h1 class="fw-bold text-primary display-6 mb-1">{{ $category->name }}</h1>
            <p class="text-muted m-0">Найдено товаров: {{ $category->products->count() }}</p>
        </div>
        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> {{ __('Baş sahypa') }}
        </a>
    </div>

    <div class="row g-4">
        @forelse($category->products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
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

                            @php
                            $cart = session('cart', []);
                            $inCart = isset($cart[$product->id]) && (
                            (is_array($cart[$product->id]) && ($cart[$product->id]['quantity'] ?? 0) > 0) ||
                            (!is_array($cart[$product->id]) && (int)$cart[$product->id] > 0)
                            );
                            @endphp

                            @if($inCart)
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
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm rounded-3 w-100 fw-bold">
                                    <i class="bi bi-cart-plus me-1"></i> Sebede goş
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="bi bi-box-seam display-1 text-muted"></i>
            </div>
            <h4 class="fw-bold text-secondary">Suwagtlykca harytlar yok elimizde</h4>
            <p class="text-muted">Sonra gelip girayin</p>
            <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                Bas Sahypa
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection