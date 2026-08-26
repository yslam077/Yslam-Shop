@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <h3 class="fw-bold text-dark fs-4 fs-md-2 mb-0">Harydy üýtgetmek #{{ $product->id }}</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-secondary fw-bold rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Yza
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-3 p-md-4">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-bold small">Harydyň ady:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Категория -->
                    <div class="col-12 col-md-6">
                        <label for="category_id" class="form-label fw-bold small">Kategoriýasy:</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="price" class="form-label fw-bold small">Bahasy (TMT):</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="image" class="form-label fw-bold small">Täze surat saýlamak (Islege görä):</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                        <div class="mt-2 d-flex align-items-center gap-2">
                            <span class="small text-muted">Häzirki surat:</span>
                            @if($product->image && file_exists(public_path('img/' . $product->image)))
                                <img src="{{ asset('img/' . $product->image) }}" class="rounded border" style="width: 45px; height: 45px; object-fit: cover;">
                            @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                                <img src="{{ asset('storage/' . $product->image) }}" class="rounded border" style="width: 45px; height: 45px; object-fit: cover;">
                            @else
                                <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded border" style="width: 45px; height: 45px; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label fw-bold small">Giňişleýin maglumat (Beýany):</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto fw-bold px-4 rounded-3">
                            <i class="bi bi-save me-1"></i> Üýtgeşmeleri ýatda sakla
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection