@extends('layouts.app')

@section('title', 'Kesiswaan - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Kesiswaan</h2>
        </div>
    </section>

    <section id="kegiatan" class="content-section">
        <div class="section-container">
            <div class="section-heading">
                <h2>Kegiatan Siswa</h2>
            </div>

            <div class="activity-grid">
                @forelse($kegiatan as $item)
                    <article class="activity-card">
                        <div class="activity-image">
                            <img src="{{ $item->foto_url }}" alt="{{ $item->judul }}">
                            @if($item->kategori)
                                <span class="activity-badge">{{ $item->kategori }}</span>
                            @endif
                        </div>
                        <div class="activity-info">
                            <span class="activity-date"><i class="fa-regular fa-calendar me-1"></i> {{ $item->tanggal ? $item->tanggal->translatedFormat('d F Y') : '' }}</span>
                            <h3>{{ $item->judul }}</h3>
                            <a href="{{ route('kegiatan.show', $item->slug) }}" class="activity-link">Selengkapnya &rarr;</a>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Belum ada kegiatan yang dipublikasikan.</p>
                @endforelse
            </div>

            <div class="section-action">
                <a href="{{ route('kegiatan.index') }}" class="secondary-button">Lihat Semua Kegiatan</a>
            </div>
        </div>
    </section>

    <section id="prestasi" class="content-section alternate-section">
        <div class="section-container">
            <div class="section-heading">
                <h2>Prestasi Siswa</h2>
            </div>

            <div class="achievement-grid">
                @forelse($prestasi as $item)
                    <article class="achievement-card">
                        <div class="achievement-image">
                            <img src="{{ $item->foto_url }}" alt="{{ $item->judul }}">
                        </div>
                        <div class="achievement-info">
                            <span class="achievement-year"><i class="fa-solid fa-trophy me-1"></i> Tahun {{ $item->tahun }}</span>
                            <h3>{{ $item->judul }}</h3>
                            @if($item->nama_peraih)
                                <p class="achievement-winner"><strong>Peraih:</strong> {{ $item->nama_peraih }}</p>
                            @endif
                            <a href="{{ route('prestasi.show', $item->slug) }}" class="activity-link">Selengkapnya &rarr;</a>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Belum ada prestasi yang dipublikasikan.</p>
                @endforelse
            </div>

            <div class="section-action">
                <a href="{{ route('prestasi.index') }}" class="secondary-button">Lihat Semua Prestasi</a>
            </div>
        </div>
    </section>

    <section id="ekstrakurikuler" class="content-section">
        <div class="section-container">
            <div class="section-heading">
                <h2>Ekstrakurikuler</h2>
            </div>

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
