@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Ähli harytlar (Админ-панель)</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success fw-bold">
            <i class="bi bi-plus-lg me-1"></i> Täze haryt goş
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
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
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection