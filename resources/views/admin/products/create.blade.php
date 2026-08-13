@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Täze haryt goşmak</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Yza кайтар
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Название товара -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Harydyň ady:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="Meselem: Push-up board">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Категория -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">Kategoriýasy:</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="" disabled selected>Kategoriýa saýlaň</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Цена -->
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold">Bahasy (TMT):</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required placeholder="0.00">
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Изображение -->
                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold">Surat ýüklemek:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Описание -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-bold">Giňişleýin maglumat (Beýany):</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Haryt barada giňişleýin ýazyň...">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-success btn-lg fw-bold px-4">
                            <i class="bi bi-check-lg me-1"></i> Ýatda sakla
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection