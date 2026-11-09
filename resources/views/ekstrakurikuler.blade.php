@extends('layouts.app')

@section('title', 'Ekstrakurikuler - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Ekstrakurikuler</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container">
            <div class="extra-grid">
                @forelse($ekstrakurikuler as $item)
                    <article class="extra-card {{ $item->foto ? 'has-image' : '' }}">
                        @if($item->foto)
                            <div class="extra-image">
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}">
                            </div>
                        @else
                            <div class="extra-icon">
                                <i class="{{ $item->icon ?? 'fa-solid fa-star' }}"></i>
                            </div>
                        @endif
                        <div class="extra-body">
                            <h3>{{ $item->nama }}</h3>
                            <p>{{ $item->deskripsi }}</p>
                            @if($item->pembina || $item->jadwal)
                                <p class="extra-meta"><small>@if($item->pembina) <i class="fa-solid fa-user-tie"></i> Pembina: {{ $item->pembina }} @endif @if($item->jadwal) &middot; <i class="fa-solid fa-clock"></i> {{ $item->jadwal }} @endif</small></p>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Data ekstrakurikuler belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
