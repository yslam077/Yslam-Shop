@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Harydy üýtgetmek #{{ $product->id }}</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Yza кайтар
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Название -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Harydyň ady:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Категория -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">Kategoriýasy:</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Цена -->
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold">Bahasy (TMT):</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Изображение и превью -->
                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold">Täze surat saýlamak (Islege görä):</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror

                        <!-- Текущее фото -->
                        <div class="mt-2 d-flex align-items-center gap-2">
                            <span class="small text-muted">Häzirki surat:</span>
                            @if($product->image && file_exists(public_path('img/' . $product->image)))
                                <img src="{{ asset('img/' . $product->image) }}" class="rounded border" style="width: 40px; height: 40px; object-fit: cover;">
                            @elseif($product->image && file_exists(public_path('storage/' . $product->image)))
                                <img src="{{ asset('storage/' . $product->image) }}" class="rounded border" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <img src="{{ asset('iconimg/yslam_shop.webp') }}" class="rounded border" style="width: 40px; height: 40px; object-fit: cover;">
                            @endif
                        </div>
                    </div>

                    <!-- Описание -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-bold">Giňişleýin maglumat (Beýany):</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold px-4">
                            <i class="bi bi-save me-1"></i> Üýtgeşmeleri ýatda sakla
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection