<header class="site-header {{ request()->routeIs('home') ? 'is-transparent-header' : 'is-solid-header' }}" id="siteHeader">
    <div class="header-container">
        <!-- BRAND LOGO & NAME -->
        <a href="{{ route('home') }}" class="brand-link">
            <img src="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}" alt="Logo {{ $pengaturan['nama_sekolah'] ?? 'SMP AL AHMAD KRIAN' }}" class="school-logo">
            <div class="brand-text">
                <span class="brand-title">{{ $pengaturan['nama_sekolah'] ?? 'SMP AL AHMAD' }}</span>
                <span class="brand-subtitle">KRIAN &middot; SIDOARJO</span>
            </div>
        </a>

        <!-- DESKTOP NAVBAR -->
        <nav class="navbar" id="mainNavbar">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"> Beranda </a>

            <div class="nav-dropdown menu-profil">
                <button class="dropdown-toggle" type="button" aria-haspopup="true">
                    Profil Sekolah <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('profil') }}#tentang"> Tentang Sekolah </a>
                    <a href="{{ route('profil') }}#sejarah"> Sejarah </a>
                    <a href="{{ route('profil') }}#visi-misi"> Visi &amp; Misi </a>
                    <a href="{{ route('profil') }}#identitas"> Identitas Sekolah </a>
                    <a href="{{ route('profil') }}#struktur"> Struktur Organisasi </a>
                </div>
            </div>

            <div class="nav-dropdown menu-akademik">
                <button class="dropdown-toggle" type="button" aria-haspopup="true">
                    Akademik <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('akademik') }}#guru"> Guru &amp; Tenaga Kependidikan </a>
                    <a href="{{ route('akademik') }}#fasilitas"> Fasilitas </a>
                </div>
            </div>

            <div class="nav-dropdown menu-kesiswaan">
                <button class="dropdown-toggle" type="button" aria-haspopup="true">
                    Kesiswaan <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('kesiswaan') }}#kegiatan"> Kegiatan </a>
                    <a href="{{ route('kesiswaan') }}#prestasi"> Prestasi </a>
                    <a href="{{ route('kesiswaan') }}#ekstrakurikuler"> Ekstrakurikuler </a>
                </div>
            </div>

            <div class="nav-dropdown menu-informasi">
                <button class="dropdown-toggle" type="button" aria-haspopup="true">
                    Informasi <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('berita.index') }}"> Berita </a>
                    <a href="{{ route('alumni.create') }}"> Alumni </a>
                    <a href="{{ route('ppdb.create') }}"> PPDB </a>
                    <a href="{{ route('kontak') }}"> Kontak </a>
                </div>
            </div>
        </nav>

        <!-- HEADER RIGHT ACTIONS -->
        <div class="header-actions">
            <button class="search-trigger" type="button" aria-label="Buka pencarian">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <a href="{{ route('ppdb.create') }}" class="nav-cta">
                <span>SPMB</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>

            <button class="mobile-menu-trigger" type="button" aria-label="Buka menu navigasi" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<!-- MOBILE OVERLAY & SIDEBAR DRAWER -->
<div class="mobile-overlay"></div>

<aside class="mobile-sidebar">
    <div class="mobile-sidebar-header">
        <div class="mobile-brand">
            <img src="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}" alt="Logo {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}">
            <div>
                <strong>{{ $pengaturan['nama_sekolah'] ?? 'SMP AL AHMAD KRIAN' }}</strong>
                <span>School Profile</span>
            </div>
        </div>
        <button class="mobile-close" type="button" aria-label="Tutup menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="mobile-sidebar-content">
        <a href="{{ route('home') }}" class="mobile-menu-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> <span>Beranda</span>
        </a>

        <!-- PROFIL SEKOLAH -->
        <div class="mobile-dropdown">
            <button type="button" class="mobile-dropdown-toggle">
                <span><i class="fa-solid fa-school"></i> Profil Sekolah</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content">
                <a href="{{ route('profil') }}#tentang">Tentang Sekolah</a>
                <a href="{{ route('profil') }}#sejarah">Sejarah</a>
                <a href="{{ route('profil') }}#visi-misi">Visi &amp; Misi</a>
                <a href="{{ route('profil') }}#identitas">Identitas Sekolah</a>
                <a href="{{ route('profil') }}#struktur">Struktur Organisasi</a>
            </div>
        </div>

        <!-- AKADEMIK -->
        <div class="mobile-dropdown">
            <button type="button" class="mobile-dropdown-toggle">
                <span><i class="fa-solid fa-book-open"></i> Akademik</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content">
                <a href="{{ route('akademik') }}#guru">Guru &amp; Tenaga Kependidikan</a>
                <a href="{{ route('akademik') }}#fasilitas">Fasilitas</a>
            </div>
        </div>

        <!-- KESISWAAN -->
        <div class="mobile-dropdown">
            <button type="button" class="mobile-dropdown-toggle">
                <span><i class="fa-solid fa-users"></i> Kesiswaan</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content">
                <a href="{{ route('kesiswaan') }}#kegiatan">Kegiatan</a>
                <a href="{{ route('kesiswaan') }}#prestasi">Prestasi</a>
                <a href="{{ route('kesiswaan') }}#ekstrakurikuler">Ekstrakurikuler</a>
            </div>
        </div>

        <!-- INFORMASI -->
        <div class="mobile-dropdown">
            <button type="button" class="mobile-dropdown-toggle">
                <span><i class="fa-solid fa-circle-info"></i> Informasi</span>
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content">
                <a href="{{ route('berita.index') }}">Berita</a>
                <a href="{{ route('alumni.create') }}">Alumni</a>
                <a href="{{ route('ppdb.create') }}">PPDB</a>
                <a href="{{ route('kontak') }}">Kontak</a>
            </div>
        </div>

        <a href="{{ route('ppdb.create') }}" class="mobile-cta">
            <i class="fa-solid fa-user-plus"></i> SPMB Online
        </a>
    </div>

    <div class="mobile-sidebar-footer">
        <p>{{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</p>
        <div class="mobile-social">
            @if(!empty($pengaturan['whatsapp']))
                <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            @endif
            @if(!empty($pengaturan['instagram']))
                <a href="{{ $pengaturan['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            @endif
            @if(!empty($pengaturan['youtube']))
                <a href="{{ $pengaturan['youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            @endif
            @if(!empty($pengaturan['tiktok']))
                <a href="{{ $pengaturan['tiktok'] }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
            @endif
        </div>
    </div>
</aside>
