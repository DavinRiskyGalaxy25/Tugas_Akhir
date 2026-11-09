<footer class="site-footer">
    <!-- SVG ANIMATED MOVING WAVES DIVIDER -->
    <div class="footer-wave-divider" aria-hidden="true">
        <!-- Layer 1: Back Luminous Ripple (Moves gently to the right) -->
        <div class="wave-track wave-track-1">
            <svg viewBox="0 0 2880 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,74 C180,54 180,54 360,74 C540,94 540,94 720,74 C900,54 900,54 1080,74 C1260,94 1260,94 1440,74 C1620,54 1620,54 1800,74 C1980,94 1980,94 2160,74 C2340,54 2340,54 2520,74 C2700,94 2700,94 2880,74 L2880,0 L0,0 Z" fill="rgba(34, 197, 94, 0.28)"></path>
            </svg>
        </div>
        <!-- Layer 2: Mid Emerald Flow (Moves counter-direction to the left) -->
        <div class="wave-track wave-track-2">
            <svg viewBox="0 0 2880 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,56 C90,74 270,74 360,56 C450,38 630,38 720,56 C810,74 990,74 1080,56 C1170,38 1350,38 1440,56 C1530,74 1710,74 1800,56 C1890,38 2070,38 2160,56 C2250,74 2430,74 2520,56 C2610,38 2790,38 2880,56 L2880,0 L0,0 Z" fill="rgba(16, 185, 129, 0.45)"></path>
            </svg>
        </div>
        <!-- Layer 3: Foreground Clean White Wave (Serves as organic divider between body and footer) -->
        <div class="wave-track wave-track-3">
            <svg viewBox="0 0 2880 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,38 C90,22 270,22 360,38 C450,54 630,54 720,38 C810,22 990,22 1080,38 C1170,54 1350,54 1440,38 C1530,22 1710,22 1800,38 C1890,54 2070,54 2160,38 C2250,22 2430,22 2520,38 C2610,54 2790,54 2880,38 L2880,0 L0,0 Z" fill="var(--footer-wave-fill, #ffffff)"></path>
            </svg>
        </div>
    </div>

    <!-- AMBIENT GLOW ORBS -->
    <div class="footer-ambient-glow glow-1" aria-hidden="true"></div>
    <div class="footer-ambient-glow glow-2" aria-hidden="true"></div>

    <!-- GEOMETRIC ISLAMIC STAR PATTERN BACKGROUND (CLEAN STARS ONLY) -->
    <div class="footer-pattern-overlay" aria-hidden="true">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <g id="footerStar">
                    <polygon points="0,-24 5,-10 17,-17 10,-5 24,0 10,5 17,17 5,10 0,24 -5,10 -17,17 -10,5 -24,0 -10,-5 -17,-17 -5,-10" fill="none" stroke="currentColor" stroke-width="0.9" opacity="0.55"/>
                    <polygon points="0,-13 3,-6 9,-9 6,-3 13,0 6,3 9,9 3,6 0,13 -3,6 -9,9 -6,3 -13,0 -6,-3 -9,-9 -3,-6" fill="none" stroke="currentColor" stroke-width="0.6" opacity="0.32"/>
                </g>
                <pattern id="islamicLatticePattern" width="120" height="120" patternUnits="userSpaceOnUse">
                    <use href="#footerStar" x="60" y="60"/>
                    <use href="#footerStar" x="0" y="0"/>
                    <use href="#footerStar" x="120" y="0"/>
                    <use href="#footerStar" x="0" y="120"/>
                    <use href="#footerStar" x="120" y="120"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#islamicLatticePattern)" />
        </svg>
    </div>

    <div class="footer-main">
        <div class="footer-container">
            <!-- BRAND & IDENTITAS -->
            <div class="footer-column footer-brand-column">
                <a href="{{ route('home') }}" class="footer-brand">
                    <img src="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}" alt="Logo {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}">
                    <div>
                        <strong>{{ $pengaturan['nama_sekolah'] ?? 'SMP AL AHMAD KRIAN' }}</strong>
                        <span>Mencetak Generasi Berakhlak &amp; Berprestasi</span>
                    </div>
                </a>
                <p class="footer-description">
                    {{ $pengaturan['deskripsi'] ?? 'Sekolah Menengah Pertama yang berkomitmen membangun insan berkarakter mulia, mandiri, berilmu amaliah, dan siap menjawab tantangan masa depan.' }}
                </p>

                <div class="footer-social">
                    @if(!empty($pengaturan['whatsapp']))
                        <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    @endif
                    @if(!empty($pengaturan['instagram']))
                        <a href="{{ $pengaturan['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if(!empty($pengaturan['facebook']))
                        <a href="{{ $pengaturan['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    @endif
                    @if(!empty($pengaturan['youtube']))
                        <a href="{{ $pengaturan['youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                    @if(!empty($pengaturan['tiktok']))
                        <a href="{{ $pengaturan['tiktok'] }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    @endif
                </div>
            </div>

            <!-- KONTAK & JAM OPERASIONAL -->
            <div class="footer-column">
                <h3>Hubungi Kami</h3>
                <div class="footer-contact-list">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian') }}" target="_blank" rel="noopener noreferrer" class="footer-contact">
                        <span class="footer-contact-icon"><i class="fa-solid fa-location-dot"></i></span>
                        <span>{{ $pengaturan['alamat'] ?? 'Jl. Mojosantren Krian, Kec. Krian, Kab. Sidoarjo, Jawa Timur' }}</span>
                    </a>
                    <a href="tel:{{ $pengaturan['telepon'] ?? '03199892622' }}" class="footer-contact">
                        <span class="footer-contact-icon"><i class="fa-solid fa-phone"></i></span>
                        <span>{{ $pengaturan['telepon'] ?? '03199892622' }}</span>
                    </a>
                    <a href="mailto:{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}" class="footer-contact">
                        <span class="footer-contact-icon"><i class="fa-solid fa-envelope"></i></span>
                        <span>{{ $pengaturan['email'] ?? 'smpalahmad1977@gmail.com' }}</span>
                    </a>
                    @if(!empty($pengaturan['whatsapp']))
                    <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="footer-contact whatsapp-highlight">
                        <span class="footer-contact-icon"><i class="fa-brands fa-whatsapp"></i></span>
                        <span>WhatsApp Layanan SPMB</span>
                    </a>
                    @endif
                </div>

                <div class="footer-hours-badge">
                    <i class="fa-regular fa-clock"></i>
                    <div>
                        <small>Jam Layanan Tata Usaha:</small>
                        <strong>Senin &ndash; Kamis: 07.00 &ndash; 15.00 WIB</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <div class="footer-bottom-text">
                <p>&copy; {{ date('Y') }} {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}. Seluruh hak cipta dilindungi undang-undang.</p>
                <p class="footer-credits">Supported by RPL SMK Krian 1 Sidoarjo &middot; <a href="{{ route('admin.login') }}" style="color: inherit; text-decoration: none; opacity: 0.85;" title="Login Staf / Administrator">Portal Staf</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- TOMBOL KEMBALI KE ATAS MELAYANG (GAME-HUD MINIMALIST BACK TO TOP) -->
