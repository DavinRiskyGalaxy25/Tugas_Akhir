@extends('layouts.app')

@section('title', $kegiatan->nama_kegiatan . ' - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main>
    <section class="content-section">
        <div class="section-container">
            <a href="{{ route('kegiatan.index') }}" class="back-to-page">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke semua kegiatan
            </a>

            <article class="news-detail">
                <div class="news-detail-heading">
                    <span>{{ optional($kegiatan->tanggal)->translatedFormat('d F Y') ?? '' }}@if($kegiatan->lokasi) &middot; {{ $kegiatan->lokasi }} @endif</span>
                    <h1>{{ $kegiatan->nama_kegiatan }}</h1>
                </div>

                <div class="news-detail-gallery">
                    <div class="news-detail-image">
                        <img src="{{ $kegiatan->foto_url }}" alt="{{ $kegiatan->nama_kegiatan }}">
                    </div>
                </div>

                <div class="news-detail-content">
                    {!! nl2br(e($kegiatan->deskripsi)) !!}
                </div>
            </article>

            @if($lainnya->isNotEmpty())
                <div class="section-heading" style="margin-top:48px;">
                    <h2>Kegiatan Lainnya</h2>
                </div>
                <div class="activity-page-grid">
                    @foreach($lainnya as $item)
                        <article class="activity-card">
                            <div class="activity-image">
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama_kegiatan }}">
                            </div>
                            <div class="activity-info">
                                <span>{{ optional($item->tanggal)->translatedFormat('d F Y') ?? '' }}</span>
                                <h3>{{ $item->nama_kegiatan }}</h3>
                                <a href="{{ route('kegiatan.show', $item->slug) }}" class="text-button">
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
