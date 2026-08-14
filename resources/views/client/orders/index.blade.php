@extends('client.layouts.header')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-bag-check-fill text-primary me-2"></i>Sargytlarym
        </h3>
        <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
            Jemi: {{ $orders->total() }} sargyt
        </span>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($orders->isEmpty())
    <div class="card shadow-sm border-0 text-center py-5 rounded-4">
        <div class="card-body">
            <i class="bi bi-cart-x text-secondary display-1 opacity-50"></i>
            <h4 class="fw-bold text-muted mt-3">Sizde heniz sargyt ýok</h4>
            <p class="text-secondary">Sargyt eden harytlaryňyz bu ýerde peýda bolar.</p>
            <a href="{{ route('home.index') }}" class="btn btn-primary fw-bold px-4 rounded-pill mt-2">
                <i class="bi bi-shop me-1"></i> Harytlary görmek
            </a>
        </div>
    </div>
    @else
    <div class="row g-4">
        @foreach($orders as $order)
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

                <div class="card-header bg-light border-0 py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <span class="fw-bold fs-5 text-dark">Sargyt №{{ $order->id }}</span>
                        <span class="text-muted ms-2 fs-6">
                            <i class="bi bi-clock me-1"></i>{{ $order->created_at->format('d.m.Y H:i') }}
                        </span>
                    </div>
                    <div>
                        @if($order->status == 'pending')
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-hourglass-split me-1"></i> Garaşylýar (Pending)
                        </span>
                        @elseif($order->status == 'completed')
                        <span class="badge bg-success px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-check-lg me-1"></i> Kabul edildi
                        </span>
                        @else
                        <span class="badge bg-secondary px-3 py-2 rounded-pill fw-semibold">
                            {{ $order->status }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row mb-3 gy-2">
                        <div class="col-12 col-md-6">
                            <p class="mb-1 text-muted small">Telefon belgi:</p>
                            <p class="fw-bold text-dark mb-0"><i class="bi bi-telephone text-primary me-1"></i>{{ $order->phone }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="mb-1 text-muted small">Salgysy:</p>
                            <p class="fw-bold text-dark mb-0"><i class="bi bi-geo-alt text-danger me-1"></i>{{ $order->address }}</p>
                        </div>
                    </div>

                    <hr class="my-3 opacity-10">

                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-box-seam me-2"></i>Harytlar:</h6>
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless mb-0">
                            <tbody>
                                @foreach($order->items as $item)
                                @php
                                    $product = $item->product;
                                    $img = $product ? $product->image : null;
                                @endphp
                                <tr>
                                    <td style="width: 60px;">
                                        @if($img && file_exists(public_path('img/' . $img)))
                                            <img src="{{ asset('img/' . $img) }}" class="rounded-3" alt="{{ $product->name ?? '' }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @elseif($img && file_exists(public_path($img)))
                                            <img src="{{ asset($img) }}" class="rounded-3" alt="{{ $product->name ?? '' }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @elseif($img && file_exists(public_path('storage/' . $img)))
                                            <img src="{{ asset('storage/' . $img) }}" class="rounded-3" alt="{{ $product->name ?? '' }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded-3" alt="No Image" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">
                                            {{ $product->name ?? 'Haryt öçürilen' }}
                                        </div>
                                        <small class="text-muted">{{ $item->price }} TMT</small>
                                    </td>
                                    <td class="text-center fw-semibold text-secondary">
                                        {{ $item->quantity }} sany
                                    </td>
                                    <td class="text-end fw-bold text-dark">
                                        {{ $item->price * $item->quantity }} TMT
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-3 opacity-10">

                    <div class="d-flex justify-content-between align-items-center pt-1">
                        <span class="fw-bold fs-5 text-secondary">Jemi sargyt summasy:</span>
                        <span class="fw-bold fs-4 text-primary">{{ $order->total_price }} TMT</span>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection