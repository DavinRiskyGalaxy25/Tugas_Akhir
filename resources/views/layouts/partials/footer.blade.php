<footer class="site-footer">
    <!-- SVG ANIMATED MOVING WAVES DIVIDER -->
    <div class="footer-wave-divider" aria-hidden="true">
        <!-- Layer 1: Back Luminous Ripple (Moves gently to the right) -->
        <div class="wave-track wave-track-1">
            <svg viewBox="0 0 2880 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,45 C90,18 270,18 360,45 C450,72 630,72 720,45 C810,18 990,18 1080,45 C1170,72 1350,72 1440,45 C1530,18 1710,18 1800,45 C1890,72 2070,72 2160,45 C2250,18 2430,18 2520,45 C2610,72 2790,72 2880,45 L2880,120 L0,120 Z" fill="rgba(34, 197, 94, 0.25)"></path>
            </svg>
        </div>
        <!-- Layer 2: Mid Emerald Flow (Moves counter-direction to the left) -->
        <div class="wave-track wave-track-2">
            <svg viewBox="0 0 2880 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,58 C90,84 270,84 360,58 C450,32 630,32 720,58 C810,84 990,84 1080,58 C1170,32 1350,32 1440,58 C1530,84 1710,84 1800,58 C1890,32 2070,32 2160,58 C2250,84 2430,84 2520,58 C2610,32 2790,32 2880,58 L2880,120 L0,120 Z" fill="rgba(16, 185, 129, 0.38)"></path>
            </svg>
        </div>
        <!-- Layer 3: Foreground Main Dark Wave (Flows smoothly into footer body) -->
        <div class="wave-track wave-track-3">
            <svg viewBox="0 0 2880 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,72 C60,52 180,52 240,72 C300,92 420,92 480,72 C540,52 660,52 720,72 C780,92 900,92 960,72 C1020,52 1140,52 1200,72 C1260,92 1380,92 1440,72 C1500,52 1620,52 1680,72 C1740,92 1860,92 1920,72 C1980,52 2100,52 2160,72 C2220,92 2340,92 2400,72 C2460,52 2580,52 2640,72 C2700,92 2820,92 2880,72 L2880,120 L0,120 Z" fill="#072113"></path>
            </svg>
        </div>
    </div>

    <!-- LUMINOUS ACCENT BORDER LINE -->
    <div class="footer-accent-line" aria-hidden="true"></div>

    <!-- AMBIENT GLOW ORBS -->
    <div class="footer-ambient-glow glow-1" aria-hidden="true"></div>
    <div class="footer-ambient-glow glow-2" aria-hidden="true"></div>

    <!-- GEOMETRIC ISLAMIC LATTICE PATTERN BACKGROUND -->
    <div class="footer-pattern-overlay" aria-hidden="true">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="islamicLatticePattern" width="100" height="100" patternUnits="userSpaceOnUse">
                    <!-- Diagonal guideline dashes -->
                    <line x1="0" y1="0" x2="100" y2="100" stroke="currentColor" stroke-width="0.5" opacity="0.25" stroke-dasharray="3 4"/>
                    <line x1="100" y1="0" x2="0" y2="100" stroke="currentColor" stroke-width="0.5" opacity="0.25" stroke-dasharray="3 4"/>
                    <!-- 8-Pointed Star (Rub el Hizb) Center -->
                    <polygon points="50,28 55,41 68,36 63,49 76,54 63,59 68,72 55,67 50,80 45,67 32,72 37,59 24,54 37,49 32,36 45,41" fill="none" stroke="currentColor" stroke-width="0.9" opacity="0.6"/>
                    <circle cx="50" cy="50" r="5" fill="none" stroke="currentColor" stroke-width="0.7" opacity="0.45"/>
                    <circle cx="50" cy="50" r="1.5" fill="currentColor" opacity="0.6"/>
                    <!-- Corner Stars & Nodes -->
                    <circle cx="0" cy="0" r="2.5" fill="currentColor" opacity="0.4"/>
                    <circle cx="100" cy="0" r="2.5" fill="currentColor" opacity="0.4"/>
                    <circle cx="0" cy="100" r="2.5" fill="currentColor" opacity="0.4"/>
                    <circle cx="100" cy="100" r="2.5" fill="currentColor" opacity="0.4"/>
                    <circle cx="50" cy="0" r="2" fill="currentColor" opacity="0.35"/>
                    <circle cx="50" cy="100" r="2.5" fill="currentColor" opacity="0.35"/>
                    <circle cx="0" cy="50" r="2" fill="currentColor" opacity="0.35"/>
                    <circle cx="100" cy="50" r="2.5" fill="currentColor" opacity="0.35"/>
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

            <!-- PETA SITUS / NAVIGASI -->
            <div class="footer-column">
                <h3>Navigasi Cepat</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Beranda Utama</a></li>
                    <li><a href="{{ route('profil') }}#tentang">Tentang &amp; Sejarah</a></li>
                    <li><a href="{{ route('profil') }}#visi-misi">Visi &amp; Misi</a></li>
                    <li><a href="{{ route('profil') }}#struktur">Struktur Organisasi</a></li>
                    <li><a href="{{ route('akademik') }}#guru">Tenaga Pendidik &amp; Staf</a></li>
                    <li><a href="{{ route('kesiswaan') }}#prestasi">Galeri Prestasi</a></li>
                    <li><a href="{{ route('ppdb.create') }}">Pendaftaran SPMB Online</a></li>
                    <li><a href="{{ route('kontak') }}">Hubungi Sekolah</a></li>
                    <li><a href="{{ route('admin.login') }}">Portal Guru &amp; Staf</a></li>
                </ul>
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
            <a href="#siteHeader" class="footer-back-top" aria-label="Kembali ke atas">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
        </div>
    </div>
</footer>

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

<div class="toast" id="toast"></div>
