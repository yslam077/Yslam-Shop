@extends('admin.layouts.header') {{-- или ваш главный layout админки --}}

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-danger">Admin Dashboard</h2>
        
        <!-- Кнопка Выхода -->
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger fw-bold">
                <i class="bi bi-box-arrow-right"></i> Çykmak (Admin)
            </button>
        </form>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-primary text-white p-3">
                    <h4>Harytlar (Товары)</h4>
                    <p class="display-5 fw-bold mb-0">{{ $productsCount }}</p>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm bg-success text-white p-3">
                    <h4>Agzalar (Пользователи)</h4>
                    <p class="display-5 fw-bold mb-0">{{ $usersCount }}</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection