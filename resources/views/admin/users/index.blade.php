@extends('admin.layouts.header')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Agza bolan ulanyjylar (Пользователи)</h3>
        <span class="badge bg-primary fs-6">Jemi: {{ $users->total() }} ulanyjy</span>
    </div>

    {{-- Уведомление об успехе --}}
    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- Уведомление об ошибке (например, при попытке удалить себя) --}}
    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Ady (Имя)</th>
                            <th>E-mail</th>
                            <th>Kabul edilen wagty (Дата регистрации)</th>
                            <th class="text-end pe-3">Sazlamalar (Действия)</th>
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
                                {{-- Проверка: если это текущий вошедший админ --}}
                                @if(Auth::check() && Auth::id() == $user->id)
                                    <span class="badge bg-secondary py-2 px-3">
                                        <i class="bi bi-shield-check me-1"></i> Özüňiz (Вы)
                                    </span>
                                @else
                                    {{-- Кнопка удаления для всех остальных пользователей --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Ulanyjyny pozmak isleýärsiňizmi?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить">
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
        </div>
    </div>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection