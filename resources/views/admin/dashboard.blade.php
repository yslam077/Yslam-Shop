@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <h2 class="fw-bold text-danger fs-4 fs-md-2 mb-0">Admin Dashboard</h2>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3">
                <i class="bi bi-box-arrow-right"></i> Çykmak
            </button>
        </form>
    </div>

    <div class="row g-2 g-md-4 mb-3 mb-md-4">
        <div class="col-4 col-md-4">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-primary text-white p-2 p-md-3 rounded-4 h-100">
                    <h6 class="fw-bold fs-6 fs-md-4 mb-1">Harytlar</h6>
                    <p class="display-6 display-5-md fw-bold mb-0">{{ $productsCount }}</p>
                </div>
            </a>
        </div>
        <div class="col-4 col-md-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-success text-white p-2 p-md-3 rounded-4 h-100">
                    <h6 class="fw-bold fs-6 fs-md-4 mb-1">Agzalar</h6>
                    <p class="display-6 display-5-md fw-bold mb-0">{{ $usersCount }}</p>
                </div>
            </a>
        </div>
        <div class="col-4 col-md-4">
            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-warning text-dark p-2 p-md-3 rounded-4 h-100">
                    <h6 class="fw-bold fs-6 fs-md-4 mb-1">Sargytlar</h6>
                    <p class="display-6 display-5-md fw-bold mb-0">{{ $ordersCount }}</p>
                </div>
            </a>
        </div>
    </div>

    @if(isset($pendingOrders) && count($pendingOrders) > 0)
    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 mt-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0 fs-6 fs-md-4">
                <i class="bi bi-bell-fill text-warning me-1 me-md-2"></i>Täze sargytlar
            </h5>
            <span class="badge bg-danger rounded-pill fs-7 fs-md-6">{{ count($pendingOrders) }} täze</span>
        </div>

        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small">
                    <tr>
                        <th>#ID</th>
                        <th>Telefon</th>
                        <th>Salgy</th>
                        <th>Jemi baha</th>
                        <th>Wagty</th>
                        <th class="text-end">Sazlamalar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingOrders as $order)
                    <tr>
                        <td class="fw-bold">#{{ $order->id }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ Str::limit($order->address, 25) }}</td>
                        <td class="fw-bold text-primary">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</td>
                        <td class="small text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary rounded-3">
                                <i class="bi bi-eye me-1"></i> Seretmek
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Карточки для мобильных -->
        <div class="d-md-none">
            @foreach($pendingOrders as $order)
            <div class="border-bottom py-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold fs-6">#{{ $order->id }}</span>
                    <span class="small text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="small text-muted mb-1">
                    <i class="bi bi-telephone me-1"></i>{{ $order->phone }}
                </div>
                <div class="small text-muted mb-2">
                    <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($order->address, 30) }}
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-primary">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</span>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-eye me-1"></i> Seretmek
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection