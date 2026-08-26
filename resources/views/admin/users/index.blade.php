@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-2 py-md-4 px-0 px-md-3">
    <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <h3 class="fw-bold text-dark fs-4 fs-md-2 mb-0">Agza bolan ulanyjylar</h3>
        <span class="badge bg-primary fs-7 fs-md-6">Jemi: {{ $users->total() }}</span>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-3 mb-md-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm mb-3 mb-md-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Ady (Имя)</th>
                            <th>E-mail</th>
                            <th>Kabul edilen wagty</th>
                            <th class="text-end pe-3">Sazlamalar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-3 fw-bold">#{{ $user->id }}</td>
                            <td class="fw-bold">
                                <i class="bi bi-person-circle me-1 text-secondary"></i>
                                {{ $user->name }}
                            </td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ optional($user->created_at)->format('d.m.Y H:i') ?? '-' }}
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                @if(Auth::check() && Auth::id() == $user->id)
                                    <span class="badge bg-secondary py-2 px-3">
                                        <i class="bi bi-shield-check me-1"></i> Özüňiz
                                    </span>
                                @else
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Ulanyjyny pozmak isleýärsiňizmi?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Pozmak
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Hiç hili ulanyjy tapylmady</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-md-none p-3">
                @forelse($users as $user)
                <div class="border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div>
                            <span class="fw-bold text-dark fs-6 d-block">
                                <i class="bi bi-person-circle me-1 text-secondary"></i>{{ $user->name }}
                            </span>
                            <span class="small text-muted">{{ $user->email }}</span>
                        </div>
                        <span class="small text-muted fw-bold">#{{ $user->id }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="badge bg-light text-dark border small">
                            {{ optional($user->created_at)->format('d.m.Y H:i') ?? '-' }}
                        </span>

                        @if(Auth::check() && Auth::id() == $user->id)
                            <span class="badge bg-secondary py-1 px-2 small">
                                <i class="bi bi-shield-check me-1"></i> Özüňiz
                            </span>
                        @else
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Ulanyjyny pozmak isleýärsiňizmi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="bi bi-trash me-1"></i> Pozmak
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">Hiç hili ulanyjy tapylmady</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection