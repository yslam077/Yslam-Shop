@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <h2 class="fw-bold mb-3 mb-md-4 fs-4 fs-md-2">Sargytlar / Заказы</h2>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <!-- Версия для ПК (Таблица) -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small">
                    <tr>
                        <th>#ID</th>
                        <th>Telefon</th>
                        <th>Salgy (Адрес)</th>
                        <th>Jemi baha</th>
                        <th>Status</th>
                        <th>Sene (Дата)</th>
                        <th class="text-end">Sazlamalar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="fw-bold">#{{ $order->id }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ Str::limit($order->address, 30) }}</td>
                        <td class="fw-bold text-primary">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="badge bg-secondary">
                                    <i class="bi bi-clock me-1"></i> Garaşylýar
                                </span>
                            @elseif($order->status == 'on_the_way')
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-truck me-1"></i> Ýolda
                                </span>
                            @elseif($order->status == 'delivered')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i> Geltirildi
                                </span>
                            @elseif($order->status == 'canceled')
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i> Goýbolsun edildi
                                </span>
                            @else
                                <span class="badge bg-light text-dark">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary rounded-3">
                                <i class="bi bi-eye me-1"></i>Giňişleýin
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Hiç hili sargyt ýok</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Мобильная версия (Карточки) -->
        <div class="d-md-none p-3">
            @forelse($orders as $order)
            <div class="border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold fs-6">#{{ $order->id }}</span>
                    @if($order->status == 'pending')
                        <span class="badge bg-secondary">Garaşylýar</span>
                    @elseif($order->status == 'on_the_way')
                        <span class="badge bg-warning text-dark">Ýolda</span>
                    @elseif($order->status == 'delivered')
                        <span class="badge bg-success">Geltirildi</span>
                    @elseif($order->status == 'canceled')
                        <span class="badge bg-danger">Отменен</span>
                    @else
                        <span class="badge bg-light text-dark">{{ $order->status }}</span>
                    @endif
                </div>

                <div class="text-muted small mb-1">
                    <i class="bi bi-telephone me-1"></i>{{ $order->phone }}
                </div>
                <div class="text-muted small mb-2">
                    <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($order->address, 35) }}
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="fw-bold text-primary">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</span>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-eye me-1"></i>Giňişleýin
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-4 text-muted">Hiç hili sargyt ýok</div>
            @endforelse
        </div>

        <div class="p-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection