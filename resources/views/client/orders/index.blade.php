@extends('client.layouts.header') {{-- Укажи свой главный layout клиента --}}

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4">Meniň sargytlarym (Мои заказы)</h3>

    <div class="row g-4">
        @forelse($orders as $order)
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-3">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div>
                        <span class="fw-bold fs-5">Sargyt #{{ $order->id }}</span>
                        <span class="text-muted small ms-2">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div>
                        @if($order->status == 'pending')
                        <span class="badge bg-secondary p-2">
                            <i class="bi bi-clock me-1"></i> Garaşylýar (В ожидании)
                        </span>
                        @elseif($order->status == 'on_the_way')
                        <span class="badge bg-warning text-dark p-2">
                            <i class="bi bi-truck me-1"></i> Ýolda (В пути)
                        </span>
                        @elseif($order->status == 'delivered')
                        <span class="badge bg-success p-2">
                            <i class="bi bi-check-circle me-1"></i> Geltirildi (Доставлен)
                        </span>
                        @elseif($order->status == 'canceled')
                        <span class="badge bg-danger p-2">
                            <i class="bi bi-x-circle me-1"></i> Goýbolsun edildi (Отменен)
                        </span>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td style="width: 60px;">
                                    @if(optional($item->product)->image && file_exists(public_path('img/' . $item->product->image)))
                                    <img src="{{ asset('img/' . $item->product->image) }}" class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                    @else
                                    <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $item->product->name ?? 'Haryt öçürilen' }}</span>
                                </td>
                                <td class="text-center">x{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} TMT</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <span class="text-muted small">Salgy: <strong>{{ $order->address }}</strong></span>
                    <span class="fs-5 fw-bold text-primary">Jemi: {{ number_format($order->total_price, 0, ',', ' ') }} TMT</span>
                </div>
            </div>
        </div>
       @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-bag-x display-1 text-muted"></i>
            <h4 class="mt-3 text-muted">Sizde entek hiç hili sargyt ýok</h4>
            <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill mt-3">Söwda etmäge başlaň</a>
        </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection