@extends('admin.layouts.header')

@section('title', 'Sargytlar')

@section('content')
@php
    $statusMap = [
        'pending'    => ['label' => 'Garaşylýar',        'icon' => 'bi-clock',        'pill' => 'pill-pending', 'key' => 'pending'],
        'on_the_way' => ['label' => 'Ýolda',              'icon' => 'bi-truck',        'pill' => 'pill-way',     'key' => 'way'],
        'delivered'  => ['label' => 'Geltirildi',         'icon' => 'bi-check-circle', 'pill' => 'pill-ok',      'key' => 'ok'],
        'canceled'   => ['label' => 'Goýbolsun edildi',   'icon' => 'bi-x-circle',     'pill' => 'pill-no',      'key' => 'no'],
    ];

    $all = $orders->getCollection();
    $counts = [
        'all'     => $all->count(),
        'pending' => $all->where('status', 'pending')->count(),
        'way'     => $all->where('status', 'on_the_way')->count(),
        'ok'      => $all->where('status', 'delivered')->count(),
        'no'      => $all->where('status', 'canceled')->count(),
    ];
@endphp

<div class="adm-head adm-in">
    <div>
        <h1 class="adm-title">Sargytlar <span class="text-muted fw-semibold fs-6">/ Заказы</span></h1>
        <p class="adm-sub">Jemi: {{ $orders->total() }} sargyt</p>
    </div>
</div>

<div class="adm-toolbar adm-in" data-d="60">
    <label class="adm-search mb-0">
        <i class="bi bi-search"></i>
        <input type="text" id="orderSearch" placeholder="Telefon, ID ýa-da salgy boýunça gözle..." autocomplete="off">
    </label>
</div>

<div class="d-flex flex-wrap gap-2 mb-3 adm-in" data-d="100">
    <button type="button" class="adm-chip active" data-filter="all"><i class="bi bi-list-ul"></i> Ählisi <small>{{ $counts['all'] }}</small></button>
    <button type="button" class="adm-chip" data-filter="pending"><i class="bi bi-clock"></i> Garaşylýar <small>{{ $counts['pending'] }}</small></button>
    <button type="button" class="adm-chip" data-filter="way"><i class="bi bi-truck"></i> Ýolda <small>{{ $counts['way'] }}</small></button>
    <button type="button" class="adm-chip" data-filter="ok"><i class="bi bi-check-circle"></i> Geltirildi <small>{{ $counts['ok'] }}</small></button>
    <button type="button" class="adm-chip" data-filter="no"><i class="bi bi-x-circle"></i> Goýbolsun <small>{{ $counts['no'] }}</small></button>
</div>

<div class="adm-card overflow-hidden adm-in" data-d="140">
    {{-- ================= KOMPÝUTER ================= --}}
    <div class="table-responsive d-none d-md-block">
        <table class="table adm-table align-middle">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Telefon</th>
                    <th>Salgy <span class="text-lowercase fw-semibold">(Адрес)</span></th>
                    <th>Jemi baha</th>
                    <th>Status</th>
                    <th>Sene <span class="text-lowercase fw-semibold">(Дата)</span></th>
                    <th class="text-end">Sazlamalar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                @php $st = $statusMap[$order->status] ?? ['label' => $order->status, 'icon' => 'bi-question-circle', 'pill' => 'pill-none', 'key' => 'none']; @endphp
                <tr data-order data-status="{{ $st['key'] }}" data-text="{{ mb_strtolower('#' . $order->id . ' ' . $order->phone . ' ' . $order->address) }}">
                    <td class="fw-bolder">#{{ $order->id }}</td>
                    <td class="text-nowrap">{{ $order->phone }}</td>
                    <td class="text-muted">{{ Str::limit($order->address, 30) }}</td>
                    <td class="fw-bold text-primary text-nowrap">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</td>
                    <td><span class="pill {{ $st['pill'] }}"><i class="bi {{ $st['icon'] }}"></i>{{ $st['label'] }}</span></td>
                    <td class="small text-muted text-nowrap">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-soft primary"><i class="bi bi-eye"></i> Giňişleýin</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7"><div class="adm-empty mb-0"><i class="bi bi-inbox"></i>Hiç hili sargyt ýok</div></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= TELEFON ================= --}}
    <div class="d-md-none">
        @forelse($orders as $order)
        @php $st = $statusMap[$order->status] ?? ['label' => $order->status, 'icon' => 'bi-question-circle', 'pill' => 'pill-none', 'key' => 'none']; @endphp
        <div class="m-card" data-order data-status="{{ $st['key'] }}" data-text="{{ mb_strtolower('#' . $order->id . ' ' . $order->phone . ' ' . $order->address) }}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bolder fs-6">#{{ $order->id }}</span>
                <span class="pill {{ $st['pill'] }}"><i class="bi {{ $st['icon'] }}"></i>{{ $st['label'] }}</span>
            </div>
            <div class="small text-muted mb-1"><i class="bi bi-telephone me-1 text-primary"></i>{{ $order->phone }}</div>
            <div class="small text-muted mb-1"><i class="bi bi-geo-alt me-1 text-danger"></i>{{ Str::limit($order->address, 35) }}</div>
            <div class="small text-muted mb-2"><i class="bi bi-clock me-1"></i>{{ $order->created_at->format('d.m.Y H:i') }}</div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold text-primary">{{ number_format($order->total_price, 0, ',', ' ') }} TMT</span>
                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-soft primary"><i class="bi bi-eye"></i> Giňişleýin</a>
            </div>
        </div>
        @empty
        <div class="adm-empty"><i class="bi bi-inbox"></i>Hiç hili sargyt ýok</div>
        @endforelse
    </div>

    <div id="noMatch" class="adm-empty d-none"><i class="bi bi-emoji-frown"></i>Hiç zat tapylmady</div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }}
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('[data-order]');
        const chips = document.querySelectorAll('.adm-chip');
        const search = document.getElementById('orderSearch');
        const noMatch = document.getElementById('noMatch');
        let filter = 'all';

        function apply() {
            const q = search.value.trim().toLowerCase();
            let seen = new Set();

            rows.forEach(r => {
                const okStatus = filter === 'all' || r.dataset.status === filter;
                const okText = !q || r.dataset.text.includes(q);
                const show = okStatus && okText;
                r.classList.toggle('d-none', !show);
                if (show) seen.add(r.dataset.text);
            });

            noMatch.classList.toggle('d-none', rows.length === 0 || seen.size > 0);
        }

        chips.forEach(c => c.addEventListener('click', () => {
            chips.forEach(x => x.classList.remove('active'));
            c.classList.add('active');
            filter = c.dataset.filter;
            apply();
        }));

        search.addEventListener('input', apply);
    });
</script>
@endpush