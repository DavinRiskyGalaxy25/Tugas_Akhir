@extends('layouts.app')

@section('title', 'Kontak - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Kontak Kami</h2>
        </div>
    </section>

    <!-- SECTION SALURAN KONTAK RESMI & MEDIA SOSIAL -->
    <section class="content-section">
        <div class="section-container">
            <div class="contact-channels-grid">
                <!-- WHATSAPP -->
                @if(!empty($pengaturan['whatsapp']))
                <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="channel-card whatsapp">
                    <div class="channel-icon"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="channel-info">
                        <h3>WhatsApp</h3>
                        <p>{{ str_replace(['https://wa.me/62', 'https://wa.me/'], ['0', '0'], $pengaturan['whatsapp']) }}</p>
                    </div>
                </a>
                @endif

                <!-- TELEPON -->
                <a href="tel:{{ $pengaturan['telepon'] ?? '03199892622' }}" class="channel-card phone">
                    <div class="channel-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="channel-info">
                        <h3>Telepon</h3>
                        <p>{{ $pengaturan['telepon'] ?? '031 9989 2622' }}</p>
                    </div>
                </a>

                <!-- EMAIL -->
                <a href="mailto:{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}" class="channel-card email">
                    <div class="channel-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="channel-info">
                        <h3>Email</h3>
                        <p>{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}</p>
                    </div>
                </a>

                <!-- INSTAGRAM -->
                @if(!empty($pengaturan['instagram']))
                <a href="{{ $pengaturan['instagram'] }}" target="_blank" rel="noopener noreferrer" class="channel-card instagram">
                    <div class="channel-icon"><i class="fa-brands fa-instagram"></i></div>
                    <div class="channel-info">
                        <h3>Instagram</h3>
                        <p>{{ '@' . ltrim(parse_url($pengaturan['instagram'], PHP_URL_PATH) ?? 'smpalahmad.id', '/') }}</p>
                    </div>
                </a>
                @endif

                <!-- YOUTUBE -->
                @if(!empty($pengaturan['youtube']))
                <a href="{{ $pengaturan['youtube'] }}" target="_blank" rel="noopener noreferrer" class="channel-card youtube">
                    <div class="channel-icon"><i class="fa-brands fa-youtube"></i></div>
                    <div class="channel-info">
                        <h3>YouTube</h3>
                        <p>{{ ltrim(parse_url($pengaturan['youtube'], PHP_URL_PATH) ?? 'SMP Al Ahmad Krian', '/') }}</p>
                    </div>
                </a>
                @endif

                <!-- TIKTOK -->
                @if(!empty($pengaturan['tiktok']))
                <a href="{{ $pengaturan['tiktok'] }}" target="_blank" rel="noopener noreferrer" class="channel-card tiktok">
                    <div class="channel-icon"><i class="fa-brands fa-tiktok"></i></div>
                    <div class="channel-info">
                        <h3>TikTok</h3>
                        <p>{{ '@' . ltrim(parse_url($pengaturan['tiktok'], PHP_URL_PATH) ?? 'smpalahmad.id', '/@') }}</p>
                    </div>
                </a>
                @endif
            </div>

            <!-- SECTION ALAMAT, JAM LAYANAN & PETA -->
            <div class="contact-details-grid">
                <!-- ALAMAT & JAM LAYANAN -->
                <div class="contact-text-card">
                    <div class="contact-detail-block">
                        <div class="detail-label">ALAMAT SEKOLAH</div>
                        <h3 class="detail-title">{{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</h3>
                        <p class="detail-desc">{{ $pengaturan['alamat'] ?? 'Jl. Mojosantren Krian, Kec. Krian, Kab. Sidoarjo, Prov. Jawa Timur' }}</p>
                    </div>

                    <div class="contact-detail-divider"></div>

                    <div class="contact-detail-block">
                        <div class="detail-label">JAM OPERASIONAL</div>
                        <div class="schedule-clean">
                            <div class="schedule-row">
                                <span class="day">Senin &ndash; Kamis</span>
                                <span class="time">07.00 &ndash; 15.00 WIB</span>
                            </div>
                            <div class="schedule-row">
                                <span class="day">Jumat</span>
                                <span class="time">07.00 &ndash; 11.30 WIB</span>
                            </div>
                            <div class="schedule-row">
                                <span class="day">Sabtu</span>
                                <span class="time">07.00 &ndash; 13.00 WIB</span>
                            </div>
                            <div class="schedule-row text-muted">
                                <span class="day">Minggu &amp; Libur Nasional</span>
                                <span class="time">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GOOGLE MAPS -->
                <div class="contact-map-frame">
                    <iframe src="https://www.google.com/maps?q={{ urlencode($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian') }}&output=embed" width="100%" height="100%" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
