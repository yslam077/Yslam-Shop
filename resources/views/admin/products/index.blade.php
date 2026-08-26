@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <h3 class="fw-bold text-dark fs-4 fs-md-2 mb-0">Ähli harytlar</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-md-md btn-success fw-bold rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Täze haryt goş
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-3 mb-md-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <!-- Таблица для ПК -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Surat</th>
                            <th>Harydyň ady</th>
                            <th>Kategoriýa</th>
                            <th>Baha</th>
                            <th class="text-end pe-3">Sazlamalar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="ps-3 fw-bold">#{{ $product->id }}</td>
                            <td>
                                @if($product->image && file_exists(public_path('img/' . $product->image)))
                                    <img src="{{ asset('img/' . $product->image) }}" class="rounded" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @elseif($product->image && file_exists(public_path($product->image)))
                                    <img src="{{ asset($product->image) }}" class="rounded" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded" alt="No Image" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $product->category->name ?? 'Kategoriýasyz' }}
                                </span>
                            </td>
                            <td class="fw-bold text-primary">{{ number_format($product->price,0,'',',') }} TMT</td>
                            <td class="text-end pe-3">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Harydy pozmak isleýärsiňizmi?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Haryt ýok</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-md-none p-3">
                @forelse($products as $product)
                <div class="border-bottom py-3">
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-3" style="width: 55px; height: 55px; flex-shrink: 0;">
                            @if($product->image && file_exists(public_path('img/' . $product->image)))
                                <img src="{{ asset('img/' . $product->image) }}" class="rounded h-100 w-100" style="object-fit: cover;">
                            @elseif($product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" class="rounded h-100 w-100" style="object-fit: cover;">
                            @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                                <img src="{{ asset('storage/' . $product->image) }}" class="rounded h-100 w-100" style="object-fit: cover;">
                            @else
                                <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded h-100 w-100" style="object-fit: cover;">
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold mb-1 text-dark fs-6">{{ $product->name }}</h6>
                                <span class="small text-muted fw-bold">#{{ $product->id }}</span>
                            </div>
                            <div class="mb-1">
                                <span class="badge bg-info text-dark style="font-size: 0.7rem;">
                                    {{ $product->category->name ?? 'Kategoriýasyz' }}
                                </span>
                            </div>
                            <div class="fw-bold text-primary">{{ number_format($product->price,0,'',',') }} TMT</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="bi bi-pencil me-1"></i> Üýtgetmek
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Harydy pozmak isleýärsiňizmi?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="bi bi-trash me-1"></i> Pozmak
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">Haryt ýok</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection