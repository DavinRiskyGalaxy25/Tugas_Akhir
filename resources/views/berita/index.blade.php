@extends('layouts.app')

@section('title', 'Berita - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main>
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Berita &amp; Pengumuman</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container">
            <div class="news-page-grid">
                @forelse($berita as $item)
                    <article class="news-page-card">
                        <div class="news-page-image">
                            <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}">
                        </div>
                        <div class="news-page-info">
                            <h3>{{ $item->judul }}</h3>
                            <a href="{{ route('berita.show', $item->slug) }}" class="text-button">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>

            <div class="pagination-wrapper">
                {{ $berita->links() }}
            </div>
        </div>
    </section>
</main>
@endsection
