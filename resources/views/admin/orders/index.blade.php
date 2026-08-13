@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4">Sargytlar / Заказы</h2>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
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
                            <!-- Динамическое отображение статуса -->
                            @if($order->status == 'pending')
                                <span class="badge bg-secondary">
                                    <i class="bi bi-clock me-1"></i> Garaşylýar (В ожидании)
                                </span>
                            @elseif($order->status == 'on_the_way')
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-truck me-1"></i> Ýolda (В пути)
                                </span>
                            @elseif($order->status == 'delivered')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i> Geltirildi (Доставлен)
                                </span>
                            @elseif($order->status == 'canceled')
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i> Goýbolsun edildi (Отменен)
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
        <div class="p-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection