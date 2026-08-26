@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <h3 class="fw-bold mb-0 fs-4 fs-md-2">Sargyt #{{ $order->id }}</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Yza
        </a>
    </div>

    <div class="row g-3 g-md-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 mb-3 mb-lg-0">
                <h5 class="fw-bold mb-3 fs-6 fs-md-5">Müşderi barada maglumat</h5>

                <div class="mb-3">
                    <span class="text-muted d-block small">Telefon:</span>
                    <strong class="fs-6 fs-md-5">{{ $order->phone }}</strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted d-block small">Eltip bermeli salgy:</span>
                    <strong>{{ $order->address }}</strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted d-block small">Sargydyň wagty:</span>
                    <span class="small">{{ $order->created_at->format('d.m.Y H:i:s') }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="h6 mb-0">Jemi baha:</span>
                    <span class="h5 h4-md mb-0 text-primary fw-bold">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</span>
                </div>

                <h6 class="fw-bold mb-2">Sargydyň ýagdaýy (Статус):</h6>
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="d-grid gap-2">
                        <button type="submit" name="status" value="on_the_way" 
                            class="btn btn-md rounded-3 fw-bold {{ $order->status == 'on_the_way' ? 'btn-warning text-white' : 'btn-outline-warning' }}">
                            <i class="bi bi-truck me-1"></i> Ýolda (В пути)
                        </button>

                        <button type="submit" name="status" value="delivered" 
                            class="btn btn-md rounded-3 fw-bold {{ $order->status == 'delivered' ? 'btn-success' : 'btn-outline-success' }}">
                            <i class="bi bi-check-circle me-1"></i> Getirildi (Доставлен)
                        </button>

                        <button type="submit" name="status" value="canceled" 
                            class="btn btn-sm rounded-3 mt-1 {{ $order->status == 'canceled' ? 'btn-danger' : 'btn-outline-danger' }}">
                            <i class="bi bi-x-circle me-1"></i> Goýbolsun edildi (Отменен)
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4">
                <h5 class="fw-bold mb-3 fs-6 fs-md-5">Sargalan harytlar (Товары)</h5>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-muted small">
                            <tr>
                                <th>Haryt</th>
                                <th class="text-center">Baha</th>
                                <th class="text-center">Sany</th>
                                <th class="text-end">Jemi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(optional($item->product)->image && file_exists(public_path('img/' . $item->product->image)))
                                            <img src="{{ asset('img/' . $item->product->image) }}" class="rounded me-2 me-md-3" alt="" style="width: 45px; height: 45px; object-fit: contain;">
                                        @elseif(optional($item->product)->image && file_exists(public_path($item->product->image)))
                                            <img src="{{ asset($item->product->image) }}" class="rounded me-2 me-md-3" alt="" style="width: 45px; height: 45px; object-fit: contain;">
                                        @elseif(optional($item->product)->image && file_exists(public_path('storage/' . $item->product->image)))
                                            <img src="{{ asset('storage/' . $item->product->image) }}" class="rounded me-2 me-md-3" alt="" style="width: 45px; height: 45px; object-fit: contain;">
                                        @else
                                            <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded me-2 me-md-3" alt="" style="width: 45px; height: 45px; object-fit: contain;">
                                        @endif

                                        <div>
                                            <span class="fw-bold d-block small fs-md-6">{{ $item->product->name ?? 'Öçürilen haryt' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center small">{{ number_format($item->price, 0, ',', ' ') }} TMT</td>
                                <td class="text-center fw-bold small">x{{ $item->quantity }}</td>
                                <td class="text-end fw-bold text-primary small fs-md-6">
                                    {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} TMT
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection