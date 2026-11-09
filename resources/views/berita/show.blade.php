@extends('layouts.app')

@section('title', $berita->judul . ' - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main>
    <section class="content-section">
        <div class="section-container">
            <a href="{{ route('berita.index') }}" class="back-to-page">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke semua berita
            </a>

            <article class="news-detail">
                <div class="news-detail-heading">
                    <span>{{ optional($berita->tanggal_publikasi)->translatedFormat('d F Y') ?? '' }}</span>
                    <h1>{{ $berita->judul }}</h1>
                    @if($berita->penulis)<p><small>Oleh {{ $berita->penulis }}</small></p>@endif
                </div>

                <div class="news-detail-gallery">
                    <div class="news-detail-image">
                        <img src="{{ $berita->thumbnail_url }}" alt="{{ $berita->judul }}">
                    </div>
                </div>

                <div class="news-detail-content">
                    {!! nl2br(e($berita->isi)) !!}
                </div>
            </article>

            @if($lainnya->isNotEmpty())
                <div class="section-heading" style="margin-top:48px;">
                    <h2>Berita Lainnya</h2>
                </div>
                <div class="news-page-grid">
                    @foreach($lainnya as $item)
                        <article class="news-page-card">
                            <div class="news-page-image">
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}">
                            </div>
                            <div class="news-page-info">
                                <span>{{ optional($item->tanggal_publikasi)->translatedFormat('d F Y') ?? '' }}</span>
                                <h3>{{ $item->judul }}</h3>
                                <a href="{{ route('berita.show', $item->slug) }}" class="text-button">
                                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
