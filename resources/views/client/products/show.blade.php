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
                    @if($product->image && file_exists(public_path($product->image)))
                    <img src="{{ asset($product->image) }}" class="img-fluid rounded-3" alt="{{ $product->name }}" style="max-height: 380px; object-fit: contain;">
                    @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-3" alt="{{ $product->name }}" style="max-height: 380px; object-fit: contain;">
                    @else
                    <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="img-fluid rounded-3" alt="No Image" style="max-height: 380px; object-fit: contain;">
                    @endif
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
                    @php
                    $cart = session()->get('cart', []);
                    $inCart = isset($cart[$product->id]);
                    $currentQty = $inCart ? $cart[$product->id]['quantity'] : 1;
                    $unitPrice = $product->price;
                    $totalPrice = $unitPrice * $currentQty;
                    @endphp

                    <div class="d-flex align-items-baseline mb-4" id="price-container" data-unit-price="{{ $unitPrice }}">
                        <span class="fw-bold display-5 text-primary me-2" id="product-total-price">
                            {{ number_format($totalPrice, 0, ',', ' ') }}
                        </span>
                        <span class="fw-bold fs-3 text-primary">TMT</span>
                    </div>

                    <div class="row g-2">
                        <div class="col-9 col-sm-10" id="cart-control-container" data-product-id="{{ $product->id }}">

                            <button id="add-to-cart-btn" class="btn btn-primary btn-lg rounded-3 w-100 fw-bold py-3 {{ $inCart ? 'd-none' : '' }}">
                                <i class="bi bi-cart-plus me-2 fs-5"></i> Sebede goş
                            </button>

                            <div id="quantity-control-block" class="d-flex align-items-center gap-2 {{ !$inCart ? 'd-none' : '' }}">
                                <div class="input-group input-group-lg flex-grow-1">
                                    <button class="btn btn-outline-primary fw-bold fs-4 px-3 py-2" type="button" id="btn-minus">-</button>
                                    <span class="form-control text-center fw-bold fs-4 bg-white d-flex align-items-center justify-content-center py-2" id="qty-number">
                                        {{ $currentQty }}
                                    </span>
                                    <button class="btn btn-outline-primary fw-bold fs-4 px-3 py-2" type="button" id="btn-plus">+</button>
                                </div>

                                <button class="btn btn-outline-danger btn-lg p-3 rounded-3" type="button" id="btn-delete" title="Sebetden poz">
                                    <i class="bi bi-trash3-fill fs-4"></i>
                                </button>
                            </div>

                        </div>

                        <div class="col-3 col-sm-2">
                            <button class="btn btn-outline-danger btn-lg rounded-3 w-100 py-3" title="Halanlara goş">
                                <i class="bi bi-heart-fill fs-5"></i>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('cart-control-container');
        if (!container) return;

        const productId = container.dataset.productId;
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const quantityBlock = document.getElementById('quantity-control-block');
        const qtyNumber = document.getElementById('qty-number');
        const btnPlus = document.getElementById('btn-plus');
        const btnMinus = document.getElementById('btn-minus');
        const btnDelete = document.getElementById('btn-delete');

        const priceContainer = document.getElementById('price-container');
        const priceDisplay = document.getElementById('product-total-price');
        const unitPrice = parseFloat(priceContainer.dataset.unitPrice) || 0;

        let currentQuantity = parseInt(qtyNumber.textContent.trim()) || 1;
        let updateTimeout = null; 

        function formatPrice(amount) {
            return new Intl.NumberFormat('ru-RU').format(amount);
        }

        function updatePriceUI(qty) {
            const displayQty = qty > 0 ? qty : 1;
            const total = unitPrice * displayQty;
            priceDisplay.textContent = formatPrice(total);
        }

        function debouncedCartUpdate(qty) {
            clearTimeout(updateTimeout);
            updateTimeout = setTimeout(() => {
                sendCartUpdate(qty);
            }, 300); 
        }

        function sendCartUpdate(qty) {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch(`/cart/ajax-add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        quantity: qty
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка сервера: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Успешно сохранено в сессию:', data);

                    if (data.cart_count !== undefined) {
  
                        const badge = document.getElementById('cart-badge-count');
                        if (badge) {
                            badge.textContent = data.cart_count;
                            if (data.cart_count > 0) {
                                badge.classList.remove('d-none');
                            } else {
                                badge.classList.add('d-none');
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Ошибка отправки в корзину:', error);
                });
        }

        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            addToCartBtn.classList.add('d-none');
            quantityBlock.classList.remove('d-none');

            currentQuantity = 1;
            qtyNumber.textContent = 1;

            updatePriceUI(1);
            debouncedCartUpdate(1);
        });

        btnPlus.addEventListener('click', function() {
            currentQuantity++;
            qtyNumber.textContent = currentQuantity;
            updatePriceUI(currentQuantity);
            debouncedCartUpdate(currentQuantity);
        });

        btnMinus.addEventListener('click', function() {
            if (currentQuantity > 1) {
                currentQuantity--;
                qtyNumber.textContent = currentQuantity;
                updatePriceUI(currentQuantity);
                debouncedCartUpdate(currentQuantity);
            } else {
                quantityBlock.classList.add('d-none');
                addToCartBtn.classList.remove('d-none');
                currentQuantity = 1;
                qtyNumber.textContent = 1;
                updatePriceUI(1);
                debouncedCartUpdate(0);
            }
        });

        btnDelete.addEventListener('click', function() {
            quantityBlock.classList.add('d-none');
            addToCartBtn.classList.remove('d-none');
            currentQuantity = 1;
            qtyNumber.textContent = 1;
            updatePriceUI(1);
            debouncedCartUpdate(0);
        });
    });
</script>
@endsection