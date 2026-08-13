@extends('admin.layouts.header')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-danger">Admin Dashboard</h2>

        <!-- Кнопка Выхода -->
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger fw-bold">
                <i class="bi bi-box-arrow-right"></i> Çykmak (Admin)
            </button>
        </form>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-primary text-white p-3 rounded-4">
                    <h4>Harytlar (Товары)</h4>
                    <p class="display-5 fw-bold mb-0">{{ $productsCount }}</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-success text-white p-3 rounded-4">
                    <h4>Agzalar (Пользователи)</h4>
                    <p class="display-5 fw-bold mb-0">{{ $usersCount }}</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-warning text-dark p-3 rounded-4">
                    <h4>Sargytlar (Заказы)</h4>
                    <p class="display-5 fw-bold mb-0">{{ $ordersCount }}</p>
                </div>
            </a>
        </div>
    </div>

    @if(isset($pendingOrders) && count($pendingOrders) > 0)
    <div class="card border-0 shadow-sm rounded-4 p-4 mt-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-dark mb-0">
                <i class="bi bi-bell-fill text-warning me-2"></i>Täze sargytlar (Новые заказы)
            </h4>
            <span class="badge bg-danger rounded-pill fs-6">{{ count($pendingOrders) }} täze</span>
        </div>

        <div class="table-responsive">
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
    </div>
    @endif

</div>
@endsection