@extends('client.layouts.header')

@section('title', 'Sebet')

@section('content')
<div class="container-lg py-4">
    <h2 class="fw-bold mb-4">
        <i class="bi bi-cart3 text-primary me-2"></i>Sebet ({{ count($cart) }})
    </h2>

    
    <!-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif -->

    @if(count($cart) > 0)
    <div class="row g-4">
       
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-3 mb-3">
                <div class="table-responsive">
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
                            <tr class="border-bottom">
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-3 p-2 me-3" style="width: 65px; height: 65px;">
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

                                
                                <td class="text-center" style="width: 130px;">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm text-center fw-bold rounded-3" onchange="this.form.submit()">
                                    </form>
                                </td>

                                
                                <td class="text-end fw-bold text-primary">
                                    {{ number_format($details['price'] * $details['quantity'], 0, ',', ' ') }} TMT
                                </td>

                                
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ route('home.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Söwda dowam etmek
            </a>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Jemi / Итого</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Harytlaryň sany:</span>
                    <span class="fw-bold">{{ count($cart) }}</span>
                </div>

                <hr class="my-3">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="h5 mb-0 fw-bold">Jemi baha:</span>
                    <span class="h3 mb-0 fw-bold text-primary">{{ number_format($totalPrice, 0, ',', ' ') }} TMT</span>
                </div>

                <button class="btn btn-success btn-lg rounded-3 w-100 fw-bold py-3">
                    <i class="bi bi-check-circle me-2"></i>Sargyt etmek
                </button>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5 my-5">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h3 class="fw-bold text-secondary mt-3">Sebetiňiz boş</h3>
        <p class="text-muted">Harytlary sebede goşmak üçin kataloga geçiň</p>
        <a href="{{ route('home.index') }}" class="btn btn-primary rounded-pill px-5 py-2 mt-2 fw-bold">
            Söwda başlamak
        </a>
    </div>
    @endif
</div>
@endsection