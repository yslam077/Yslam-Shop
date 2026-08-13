@extends('client.layouts.app')

@section('content')
<div class="container my-4">
    <h3 class="fw-bold mb-4">Gözleg netijeleri: <span class="text-primary">"{{ $query }}"</span></h3>

    @if($products->count() > 0)
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <!-- Добавлена проверка на наличие фото -->
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="card-text text-danger fw-bolder fs-5">{{ $product->price }} TMT</p>
                            
                            <!-- Проверь название этого роута в web.php -->
                            <a href="{{ route('categories.show', $product->id) }}" class="btn btn-outline-primary w-100 fw-bold">Görmek</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация Bootstrap 5 -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(['q' => $query])->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-warning text-center py-4 fs-5 fw-bold">
            Hiç zat tapylmady
        </div>
    @endif
</div>
@endsection