@extends('client.layouts.header')

@section('title', $product->name)

@section('content')
<div class="container-lg py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="text-decoration-none">Baş sahypa</a></li>
            @if($product->category)
            <li class="breadcrumb-item">
                <a href="{{ route('categories.show', $product->category->id) }}" class="text-decoration-none">
                    {{ $product->category->name }}
                </a>
            </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-3 p-md-4 mb-5">
        <div class="row g-4 align-items-center">

            
            <div class="col-md-6 text-center">
                <div class="bg-light rounded-4 p-4 d-flex align-items-center justify-content-center" style="min-height: 350px;">
                    <div class="bg-light rounded-4 p-4 d-flex align-items-center justify-content-center" style="min-height: 350px;">
                        @if($product->image && file_exists(public_path($product->image)))
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded-3" alt="{{ $product->name }}" style="max-height: 380px; object-fit: contain;">
                        @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-3" alt="{{ $product->name }}" style="max-height: 380px; object-fit: contain;">
                        @else
                        <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="img-fluid rounded-3" alt="No Image" style="max-height: 380px; object-fit: contain;">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    @if($product->category)
                    <a href="{{ route('categories.show', $product->category->id) }}" class="badge bg-danger text-decoration-none mb-2 px-3 py-2 fs-6">
                        {{ $product->category->name }}
                    </a>
                    @endif
                    <h1 class="fw-bold text-dark display-6 mb-3">{{ $product->name }}</h1>
                    <div class="mb-4">
                        <p class="text-muted fs-5 lh-base">
                            {{ $product->description ?? 'Barada maglumat ýok' }}
                        </p>
                    </div>
                </div>

                <div>
                    <div class="d-flex align-items-baseline mb-4">
                        <span class="fw-bold display-5 text-primary me-2">
                            {{ number_format($product->price, 0, ',', ' ') }}
                        </span>
                        <span class="fw-bold fs-3 text-primary">TMT</span>
                    </div>
                    <div class="row g-2">
                        <div class="col-9 col-sm-10">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 w-100 fw-bold py-3">
                                    <i class="bi bi-cart-plus me-2 fs-5"></i> Sebede goş
                                </button>
                            </form>
                        </div>
                        <div class="col-3 col-sm-2">
                            <button class="btn btn-outline-danger btn-lg rounded-3 w-100 py-3" title="Halanlara goş">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row g-3 mt-4 pt-3 border-top text-center text-md-start">
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-truck text-primary fs-3 me-2"></i>
                                <span class="small fw-semibold text-muted">Tiz eltip bermek</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-check text-success fs-3 me-2"></i>
                                <span class="small fw-semibold text-muted">Kepillik bar</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection