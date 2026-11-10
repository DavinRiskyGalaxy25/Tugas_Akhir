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
                    <article class="extra-card has-image">
                        <div class="extra-image">
                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}">
                        </div>
                        <div class="extra-body">
                            <h3>{{ $item->nama }}</h3>
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
