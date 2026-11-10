@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
@php
$hour = date('H');
$greeting = ($hour >= 4 && $hour < 11) ? 'Selamat Pagi' : (($hour >= 11 && $hour < 15) ? 'Selamat Siang' : (($hour >= 15 && $hour < 18) ? 'Selamat Sore' : 'Selamat Malam'));

$cards = [
    ['label' => 'Guru & Staf', 'value' => $stats['guru'], 'icon' => 'fa-chalkboard-user', 'color' => '#0284c7', 'bg' => '#f0f9ff', 'route' => 'admin.guru.index'],
    ['label' => 'Berita Sekolah', 'value' => $stats['berita'], 'icon' => 'fa-newspaper', 'color' => '#15803d', 'bg' => '#ecfdf5', 'route' => 'admin.berita.index'],
    ['label' => 'Kegiatan', 'value' => $stats['kegiatan'], 'icon' => 'fa-calendar-days', 'color' => '#d97706', 'bg' => '#fffbeb', 'route' => 'admin.kegiatan.index'],
    ['label' => 'Prestasi Siswa', 'value' => $stats['prestasi'], 'icon' => 'fa-trophy', 'color' => '#e11d48', 'bg' => '#fff1f2', 'route' => 'admin.prestasi.index'],
    ['label' => 'Ekstrakurikuler', 'value' => $stats['ekstrakurikuler'], 'icon' => 'fa-campground', 'color' => '#7c3aed', 'bg' => '#f5f3ff', 'route' => 'admin.ekstrakurikuler.index'],
    ['label' => 'Fasilitas', 'value' => $stats['fasilitas'], 'icon' => 'fa-building', 'color' => '#0d9488', 'bg' => '#f0fdfa', 'route' => 'admin.fasilitas.index'],
    ['label' => 'Total PPDB', 'value' => $stats['ppdb'], 'icon' => 'fa-file-lines', 'color' => '#4f46e5', 'bg' => '#eef2ff', 'route' => 'admin.ppdb.index'],
    ['label' => 'Data Alumni', 'value' => $stats['alumni'], 'icon' => 'fa-user-graduate', 'color' => '#475569', 'bg' => '#f1f5f9', 'route' => 'admin.alumni.index'],
];

$perluTindakan = ($stats['ppdb_menunggu'] ?? 0) + ($stats['alumni_pending'] ?? 0);
@endphp

<!-- WELCOME BANNER (CALM, SERENE, REASSURING) -->
<div class="card welcome-banner mb-4">
    <div style="position: absolute; right: -20px; bottom: -30px; font-size: 10rem; color: rgba(255,255,255,0.05); pointer-events: none;">
        <i class="fa-solid fa-graduation-cap"></i>
    </div>
    <div class="card-body p-4 p-md-5 position-relative">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 banner-pill" style="border-radius: 30px; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.05em;">
                <span class="d-inline-block rounded-circle banner-pill-dot" style="width: 8px; height: 8px;"></span>
                <span>PANEL ADMINISTRATOR</span>
            </div>
            <span style="font-size: 0.85rem; font-weight: 600;">
                <i class="fa-regular fa-calendar me-1 banner-date-icon"></i> {{ now()->translatedFormat('l, d F Y') }}
            </span>
        </div>
        <h2 class="fw-bold mb-2 text-white" style="font-size: 1.75rem;">{{ $greeting }}, {{ auth()->user()?->name ?? 'Admin' }}!</h2>
        <p class="mb-0" style="color: #f8fafc; max-width: 680px; font-size: 0.94rem; line-height: 1.6; font-weight: 400;">
            Portal pengelolaan data dan informasi {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.
            @if($perluTindakan > 0)
                Terdapat <strong class="text-white" style="font-weight: 700; text-decoration: underline;">{{ $perluTindakan }} berkas/pesan baru</strong> yang memerlukan perhatian Anda hari ini.
            @else
                Seluruh berkas pendaftaran dan pesan masuk telah selesai ditinjau.
            @endif
        </p>
    </div>
</div>

<!-- ACTION NOTICES (MENGURANGI KEBINGUNGAN DENGAN PRIORITAS JELAS) -->
@if($perluTindakan > 0)
<div class="row g-3 mb-4">
    @if(($stats['ppdb_menunggu'] ?? 0) > 0)
    <div class="col-md-6">
        <div class="action-notice-card h-100" style="background: #fffdf5 !important;">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                        <h6 class="fw-bold mb-0">Pendaftaran PPDB Masuk</h6>
                    </div>
                    <span class="badge bg-warning">{{ $stats['ppdb_menunggu'] }} Berkas Menunggu</span>
                </div>
                <p class="mb-3">Terdapat pendaftar siswa baru yang dokumennya belum diverifikasi panitia.</p>
            </div>
            <div>
                <a href="{{ route('admin.ppdb.index') }}" class="btn btn-primary btn-sm">
                    Tinjau Berkas Pendaftar <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    @endif

    @if(($stats['alumni_pending'] ?? 0) > 0)
    <div class="col-md-6">
        <div class="action-notice-card h-100" style="background: #f0fdf4 !important;">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                        <h6 class="fw-bold mb-0">Pesan &amp; Kesan Alumni</h6>
                    </div>
                    <span class="badge bg-success">{{ $stats['alumni_pending'] }} Menunggu ACC</span>
                </div>
                <p class="mb-3">Testimoni baru dari alumni yang menunggu persetujuan sebelum dipublikasikan ke situs.</p>
            </div>
            <div>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-primary btn-sm">
                    Moderasi Pesan Alumni <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

<!-- STAT CARDS (CLEAN, MODULAR, BIOPHILIC HARMONY) -->
<div class="row g-3 mb-4">
    @foreach($cards as $c)
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route($c['route']) }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-box" style="background: {{ $c['bg'] }}; color: {{ $c['color'] }};">
                            <i class="fa-solid {{ $c['icon'] }}"></i>
                        </div>
                        <div class="min-w-0">
                            <div class="stat-value">{{ $c['value'] }}</div>
                            <div class="stat-label text-truncate">{{ $c['label'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<!-- LATEST DATA TABLES (CLEAN WHITESPACE, EASY SCANNING) -->
<div class="row g-4">
    <!-- TABEL PPDB TERBARU -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">Pendaftar PPDB Terbaru</h6>
                    <a href="{{ route('admin.ppdb.index') }}" class="small text-decoration-none fw-bold" style="color: var(--admin-primary);">Lihat Semua &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Asal Sekolah</th>
                                <th>Status</th>
                                <th class="text-end">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ppdbTerbaru as $p)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.ppdb.show', $p) }}" class="dashboard-table-link">
                                            {{ $p->nama_lengkap }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="table-secondary-text">{{ \Illuminate\Support\Str::limit($p->asal_sekolah, 18) }}</span>
                                    </td>
                                    <td>
                                        @if($p->status === 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($p->status === 'diterima')
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif($p->status === 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <span class="table-secondary-text">{{ $p->created_at->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-muted text-center py-4">Belum ada pendaftar terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL BERITA TERKINI -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 1rem;">Berita &amp; Artikel Terkini</h6>
                    <a href="{{ route('admin.berita.index') }}" class="small text-decoration-none fw-bold" style="color: var(--admin-primary);">Lihat Semua &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Judul Berita</th>
                                <th>Status</th>
                                <th class="text-end">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beritaTerbaru as $b)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.berita.edit', $b) }}" class="dashboard-table-link">
                                            {{ \Illuminate\Support\Str::limit($b->judul, 36) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $b->status === 'published' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($b->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="table-secondary-text">{{ optional($b->tanggal_publikasi ?? $b->created_at)->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted text-center py-4">Belum ada artikel berita.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
