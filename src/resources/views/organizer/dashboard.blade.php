@extends('layouts.organizer')
@section('title', 'Panel Kontrol Penyelenggara')
@section('page-title', 'Ringkasan Penyelenggara')

@section('content')
<div class="space-y-6">
    <x-organizer.page-hero
        eyebrow="Panel Kontrol Operasional"
        title="Selamat datang, {{ Auth::user()->name }}"
        description="Pantau performa acara, penjualan tiket, dan tren pendapatan dalam satu konsol penyelenggara yang terpadu."
        icon="presentation-chart-line" />

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-organizer.stat-card label="Total Penjualan" value="Rp {{ number_format($stats['total_penjualan'], 0, ',', '.') }}" meta="Akumulasi pembayaran berhasil" icon="banknotes" tone="emerald" />
        <x-organizer.stat-card label="Tiket Terjual" value="{{ number_format($stats['tiket_terjual'], 0, ',', '.') }}" meta="Total seluruh kategori tiket" icon="ticket" tone="violet" />
        <x-organizer.stat-card label="Total Check-in" value="{{ number_format($stats['total_checkin'], 0, ',', '.') }}" meta="Tiket yang telah dipindai" icon="qr-code" tone="fuchsia" />
        <x-organizer.stat-card label="Acara Aktif" value="{{ number_format($stats['acara_aktif'], 0, ',', '.') }}" meta="Acara dengan status terbit" icon="calendar-days" tone="sky" />
        <x-organizer.stat-card label="Perlu Ditinjau" value="{{ number_format($stats['perlu_ditinjau'], 0, ',', '.') }}" meta="Draf atau menunggu persetujuan" icon="exclamation-triangle" tone="amber" />
        <x-organizer.stat-card label="Siap Cair" value="{{ number_format($stats['siap_cair'], 0, ',', '.') }}" meta="Acara selesai & siap dicairkan" icon="banknotes" tone="emerald" />
    </div>

    @include('organizer.dashboard.partials.statistics-chart')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            @include('organizer.dashboard.partials.recent-events')
        </div>

        @include('organizer.dashboard.partials.ticket-distribution')
    </div>
</div>
@endsection
