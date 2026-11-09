@extends('layouts.app')

@section('title', 'Kontak - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <span class="section-label">KONTAK KAMI</span>
            <h2>Hubungi {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</h2>
            <p>Silakan hubungi kami untuk informasi seputar pendaftaran, akademik, dan layanan sekolah.</p>
        </div>
    </section>

    <!-- SECTION KARTU SALURAN KONTAK -->
    <section class="content-section">
        <div class="section-container">
            <div class="section-heading center">
                <span class="section-label">SALURAN KOMUNIKASI</span>
                <h2>Layanan Informasi &amp; Kontak Resmi</h2>
                <p>Pilih saluran komunikasi yang paling nyaman bagi Anda.</p>
            </div>

            <div class="contact-channels-grid">
                <!-- WHATSAPP -->
                @if(!empty($pengaturan['whatsapp']))
                <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="channel-card whatsapp">
                    <div class="channel-icon"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="channel-info">
                        <small>Respon Cepat</small>
                        <h3>WhatsApp Resmi</h3>
                        <p>Chat langsung dengan panitia SPMB / layanan tata usaha sekolah.</p>
                        <span class="channel-action">Kirim Pesan WhatsApp &rarr;</span>
                    </div>
                </a>
                @endif

                <!-- TELEPON -->
                <a href="tel:{{ $pengaturan['telepon'] ?? '03199892622' }}" class="channel-card phone">
                    <div class="channel-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="channel-info">
                        <small>Panggilan Suara</small>
                        <h3>Telepon Kantor</h3>
                        <p>{{ $pengaturan['telepon'] ?? '03199892622' }}</p>
                        <span class="channel-action">Hubungi Sekarang &rarr;</span>
                    </div>
                </a>

                <!-- EMAIL -->
                <a href="mailto:{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}" class="channel-card email">
                    <div class="channel-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="channel-info">
                        <small>Surat Elektronik</small>
                        <h3>Email Resmi</h3>
                        <p>{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}</p>
                        <span class="channel-action">Kirim Email &rarr;</span>
                    </div>
                </a>

                <!-- INSTAGRAM -->
                @if(!empty($pengaturan['instagram']))
                <a href="{{ $pengaturan['instagram'] }}" target="_blank" rel="noopener noreferrer" class="channel-card instagram">
                    <div class="channel-icon"><i class="fa-brands fa-instagram"></i></div>
                    <div class="channel-info">
                        <small>Dokumentasi &amp; Info</small>
                        <h3>Instagram</h3>
                        <p>Ikuti update berita dan aktivitas harian siswa di Instagram.</p>
                        <span class="channel-action">Kunjungi Profil &rarr;</span>
                    </div>
                </a>
                @endif

                <!-- YOUTUBE -->
                @if(!empty($pengaturan['youtube']))
                <a href="{{ $pengaturan['youtube'] }}" target="_blank" rel="noopener noreferrer" class="channel-card youtube">
                    <div class="channel-icon"><i class="fa-brands fa-youtube"></i></div>
                    <div class="channel-info">
                        <small>Video &amp; Dokumentasi</small>
                        <h3>YouTube Channel</h3>
                        <p>Tonton liputan kegiatan, pentas karya, dan profil sekolah.</p>
                        <span class="channel-action">Tonton Video &rarr;</span>
                    </div>
                </a>
                @endif

                <!-- TIKTOK -->
                @if(!empty($pengaturan['tiktok']))
                <a href="{{ $pengaturan['tiktok'] }}" target="_blank" rel="noopener noreferrer" class="channel-card tiktok">
                    <div class="channel-icon"><i class="fa-brands fa-tiktok"></i></div>
                    <div class="channel-info">
                        <small>Kreativitas Siswa</small>
                        <h3>TikTok</h3>
                        <p>Konten kreatif dan keceriaan siswa-siswi SMP Al Ahmad.</p>
                        <span class="channel-action">Lihat Konten &rarr;</span>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION ALAMAT, JAM LAYANAN & PETA -->
    <section class="content-section alternate-section">
        <div class="section-container">
            <div class="contact-details-grid">
                <!-- INFO ALAMAT & JAM LAYANAN -->
                <div class="contact-text-card">
                    <div class="section-heading left mb-4">
                        <span class="section-label">LOKASI &amp; WAKTU LAYANAN</span>
                        <h2>Kunjungi Sekolah Kami</h2>
                        <p>Kami menyambut hangat kunjungan bapak/ibu orang tua dan calon peserta didik baru.</p>
                    </div>

                    <div class="info-item mb-4">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h4>Alamat Lengkap</h4>
                            <p>{{ $pengaturan['alamat'] ?? 'Jl Mojosantren Krian, Kec. Krian, Kab. Sidoarjo, Prov. Jawa Timur' }}</p>
                        </div>
                    </div>

                    <div class="info-item mb-4">
                        <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
                        <div>
                            <h4>Jam Operasional Layanan</h4>
                            <ul class="schedule-list">
                                <li><span>Senin &ndash; Kamis:</span> <strong>07.00 &ndash; 15.00 WIB</strong></li>
                                <li><span>Jum'at:</span> <strong>07.00 &ndash; 11.30 WIB</strong></li>
                                <li><span>Sabtu:</span> <strong>07.00 &ndash; 13.00 WIB</strong></li>
                                <li><span>Minggu &amp; Libur Nasional:</span> <strong class="text-danger">Tutup</strong></li>
                            </ul>
                        </div>
                    </div>

                    @if(!empty($pengaturan['whatsapp']))
                    <div class="mt-4">
                        <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="primary-button">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp Panitia
                        </a>
                    </div>
                    @endif
                </div>

                <!-- GOOGLE MAPS -->
                <div class="contact-map-frame">
                    <iframe src="https://www.google.com/maps?q={{ urlencode($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian') }}&output=embed" width="100%" height="100%" style="border:0; min-height: 400px; border-radius: 16px;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

