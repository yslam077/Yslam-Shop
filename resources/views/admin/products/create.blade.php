@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <h3 class="fw-bold text-dark fs-4 fs-md-2 mb-0">Täze haryt goşmak</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-secondary fw-bold rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Yza
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-3 p-md-4">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-bold small">Harydyň ady:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="Meselem: Push-up board">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="category_id" class="form-label fw-bold small">Kategoriýasy:</label>
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
                    <div class="col-12 col-md-6">
                        <label for="price" class="form-label fw-bold small">Bahasy (TMT):</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required placeholder="0.00">
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="image" class="form-label fw-bold small">Surat ýüklemek:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold small">Giňişleýin maglumat (Beýany):</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Haryt barada giňişleýin ýazyň...">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-success btn-lg w-100 w-md-auto fw-bold px-4 rounded-3">
                            <i class="bi bi-check-lg me-1"></i> Ýatda sakla
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection