@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
@php
$cards = [
    ['label' => 'Guru & Staf', 'value' => $stats['guru'], 'icon' => 'fa-chalkboard-user', 'color' => '#0284c7', 'bg' => '#e0f2fe', 'route' => 'admin.guru.index'],
    ['label' => 'Berita', 'value' => $stats['berita'], 'icon' => 'fa-newspaper', 'color' => '#15803d', 'bg' => '#dcfce7', 'route' => 'admin.berita.index'],
    ['label' => 'Kegiatan', 'value' => $stats['kegiatan'], 'icon' => 'fa-calendar-days', 'color' => '#d97706', 'bg' => '#fef3c7', 'route' => 'admin.kegiatan.index'],
    ['label' => 'Prestasi', 'value' => $stats['prestasi'], 'icon' => 'fa-trophy', 'color' => '#e11d48', 'bg' => '#ffe4e6', 'route' => 'admin.prestasi.index'],
    ['label' => 'Ekstrakurikuler', 'value' => $stats['ekstrakurikuler'], 'icon' => 'fa-campground', 'color' => '#7c3aed', 'bg' => '#ede9fe', 'route' => 'admin.ekstrakurikuler.index'],
    ['label' => 'Fasilitas', 'value' => $stats['fasilitas'], 'icon' => 'fa-building', 'color' => '#0d9488', 'bg' => '#ccfbf1', 'route' => 'admin.fasilitas.index'],
    ['label' => 'Pendaftar PPDB', 'value' => $stats['ppdb'], 'icon' => 'fa-file-pen', 'color' => '#ea580c', 'bg' => '#ffedd5', 'route' => 'admin.ppdb.index'],
    ['label' => 'Data Alumni', 'value' => $stats['alumni'], 'icon' => 'fa-user-graduate', 'color' => '#4f46e5', 'bg' => '#e0e7ff', 'route' => 'admin.alumni.index'],
];
@endphp

<!-- WELCOME BANNER -->
<div class="card mb-4" style="background: linear-gradient(135deg, #0c2419 0%, #15803d 100%); color: #ffffff; border-radius: 20px; overflow: hidden; position: relative;">
    <div style="position: absolute; right: -25px; bottom: -25px; font-size: 11rem; color: rgba(255,255,255,0.04); pointer-events: none;">
        <i class="fa-solid fa-school"></i>
    </div>
    <div class="card-body p-4 p-md-5 position-relative">
        <div class="d-inline-flex align-items-center gap-2 mb-2 px-3 py-1" style="background: rgba(255,255,255,0.15); border-radius: 30px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em;">
            <i class="fa-solid fa-shield-halved text-warning"></i>
            <span>ADMINISTRATOR PANEL</span>
        </div>
        <h2 class="fw-bold mb-2 text-white" style="font-size: 1.6rem;">Selamat Datang, {{ auth()->user()?->name ?? 'Admin' }}!</h2>
        <p class="mb-0 text-white-50" style="max-width: 680px; font-size: 0.94rem; line-height: 1.6;">
            Pantau ringkasan statistik sekolah, kelola konten publikasi, tanggapi formulir PPDB online, serta perbarui pengaturan website sekolah secara terpadu.
        </p>
    </div>
</div>

<!-- STAT CARDS -->
<div class="row g-3 mb-4">
    @foreach($cards as $c)
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route($c['route']) }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-box" style="background: {{ $c['bg'] }}; color: {{ $c['color'] }};">
                            <i class="fa-solid {{ $c['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="fs-4 fw-bold text-dark lh-1">{{ $c['value'] }}</div>
                            <div class="text-muted small mt-1">{{ $c['label'] }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<!-- ACTION NOTICES -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-inline-block rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                            <h6 class="fw-bold mb-0 text-dark">PPDB Menunggu Verifikasi</h6>
                        </div>
                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2 fw-bold">{{ $stats['ppdb_menunggu'] }} pendaftar</span>
                    </div>
                    <p class="text-muted small mb-3">Terdapat pendaftar baru yang menunggu peninjauan dan perubahan status berkas penerimaan.</p>
                </div>
                <div>
                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa-solid fa-arrow-right me-1"></i> Tinjau Pendaftar
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="d-inline-block rounded-circle bg-info" style="width: 10px; height: 10px;"></span>
                            <h6 class="fw-bold mb-0 text-dark">Testimoni Alumni Pending</h6>
                        </div>
                        <span class="badge rounded-pill bg-info text-dark px-3 py-2 fw-bold">{{ $stats['alumni_pending'] }} pesan</span>
                    </div>
                    <p class="text-muted small mb-3">Komentar alumni yang masuk memerlukan persetujuan sebelum tampil pada website utama.</p>
                </div>
                <div>
                    <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa-solid fa-arrow-right me-1"></i> Moderasi Alumni
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LATEST DATA TABLES -->
<div class="row g-3">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark">Pendaftar PPDB Terbaru</h6>
                    <a href="{{ route('admin.ppdb.index') }}" class="small text-decoration-none fw-semibold" style="color: var(--admin-primary);">Lihat Semua &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Status</th>
                                <th class="text-end">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ppdbTerbaru as $p)
                                <tr>
                                    <td class="fw-medium text-dark">{{ $p->nama_lengkap }}</td>
                                    <td>
                                        @if($p->status === 'menunggu')
                                            <span class="badge bg-warning text-dark px-2 py-1">Menunggu</span>
                                        @elseif($p->status === 'diterima')
                                            <span class="badge bg-success px-2 py-1">Diterima</span>
                                        @else
                                            <span class="badge bg-secondary px-2 py-1">{{ ucfirst($p->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end text-muted small">{{ $p->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-muted text-center py-4">Belum ada pendaftar terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark">Berita Terkini</h6>
                    <a href="{{ route('admin.berita.index') }}" class="small text-decoration-none fw-semibold" style="color: var(--admin-primary);">Lihat Semua &rarr;</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
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
                                    <td class="fw-medium text-dark">{{ \Illuminate\Support\Str::limit($b->judul, 36) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $b->status === 'published' ? 'success' : 'secondary' }} px-2 py-1">
                                            {{ ucfirst($b->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end text-muted small">{{ optional($b->tanggal_publikasi)->format('d M Y') }}</td>
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
