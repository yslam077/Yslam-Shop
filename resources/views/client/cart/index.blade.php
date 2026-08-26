@extends('client.layouts.header')

@section('title', 'Sebet')

@section('content')
<div class="container-lg py-3 py-md-4">
    @php
    $totalItemsCount = array_sum(array_column($cart, 'quantity'));
    @endphp

    <h3 class="fw-bold mb-3 mb-md-4 fs-4 fs-md-2">
        <i class="bi bi-cart3 text-primary me-2"></i>Sebet (<span id="cart-total-count">{{ $totalItemsCount }}</span>)
    </h3>

    @if(count($cart) > 0)
    <div class="row g-3 g-lg-4" id="cart-content">

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-2 p-md-3 mb-3">
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="border-bottom text-muted small">
                            <tr>
                                <th scope="col">Haryt</th>
                                <th scope="col" class="text-center">Sany</th>
                                <th scope="col" class="text-end">Baha</th>
                                <th scope="col" class="text-center">Pozmak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                            <tr class="border-bottom cart-item-row" id="cart-row-{{ $id }}" data-price="{{ $details['price'] }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-3 p-2 me-3" style="width: 65px; height: 65px; flex-shrink: 0;">
                                            @if(isset($details['image']) && file_exists(public_path($details['image'])))
                                            <img src="{{ asset($details['image']) }}" class="img-fluid h-100 w-100" style="object-fit: contain;" alt="">
                                            @elseif(isset($details['image']) && file_exists(public_path('storage/' . $details['image'])))
                                            <img src="{{ asset('storage/' . $details['image']) }}" class="img-fluid h-100 w-100" style="object-fit: contain;" alt="">
                                            @else
                                            <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="img-fluid h-100 w-100" style="object-fit: contain;" alt="">
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">{{ $details['name'] }}</h6>
                                            <span class="text-muted small">{{ number_format($details['price'], 0, ',', ' ') }} TMT</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center" style="width: 140px;">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary fw-bold btn-minus" type="button" data-id="{{ $id }}">-</button>
                                        <span class="form-control text-center fw-bold bg-white d-flex align-items-center justify-content-center qty-number" id="qty-{{ $id }}">
                                            {{ $details['quantity'] }}
                                        </span>
                                        <button class="btn btn-outline-secondary fw-bold btn-plus" type="button" data-id="{{ $id }}">+</button>
                                    </div>
                                </td>
                                <td class="text-end fw-bold text-primary item-total-price" id="total-{{ $id }}">
                                    {{ number_format($details['price'] * $details['quantity'], 0, ',', ' ') }} TMT
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger border-0 btn-delete" data-id="{{ $id }}" title="Pozmak">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-md-none">
                    @foreach($cart as $id => $details)
                    <div class="cart-item-row border-bottom py-3" id="cart-row-mob-{{ $id }}" data-price="{{ $details['price'] }}">
                        <div class="d-flex align-items-start mb-2">
                            <div class="bg-light rounded-3 p-1 me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                @if(isset($details['image']) && file_exists(public_path($details['image'])))
                                <img src="{{ asset($details['image']) }}" class="img-fluid h-100 w-100" style="object-fit: contain;" alt="">
                                @elseif(isset($details['image']) && file_exists(public_path('storage/' . $details['image'])))
                                <img src="{{ asset('storage/' . $details['image']) }}" class="img-fluid h-100 w-100" style="object-fit: contain;" alt="">
                                @else
                                <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="img-fluid h-100 w-100" style="object-fit: contain;" alt="">
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold mb-1 text-dark fs-6">{{ $details['name'] }}</h6>
                                    <button class="btn btn-sm text-danger p-0 ms-2 btn-delete" data-id="{{ $id }}">
                                        <i class="bi bi-trash fs-5"></i>
                                    </button>
                                </div>
                                <div class="text-muted small">{{ number_format($details['price'], 0, ',', ' ') }} TMT</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="input-group input-group-sm" style="width: 110px;">
                                <button class="btn btn-outline-secondary fw-bold btn-minus" type="button" data-id="{{ $id }}">-</button>
                                <span class="form-control text-center fw-bold bg-white d-flex align-items-center justify-content-center qty-number" id="qty-mob-{{ $id }}">
                                    {{ $details['quantity'] }}
                                </span>
                                <button class="btn btn-outline-secondary fw-bold btn-plus" type="button" data-id="{{ $id }}">+</button>
                            </div>
                            <div class="fw-bold text-primary item-total-price" id="total-mob-{{ $id }}">
                                {{ number_format($details['price'] * $details['quantity'], 0, ',', ' ') }} TMT
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            <a href="{{ route('home.index') }}" class="btn btn-outline-secondary rounded-pill px-4 w-100 w-md-auto text-center mb-4 mb-lg-0">
                <i class="bi bi-arrow-left me-2"></i>Söwda dowam etmek
            </a>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4">
                <h5 class="fw-bold mb-3 fs-6 fs-md-5">Sargyt etmek / Оформление</h5>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="phone" class="form-label small fw-semibold text-muted">Telefon belgisi / Номер телефона</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 fw-bold">+993</span>
                            <input type="text" name="phone" id="phone" class="form-control bg-light border-start-0 fs-6" placeholder="6XXXXXXX" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label small fw-semibold text-muted">Eltip bermeli salgy / Адрес доставки</label>
                        <textarea name="address" id="address" rows="3" class="form-control bg-light fs-6" placeholder="Aşgabat ş., Magtymguly şaýoly..." required></textarea>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Harytlaryň sany:</span>
                        <span class="fw-bold small" id="summary-items-count">{{ $totalItemsCount }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="h6 mb-0 fw-bold">Jemi baha:</span>
                        <span class="h4 mb-0 fw-bold text-primary" id="cart-grand-total">{{ number_format($totalPrice, 0, ',', ' ') }} TMT</span>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg rounded-3 w-100 fw-bold py-3 fs-6">
                        <i class="bi bi-check-circle me-2"></i>Sargydy tassyklamak
                    </button>
                </form>
            </div>
        </div>

    </div>
    @else
    <div class="text-center py-5 my-4">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h4 class="fw-bold text-secondary mt-3">Sebetiňiz boş</h4>
        <p class="text-muted small">Harytlary sebede goşmak üçin kataloga geçiň</p>
        <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill px-4 py-2 mt-2 fw-bold">
            Söwda başlamak
        </a>
    </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function formatPrice(amount) {
            return new Intl.NumberFormat('ru-RU').format(amount) + ' TMT';
        }

        function recalculateCartGrandTotal() {
            let totalMoney = 0;
            let totalItemsQty = 0;

            // Раздельный подсчет в зависимости от экрана ПК/Мобильный
            const rows = window.innerWidth >= 768 
                ? document.querySelectorAll('.table-responsive .cart-item-row')
                : document.querySelectorAll('.d-md-none .cart-item-row');

            rows.forEach(row => {
                const price = parseFloat(row.dataset.price) || 0;
                const qtyEl = row.querySelector('.qty-number');
                const qty = qtyEl ? (parseInt(qtyEl.textContent.trim()) || 0) : 0;

                totalMoney += price * qty;
                totalItemsQty += qty;
            });

            const grandTotalEl = document.getElementById('cart-grand-total');
            if (grandTotalEl) grandTotalEl.textContent = formatPrice(totalMoney);

            const countHeaderEl = document.getElementById('cart-total-count');
            if (countHeaderEl) countHeaderEl.textContent = totalItemsQty;

            const countSummaryEl = document.getElementById('summary-items-count');
            if (countSummaryEl) countSummaryEl.textContent = totalItemsQty;
        }

        function sendCartUpdate(id, qty, shouldReloadIfEmpty = false) {
            fetch(`/cart/ajax-add/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.cart_count !== undefined) {
                        const badge = document.getElementById('cart-badge-count');
                        if (badge) {
                            badge.textContent = data.cart_count;
                        }

                        if (shouldReloadIfEmpty || data.cart_count === 0) {
                            location.reload();
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        document.querySelectorAll('.btn-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const qtyEl = document.getElementById(`qty-${id}`);
                const qtyMobEl = document.getElementById(`qty-mob-${id}`);
                
                const totalEl = document.getElementById(`total-${id}`);
                const totalMobEl = document.getElementById(`total-mob-${id}`);
                
                const row = document.getElementById(`cart-row-${id}`) || document.getElementById(`cart-row-mob-${id}`);
                const price = parseFloat(row.dataset.price);

                let currentQty = qtyEl ? parseInt(qtyEl.textContent.trim()) : parseInt(qtyMobEl.textContent.trim());
                let newQty = currentQty + 1;

                if (qtyEl) qtyEl.textContent = newQty;
                if (qtyMobEl) qtyMobEl.textContent = newQty;

                if (totalEl) totalEl.textContent = formatPrice(price * newQty);
                if (totalMobEl) totalMobEl.textContent = formatPrice(price * newQty);

                recalculateCartGrandTotal();
                sendCartUpdate(id, newQty);
            });
        });

        document.querySelectorAll('.btn-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const qtyEl = document.getElementById(`qty-${id}`);
                const qtyMobEl = document.getElementById(`qty-mob-${id}`);
                
                const totalEl = document.getElementById(`total-${id}`);
                const totalMobEl = document.getElementById(`total-mob-${id}`);
                
                const row = document.getElementById(`cart-row-${id}`) || document.getElementById(`cart-row-mob-${id}`);
                const price = parseFloat(row.dataset.price);

                let currentQty = qtyEl ? parseInt(qtyEl.textContent.trim()) : parseInt(qtyMobEl.textContent.trim());
                let newQty = currentQty - 1;

                if (newQty > 0) {
                    if (qtyEl) qtyEl.textContent = newQty;
                    if (qtyMobEl) qtyMobEl.textContent = newQty;

                    if (totalEl) totalEl.textContent = formatPrice(price * newQty);
                    if (totalMobEl) totalMobEl.textContent = formatPrice(price * newQty);

                    recalculateCartGrandTotal();
                    sendCartUpdate(id, newQty);
                } else {
                    const rowDesk = document.getElementById(`cart-row-${id}`);
                    const rowMob = document.getElementById(`cart-row-mob-${id}`);
                    if (rowDesk) rowDesk.remove();
                    if (rowMob) rowMob.remove();

                    recalculateCartGrandTotal();
                    const remainingRows = document.querySelectorAll('.table-responsive .cart-item-row').length;
                    sendCartUpdate(id, 0, remainingRows === 0);
                }
            });
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const rowDesk = document.getElementById(`cart-row-${id}`);
                const rowMob = document.getElementById(`cart-row-mob-${id}`);
                
                if (rowDesk) rowDesk.remove();
                if (rowMob) rowMob.remove();

                recalculateCartGrandTotal();
                const remainingRows = document.querySelectorAll('.table-responsive .cart-item-row').length;
                sendCartUpdate(id, 0, remainingRows === 0);
            });
        });
    });
</script>
@endsection