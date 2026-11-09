<footer class="site-footer">
    <!-- SVG MULTI-LAYER ORGANIC WAVE DIVIDER -->
    <div class="footer-wave-divider" aria-hidden="true">
        <svg viewBox="0 0 1440 120" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Layer 1: Back Luminous Ripple -->
            <path d="M0,32 C240,90 480,10 720,50 C960,90 1200,20 1440,60 L1440,120 L0,120 Z" fill="rgba(34, 197, 94, 0.12)"></path>
            <!-- Layer 2: Mid Emerald Flow -->
            <path d="M0,52 C320,105 540,25 820,65 C1100,105 1280,35 1440,75 L1440,120 L0,120 Z" fill="rgba(16, 185, 129, 0.22)"></path>
            <!-- Layer 3: Foreground Main Dark Wave -->
            <path d="M0,72 C280,115 520,45 780,82 C1040,115 1240,55 1440,88 L1440,120 L0,120 Z" fill="#072113"></path>
        </svg>
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
