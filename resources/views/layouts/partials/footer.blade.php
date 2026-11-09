<footer class="site-footer">
    <!-- SVG ORGANIC WAVE DIVIDER -->
    <div class="footer-wave-divider" aria-hidden="true">
        <svg viewBox="0 0 1440 90" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,45 C320,85 480,10 720,40 C960,70 1120,20 1440,50 L1440,90 L0,90 Z" fill="currentColor"></path>
        </svg>
    </div>

    <!-- BOTANICAL LEAF SUBTLE PATTERN BACKGROUND -->
    <div class="footer-pattern-overlay" aria-hidden="true">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="botanicalLeafPattern" width="160" height="160" patternUnits="userSpaceOnUse">
                    <!-- Subtle natural botanical leaf motifs -->
                    <path d="M40,20 C45,35 60,45 80,45 C65,45 55,60 55,80 C50,65 35,55 15,55 C30,55 40,40 40,20 Z" fill="currentColor"/>
                    <path d="M120,100 C125,115 140,125 160,125 C145,125 135,140 135,160 C130,145 115,135 95,135 C110,135 120,120 120,100 Z" fill="currentColor"/>
                    <path d="M110,30 C125,25 135,40 130,55 C115,60 105,45 110,30 Z" fill="currentColor"/>
                    <path d="M30,110 C45,105 55,120 50,135 C35,140 25,125 30,110 Z" fill="currentColor"/>
                    <!-- Delicate branch strokes -->
                    <path d="M40,45 Q60,70 80,75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                    <path d="M120,125 Q140,150 160,155" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#botanicalLeafPattern)" />
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
