<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</title>
    <link rel="icon" type="image/png" href="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}">

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Admin Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin-redesign.css') }}">
    @stack('styles')
</head>
<body>
    <!-- SIDEBAR BLUR BACKDROP (TABLET / MOBILE) -->
    <div class="admin-sidebar-backdrop" id="adminSidebarBackdrop" aria-hidden="true"></div>

    <!-- SIDEBAR NAVIGATION -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-info">
                <div class="brand-icon brand-logo-wrap">
                    <img src="{{ $pengaturan['logo_url'] ?? asset('assets/img/logo.png') }}" alt="Logo {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}" class="brand-logo-img">
                </div>
                <div class="brand-text">
                    <span class="brand-name">{{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</span>
                    <span class="brand-sub">Admin Panel</span>
                </div>
            </a>
            <button type="button" class="btn-close-sidebar d-lg-none" id="sidebarCloseBtn" aria-label="Tutup menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="nav flex-column py-3">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high"></i> <span>Dashboard</span>
            </a>

            <div class="nav-heading">Kelola Beranda &amp; Profil</div>
            <a class="nav-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}" href="{{ route('admin.slider.index') }}">
                <i class="fa-solid fa-images"></i> <span>Slider Hero Home</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.profil-sekolah.*') ? 'active' : '' }}" href="{{ route('admin.profil-sekolah.edit') }}">
                <i class="fa-solid fa-school"></i> <span>Profil Sekolah</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.struktur.*') ? 'active' : '' }}" href="{{ route('admin.struktur.index') }}">
                <i class="fa-solid fa-sitemap"></i> <span>Struktur Organisasi</span>
            </a>

            <div class="nav-heading">Konten Informasi</div>
            <a class="nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}" href="{{ route('admin.guru.index') }}">
                <i class="fa-solid fa-chalkboard-user"></i> <span>Guru &amp; Staf</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">
                <i class="fa-solid fa-newspaper"></i> <span>Berita</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}" href="{{ route('admin.kegiatan.index') }}">
                <i class="fa-solid fa-calendar-days"></i> <span>Kegiatan</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}" href="{{ route('admin.prestasi.index') }}">
                <i class="fa-solid fa-trophy"></i> <span>Prestasi</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}" href="{{ route('admin.ekstrakurikuler.index') }}">
                <i class="fa-solid fa-campground"></i> <span>Ekstrakurikuler</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}" href="{{ route('admin.fasilitas.index') }}">
                <i class="fa-solid fa-building"></i> <span>Fasilitas</span>
            </a>

            <div class="nav-heading">Formulir</div>
            <a class="nav-link {{ request()->routeIs('admin.ppdb.*') ? 'active' : '' }}" href="{{ route('admin.ppdb.index') }}">
                <i class="fa-solid fa-file-pen"></i> <span>PPDB</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}" href="{{ route('admin.alumni.index') }}">
                <i class="fa-solid fa-user-graduate"></i> <span>Alumni</span>
            </a>

            <div class="nav-heading">Pengaturan</div>
            <a class="nav-link {{ request()->routeIs('admin.pengaturan.edit') ? 'active' : '' }}" href="{{ route('admin.pengaturan.edit') }}">
                <i class="fa-solid fa-gear"></i> <span>Pengaturan Website</span>
            </a>
            @if(auth()->user()?->isSuperAdmin())
            <a class="nav-link {{ request()->routeIs('admin.pengaturan.admin.*') ? 'active' : '' }}" href="{{ route('admin.pengaturan.admin.index') }}">
                <i class="fa-solid fa-users-gear"></i> <span>Kelola Admin</span>
            </a>
            @endif
            <a class="nav-link {{ request()->routeIs('admin.profile.edit') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
                <i class="fa-solid fa-user"></i> <span>Profil Saya</span>
            </a>
        </nav>
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="admin-content">
        <!-- TOPBAR -->
        <header class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-topbar-toggle d-lg-none" id="sidebarToggleBtn" type="button" aria-label="Buka menu navigasi">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <h1 class="page-title">@yield('title', 'Dashboard')</h1>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-sm d-none d-sm-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Lihat Website</span>
                </a>

                <div class="dropdown">
                    <button class="user-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar-badge">
                            {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="d-none d-md-inline">{{ auth()->user()?->name ?? 'Admin' }}</span>
                        <i class="fa-solid fa-chevron-down text-muted" style="font-size: 0.72rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="px-3 py-2 border-bottom mb-1">
                            <div class="fw-bold text-dark">{{ auth()->user()?->name ?? 'Administrator' }}</div>
                            <div class="small text-muted text-truncate" style="max-width: 180px;">{{ auth()->user()?->email }}</div>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fa-solid fa-user me-2 text-muted"></i> Profil Saya</a></li>
                        <li><a class="dropdown-item d-sm-none" href="{{ route('home') }}" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square me-2 text-muted"></i> Lihat Website</a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- FLOATING TOAST NOTIFICATIONS (MENGAMBANG DI POJOK ATAS) -->
        <div class="toast-floating-container" id="adminToastContainer" aria-live="polite" aria-atomic="true">
            @if(session('success'))
                <div class="toast-floating toast-success" role="alert" data-auto-dismiss="4500">
                    <div class="toast-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">Berhasil</div>
                        <div class="toast-message">{{ session('success') }}</div>
                    </div>
                    <button type="button" class="toast-close" onclick="closeToast(this.closest('.toast-floating'))" aria-label="Tutup">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="toast-progress">
                        <div class="toast-progress-bar"></div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="toast-floating toast-error" role="alert" data-auto-dismiss="6000">
                    <div class="toast-icon">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">Terjadi Kesalahan</div>
                        <div class="toast-message">{{ session('error') }}</div>
                    </div>
                    <button type="button" class="toast-close" onclick="closeToast(this.closest('.toast-floating'))" aria-label="Tutup">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="toast-progress">
                        <div class="toast-progress-bar"></div>
                    </div>
                </div>
            @endif

            @if(session('warning'))
                <div class="toast-floating toast-warning" role="alert" data-auto-dismiss="5000">
                    <div class="toast-icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">Peringatan</div>
                        <div class="toast-message">{{ session('warning') }}</div>
                    </div>
                    <button type="button" class="toast-close" onclick="closeToast(this.closest('.toast-floating'))" aria-label="Tutup">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="toast-progress">
                        <div class="toast-progress-bar"></div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="toast-floating toast-error" role="alert" data-auto-dismiss="7000">
                    <div class="toast-icon">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="toast-content">
                        <div class="toast-title">Periksa Kembali Formulir</div>
                        <div class="toast-message">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="toast-close" onclick="closeToast(this.closest('.toast-floating'))" aria-label="Tutup">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="toast-progress">
                        <div class="toast-progress-bar"></div>
                    </div>
                </div>
            @endif
        </div>

        <!-- MAIN BODY -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