<button type="button" id="floatingBackToTop" class="floating-back-to-top" aria-label="Kembali ke atas" title="Kembali ke atas">
    <svg class="progress-ring" viewBox="0 0 44 44" aria-hidden="true">
        <circle class="progress-ring-bg" cx="22" cy="22" r="20.5"></circle>
        <circle class="progress-ring-fill" id="progressRingFill" cx="22" cy="22" r="20.5"></circle>
    </svg>
    <span class="back-to-top-icon">
        <i class="fa-solid fa-arrow-up"></i>
    </span>
</button>

<!-- PENCARIAN MODAL OVERLAY -->
<div class="search-overlay" id="searchOverlay">
    <div class="search-modal">
        <button class="modal-close" type="button" aria-label="Tutup pencarian"><i class="fa-solid fa-xmark"></i></button>
        <span class="section-label">PENCARIAN</span>
        <h2>Cari informasi sekolah</h2>
        <div class="search-field">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Cari sejarah, guru, fasilitas, prestasi...">
        </div>
        <div id="searchResults" class="search-results">
            <p class="search-empty">Ketik kata yang ingin dicari.</p>
        </div>
    </div>
</div>

<!-- MODAL DETAIL GURU (FOTO DIPERBESAR DI KIRI & INFORMASI DI KANAN) -->
<div class="teacher-modal-overlay" id="teacherModal" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="teacher-modal-backdrop" id="teacherModalBackdrop"></div>
    <div class="teacher-modal-dialog">
        <button type="button" class="teacher-modal-close" id="teacherModalClose" aria-label="Tutup detail guru">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="teacher-modal-body">
            <!-- Kolom Kiri: Foto Guru Diperbesar -->
            <div class="teacher-modal-photo-col">
                <div class="teacher-modal-photo-wrap">
                    <img src="" alt="" id="teacherModalImg" class="teacher-modal-img">
                </div>
            </div>
            <!-- Kolom Kanan: Informasi Guru -->
            <div class="teacher-modal-info-col">
                <div class="teacher-modal-header">
                    <span class="teacher-modal-badge" id="teacherModalJabatan">GURU</span>
                    <h3 class="teacher-modal-name" id="teacherModalName">Nama Guru</h3>
                </div>
                <div class="teacher-modal-details">
                    <div class="teacher-modal-detail-item" id="teacherModalMapelRow">
                        <div class="detail-icon"><i class="fa-solid fa-book-open"></i></div>
                        <div class="detail-content">
                            <span class="detail-label">Mata Pelajaran</span>
                            <strong class="detail-val" id="teacherModalMapel">-</strong>
                        </div>
                    </div>
                    <div class="teacher-modal-detail-item" id="teacherModalNipRow">
                        <div class="detail-icon"><i class="fa-solid fa-id-card"></i></div>
                        <div class="detail-content">
                            <span class="detail-label">NIP / NIK</span>
                            <strong class="detail-val" id="teacherModalNip">-</strong>
                        </div>
                    </div>
                    <div class="teacher-modal-detail-item" id="teacherModalDescRow">
                        <div class="detail-icon"><i class="fa-solid fa-circle-info"></i></div>
                        <div class="detail-content">
                            <span class="detail-label">Keterangan / Profil</span>
                            <p class="detail-val" id="teacherModalDesc">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>
