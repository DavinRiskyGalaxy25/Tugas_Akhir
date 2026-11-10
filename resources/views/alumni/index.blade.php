@extends('layouts.app')

@section('title', 'Kesan & Pesan Alumni - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Kesan &amp; Pesan Alumni</h2>
        </div>
    </section>

    @if(session('success'))
        <div class="section-container" style="margin-top: 30px; margin-bottom: -10px;">
            <div class="alert-box success" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <section class="content-section">
        <div class="section-container">
            <!-- ALUMNI CTA BANNER (MODERN, CLEAN, BORDERLESS) -->
            <div class="alumni-hero-cta">
                <div class="alumni-cta-content">
                    <span class="alumni-badge"><i class="fa-solid fa-graduation-cap me-1"></i> Jejak Langkah Alumni</span>
                    <h2 class="alumni-cta-title">Cerita &amp; Inspirasi dari Alumni</h2>
                    <p class="alumni-cta-desc">
                        Simak pengalaman berharga dari para alumni {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}. Apakah Anda juga bagian dari keluarga besar alumni? Bagikan cerita dan pesan inspiratif Anda!
                    </p>
                </div>
                <div class="alumni-cta-action">
                    <a href="{{ route('alumni.create') }}" class="primary-button alumni-send-btn">
                        <i class="fa-solid fa-feather-pointed me-2"></i>
                        <span>Kirim Pesan Alumni</span>
                    </a>
                </div>
            </div>

            <!-- ALUMNI STORIES GRID -->
            @if($alumni->isNotEmpty())
                <div class="alumni-stories-grid">
                    @foreach($alumni as $al)
                        <article class="alumni-card">
                            <div class="alumni-card-top">
                                <div class="alumni-stars" title="Rating: {{ $al->rating ?? 5 }} / 5 Bintang">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= ($al->rating ?? 5) ? 'star-gold' : 'star-muted' }}"></i>
                                    @endfor
                                    <span class="alumni-stars-val">{{ $al->rating ?? 5 }}.0</span>
                                </div>
                                <div class="alumni-quote-mark">
                                    <i class="fa-solid fa-quote-right"></i>
                                </div>
                            </div>

                            <blockquote class="alumni-quote-text">
                                &ldquo;{{ $al->pesan_kesan }}&rdquo;
                            </blockquote>

                            <div class="alumni-author-meta">
                                <div class="alumni-avatar-badge">
                                    {{ strtoupper(substr($al->nama, 0, 1)) }}
                                </div>
                                <div class="alumni-author-details">
                                    <h3 class="alumni-name">{{ $al->nama }}</h3>
                                    <div class="alumni-sub">
                                        @if($al->tahun_lulus)
                                            <span class="alumni-tag">Lulusan {{ $al->tahun_lulus }}</span>
                                        @endif
                                        @if($al->pekerjaan_sekarang)
                                            <span class="alumni-job">{{ $al->pekerjaan_sekarang }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="pagination-wrapper" style="margin-top: 40px;">
                    {{ $alumni->links() }}
                </div>
            @else
                <div class="empty-state-box">
                    <div class="empty-icon"><i class="fa-solid fa-comment-dots"></i></div>
                    <h3>Belum Ada Pesan Alumni yang Dipublikasikan</h3>
                    <p>Jadilah yang pertama membagikan kisah, pesan, dan kesan berharga Anda!</p>
                    <a href="{{ route('alumni.create') }}" class="primary-button mt-3">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Tulis Pesan Pertama
                    </a>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
