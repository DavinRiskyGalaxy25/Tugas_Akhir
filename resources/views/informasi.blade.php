@extends('layouts.app')

@section('title', 'Informasi - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">

    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Informasi Sekolah</h2>
        </div>
    </section>

    <section id="berita" class="content-section">
        <div class="section-heading">
            <span class="section-label">BERITA</span>
            <h2>Berita Terbaru</h2>
        </div>

        <div class="news-page-grid">
            @forelse($berita as $item)
                <article class="news-page-card">
                    <div class="news-page-image">
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}">
                    </div>
                    <div class="news-page-info">
                        <span>{{ $item->tanggal_publikasi->translatedFormat('d F Y') }}</span>
                        <h3>{{ $item->judul }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('berita.show', $item->slug) }}" class="text-button">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            @empty
                <p class="empty-state">Belum ada berita yang dipublikasikan.</p>
            @endforelse
        </div>

        <div class="section-action">
            <a href="{{ route('berita.index') }}" class="secondary-button">Lihat Semua Berita</a>
        </div>
    </section>

    <section id="alumni" class="content-section">
        <div class="section-heading alumni-heading">
            <span class="section-label">ALUMNI</span>
            <h2>Kesan &amp; Pesan Alumni</h2>
            <p>Cerita dan pengalaman dari para alumni {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}.</p>
        </div>

        <div class="alumni-slider-wrapper">
            @php $alumniTerbaru = \App\Models\Alumni::published()->latest()->take(9)->get(); @endphp

            @if($alumniTerbaru->isNotEmpty())
                <div class="alumni-slider">
                    <div id="alumniList" class="alumni-track">
                        @foreach($alumniTerbaru as $al)
                            <div class="alumni-card">
                                <p>&ldquo;{{ $al->pesan_kesan }}&rdquo;</p>
                                <strong>{{ $al->nama }}</strong>
                                <span>Alumni {{ $al->tahun_lulus }}@if($al->pekerjaan_sekarang) &middot; {{ $al->pekerjaan_sekarang }} @endif</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div id="alumniEmpty" class="alumni-empty">
                    <i class="fa-regular fa-comment-dots"></i>
                    <h3>Belum ada kesan &amp; pesan</h3>
                    <p>Jadilah alumni pertama yang membagikan pengalaman selama bersekolah di {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}.</p>
                </div>
            @endif
        </div>

        <div class="alumni-action">
            <a href="{{ route('alumni.create') }}" class="primary-button">
                <i class="fa-solid fa-pen"></i> Tulis Pesan &amp; Kesan
            </a>
        </div>
    </section>

    <section id="ppdb" class="content-section ppdb-section">
        <div class="section-container">
            <div class="section-heading center">
                <span class="section-label">PPDB / SPMB</span>
                <h2>Penerimaan Murid Baru</h2>
                <p>Informasi penerimaan murid baru {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
            </div>

            <div class="ppdb-poster">
                <div class="ppdb-poster-placeholder">
                    <i class="fa-regular fa-image"></i>
                    <h3>Tempat Poster PPDB</h3>
                    <p>Poster penerimaan murid baru {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</p>
                    <span>Poster belum tersedia</span>
                </div>
            </div>

            <div class="ppdb-actions">
                <a href="{{ route('ppdb.create') }}" class="primary-button">
                    <i class="fa-solid fa-file-pen"></i> Isi Formulir Pendaftaran
                </a>
            </div>
        </div>
    </section>

    <section id="kontak" class="content-section alternate-section">
        <div class="section-heading">
            <span class="section-label">KONTAK</span>
            <h2>Hubungi {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</h2>
        </div>

        <div class="contact-layout">
            <div class="contact-details">
                @if(!empty($pengaturan['whatsapp']))
                <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="contact-box">
                    <span class="contact-box-icon whatsapp"><i class="fa-brands fa-whatsapp"></i></span>
                    <span><small>WhatsApp</small><strong>Chat Sekarang</strong></span>
                </a>
                @endif
                @if(!empty($pengaturan['instagram']))
                <a href="{{ $pengaturan['instagram'] }}" target="_blank" rel="noopener noreferrer" class="contact-box">
                    <span class="contact-box-icon instagram"><i class="fa-brands fa-instagram"></i></span>
                    <span><small>Instagram</small><strong>Kunjungi</strong></span>
                </a>
                @endif
                @if(!empty($pengaturan['youtube']))
                <a href="{{ $pengaturan['youtube'] }}" target="_blank" rel="noopener noreferrer" class="contact-box">
                    <span class="contact-box-icon youtube"><i class="fa-brands fa-youtube"></i></span>
                    <span><small>YouTube</small><strong>{{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</strong></span>
                </a>
                @endif
                @if(!empty($pengaturan['tiktok']))
                <a href="{{ $pengaturan['tiktok'] }}" target="_blank" rel="noopener noreferrer" class="contact-box">
                    <span class="contact-box-icon tiktok"><i class="fa-brands fa-tiktok"></i></span>
                    <span><small>TikTok</small><strong>Kunjungi</strong></span>
                </a>
                @endif
                <a href="mailto:{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}" class="contact-box">
                    <span class="contact-box-icon email"><i class="fa-solid fa-envelope"></i></span>
                    <span><small>Email</small><strong>{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}</strong></span>
                </a>
                <a href="tel:{{ $pengaturan['telepon'] ?? '03199892622' }}" class="contact-box">
                    <span class="contact-box-icon phone"><i class="fa-solid fa-phone"></i></span>
                    <span><small>Telepon</small><strong>{{ $pengaturan['telepon'] ?? '03199892622' }}</strong></span>
                </a>
            </div>

            <div class="map-card">
                <iframe src="https://www.google.com/maps?q={{ urlencode($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian') }}&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

</main>
@endsection
