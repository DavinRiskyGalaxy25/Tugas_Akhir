@extends('layouts.app')

@section('title', 'Profil Sekolah - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <span class="section-label">PROFIL SEKOLAH</span>
            <h2>{{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</h2>
            <p>Mengenal profil, sejarah, visi, misi, identitas, dan struktur organisasi sekolah.</p>
        </div>
    </section>

    <!-- 1. TENTANG SEKOLAH -->
    @php
        $tentangFoto = !empty($pengaturan['tentang_sekolah_gambar'])
            ? (str_starts_with($pengaturan['tentang_sekolah_gambar'], 'assets/') ? asset($pengaturan['tentang_sekolah_gambar']) : asset('storage/'.$pengaturan['tentang_sekolah_gambar']))
            : asset('assets/img/sekolah.jpg');
        $tentangDeskripsi = $pengaturan['tentang_sekolah'] ?? "SMP Al Ahmad merupakan satuan pendidikan tingkat Sekolah Menengah Pertama swasta yang berlokasi di Jalan Mojosantren, Desa Kemasan, Kecamatan Krian, Kabupaten Sidoarjo, Provinsi Jawa Timur. Sekolah ini memiliki NPSN 20501673 dan berada di bawah naungan Yayasan Badan Pelaksana Pendidikan Ma'arif NU Al Ahmad. Sebagai lembaga pendidikan, SMP Al Ahmad menjadi bagian dari lingkungan pendidikan Al Ahmad yang berada di wilayah Mojosantren, Krian.";
    @endphp

    <section id="tentang" class="content-section">
        <div class="section-heading">
            <span class="section-label">TENTANG SEKOLAH</span>
            <h2>Tentang {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</h2>
        </div>

        <div class="profile-intro">
            <div class="content-image">
                <img src="{{ $tentangFoto }}" alt="Profil {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}">
            </div>

            <div class="content-text">
                @foreach(explode("\n", str_replace("\r", "", $tentangDeskripsi)) as $paragraph)
                    @if(trim($paragraph) !== '')
                        <p class="paragraph-indent">{{ trim($paragraph) }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- 2. SEJARAH SEKOLAH -->
    @php
        $sejarahTeks = $pengaturan['sejarah'] ?? "SMP Al Ahmad memiliki sejarah yang cukup panjang dalam penyelenggaraan pendidikan di Kecamatan Krian, Kabupaten Sidoarjo. Berdasarkan data pendidikan Kemendikdasmen, sekolah ini tercatat memiliki tanggal pendirian pada 17 Juli 1977. Sejak awal berdirinya, SMP Al Ahmad hadir sebagai lembaga pendidikan swasta yang melayani pendidikan pada jenjang Sekolah Menengah Pertama di wilayah Mojosantren dan sekitarnya.\n\nDalam perkembangannya, SMP Al Ahmad berada di bawah naungan Yayasan Badan Pelaksana Pendidikan Ma'arif NU Al Ahmad. Sekolah ini kemudian menjalankan kegiatan operasional berdasarkan izin operasional dengan nomor 421.3/2700/404.3.1/2010.";
        $tahunPendirian = $pengaturan['sejarah_tahun_pendirian'] ?? '17 Juli 1977';
    @endphp

    <section id="sejarah" class="content-section alternate-section">
        <div class="section-heading">
            <span class="section-label">SEJARAH</span>
            <h2>Sejarah {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</h2>
        </div>

        <div class="history-content">
            <div class="history-text">
                @foreach(explode("\n", str_replace("\r", "", $sejarahTeks)) as $p)
                    @if(trim($p) !== '')
                        <p>{{ trim($p) }}</p>
                    @endif
                @endforeach
            </div>

            <div class="history-box">
                <i class="fa-solid fa-landmark"></i>
                <strong>{{ $tahunPendirian }}</strong>
                <span>Tanggal Pendirian</span>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI -->
    @php
        $visiTeks = $pengaturan['visi'] ?? 'Membangun insan yang berakhlakul karimah, berprestasi, mandiri, kreatif, dan peduli lingkungan.';
        $misiRaw = $pengaturan['misi'] ?? "Menyelenggarakan pendidikan berbasis pesantren untuk memperkuat karakter keagamaan dan akhlak mulia.\nMengembangkan potensi akademik dan non-akademik peserta didik agar meraih prestasi optimal.\nMembentuk jiwa kemandirian dan kreativitas melalui pembelajaran kewirausahaan (entrepreneurship).\nMenanamkan kepedulian terhadap lingkungan sekitar secara aktif dan berkelanjutan.";
        $misiList = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $misiRaw))));
    @endphp

    <section id="visi-misi" class="content-section">
        <div class="section-heading">
            <span class="section-label">ARAH PENDIDIKAN</span>
            <h2>Visi &amp; Misi</h2>
        </div>

        <div class="vision-grid">
            <article class="vision-card">
                <div class="card-icon">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <span class="card-label">VISI SEKOLAH</span>
                <h3>{{ $visiTeks }}</h3>
            </article>

            <article class="vision-card">
                <div class="card-icon">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <span class="card-label">MISI SEKOLAH</span>
                <ul>
                    @foreach($misiList as $misiItem)
                        <li>{{ $misiItem }}</li>
                    @endforeach
                </ul>
            </article>
        </div>
    </section>

    <!-- 4. IDENTITAS SEKOLAH -->
    <section id="identitas" class="content-section alternate-section">
        <div class="section-heading">
            <span class="section-label">DATA SEKOLAH</span>
            <h2>Identitas Sekolah</h2>
        </div>

        <div class="identity-table-wrapper">
            <table class="identity-table">
                <tr>
                    <th>Nama Sekolah</th>
                    <td>{{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</td>
                </tr>
                <tr>
                    <th>NPSN</th>
                    <td>{{ $pengaturan['identitas_npsn'] ?? '20501673' }}</td>
                </tr>
                <tr>
                    <th>Status Sekolah</th>
                    <td>{{ $pengaturan['identitas_status'] ?? 'Swasta' }}</td>
                </tr>
                <tr>
                    <th>Bentuk Pendidikan</th>
                    <td>{{ $pengaturan['identitas_bentuk'] ?? 'Sekolah Menengah Pertama (SMP)' }}</td>
                </tr>
                <tr>
                    <th>Akreditasi</th>
                    <td>{{ $pengaturan['identitas_akreditasi'] ?? 'B' }}</td>
                </tr>
                <tr>
                    <th>Kurikulum</th>
                    <td>{{ $pengaturan['identitas_kurikulum'] ?? 'Kurikulum Merdeka' }}</td>
                </tr>
                <tr>
                    <th>Naungan / Yayasan</th>
                    <td>{{ $pengaturan['identitas_naungan'] ?? 'Badan Pelaksana Pendidikan Ma\'arif NU Al-Ahmad' }}</td>
                </tr>
                @if(!empty($pengaturan['sejarah_izin_operasional']))
                <tr>
                    <th>SK Izin Operasional</th>
                    <td>{{ $pengaturan['sejarah_izin_operasional'] }}</td>
                </tr>
                @endif
                @if(!empty($pengaturan['alamat']))
                <tr>
                    <th>Alamat Lengkap</th>
                    <td>{{ $pengaturan['alamat'] }}</td>
                </tr>
                @endif
            </table>
        </div>
    </section>

    <!-- 5. STRUKTUR ORGANISASI -->
    <section id="struktur" class="content-section">
        <div class="section-heading">
            <span class="section-label">SUSUNAN PENGURUS</span>
            <h2>Struktur Organisasi</h2>
            <p>Struktur organisasi dan manajemen {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
        </div>

        {{-- Jika ada gambar bagan infografis struktur yang diunggah --}}
        @if(!empty($pengaturan['bagan_struktur_organisasi']))
            @php
                $baganUrl = str_starts_with($pengaturan['bagan_struktur_organisasi'], 'assets/')
                    ? asset($pengaturan['bagan_struktur_organisasi'])
                    : asset('storage/'.$pengaturan['bagan_struktur_organisasi']);
            @endphp
            <div class="org-bagan-wrapper mb-5 text-center">
                <a href="{{ $baganUrl }}" target="_blank" title="Klik untuk memperbesar bagan">
                    <img src="{{ $baganUrl }}" alt="Bagan Struktur Organisasi {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}" class="img-fluid rounded shadow-sm border" style="max-height: 480px; width: auto; max-width: 100%;">
                </a>
                <p class="text-muted small mt-2"><i class="fa-solid fa-magnifying-glass-plus"></i> Klik pada bagan untuk melihat dalam ukuran penuh</p>
            </div>
        @endif

        {{-- Kartu Pejabat / Pengurus Struktur --}}
        @php
            $kepalaList = $struktur->where('kategori', 'kepala_sekolah');
            $wakaList = $struktur->where('kategori', 'waka');
            $stafList = $struktur->whereNotIn('kategori', ['kepala_sekolah', 'waka']);
        @endphp

        <div class="organization">
            {{-- Level 1: Kepala Sekolah --}}
            @if($kepalaList->isNotEmpty())
                <div class="org-level">
                    @foreach($kepalaList as $kepala)
                        <div class="organization-card principal-card">
                            @if($kepala->foto)
                                <div class="org-photo mb-2">
                                    <img src="{{ $kepala->foto_url }}" alt="{{ $kepala->nama }}" class="rounded-circle border" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                            @endif
                            <span class="organization-role">{{ $kepala->jabatan }}</span>
                            <h3>{{ $kepala->nama }}</h3>
                            @if($kepala->keterangan)
                                <p>{{ $kepala->keterangan }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Level 2: Wakil Kepala Sekolah --}}
            @if($wakaList->isNotEmpty())
                <div class="org-grid mt-4">
                    @foreach($wakaList as $waka)
                        <div class="organization-card">
                            @if($waka->foto)
                                <div class="org-photo mb-2">
                                    <img src="{{ $waka->foto_url }}" alt="{{ $waka->nama }}" class="rounded-circle border" style="width: 68px; height: 68px; object-fit: cover;">
                                </div>
                            @endif
                            <span class="organization-role">{{ $waka->jabatan }}</span>
                            <h3>{{ $waka->nama }}</h3>
                            @if($waka->keterangan)
                                <p>{{ $waka->keterangan }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Level 3: Pengurus / Staf Lainnya --}}
            @if($stafList->isNotEmpty())
                <div class="org-grid mt-4">
                    @foreach($stafList as $staf)
                        <div class="organization-card">
                            @if($staf->foto)
                                <div class="org-photo mb-2">
                                    <img src="{{ $staf->foto_url }}" alt="{{ $staf->nama }}" class="rounded-circle border" style="width: 60px; height: 60px; object-fit: cover;">
                                </div>
                            @endif
                            <span class="organization-role">{{ $staf->jabatan }}</span>
                            <h3>{{ $staf->nama }}</h3>
                            @if($staf->keterangan)
                                <p>{{ $staf->keterangan }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            @if($struktur->isEmpty() && empty($pengaturan['bagan_struktur_organisasi']))
                <p class="empty-state">Data struktur organisasi belum tersedia.</p>
            @endif
        </div>
    </section>
</main>
@endsection
