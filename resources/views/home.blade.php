@extends('layouts.app')

@section('title', ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian') . ' - Beranda')
@section('body-class', 'home-page')

@section('content')
<!-- HERO SECTION FULLSCREEN WITH DYNAMIC SLIDER -->
<section class="hero-fullscreen" id="heroSliderSection">
    <div class="hero-slides-wrapper">
        @forelse($sliders as $index => $slide)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: linear-gradient(135deg, rgba(8, 38, 20, 0.88) 0%, rgba(13, 56, 30, 0.62) 50%, rgba(6, 28, 15, 0.84) 100%), url('{{ $slide->gambar_url }}');">
                <div class="hero-container">
                    <h1 class="hero-main-title">{{ $slide->judul ?? ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian') }}</h1>
                    
                    <p class="hero-subtitle">
                        {{ $slide->subjudul ?? ($pengaturan['deskripsi'] ?? 'Mencetak generasi yang berakhlakul karimah, berprestasi, mandiri, dan berwawasan luas di era modern.') }}
                    </p>

                    <div class="hero-actions-group">
                        @if($slide->tombol_teks && $slide->tombol_url)
                            <a href="{{ $slide->tombol_url }}" class="hero-btn-primary">
                                <span>{{ $slide->tombol_teks }}</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('ppdb.create') }}" class="hero-btn-primary">
                                <span>SPMB Online</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="hero-slide active" style="background-image: linear-gradient(135deg, rgba(8, 38, 20, 0.88) 0%, rgba(13, 56, 30, 0.62) 50%, rgba(6, 28, 15, 0.84) 100%), url('{{ asset('assets/img/sekolah.jpg') }}');">
                <div class="hero-container">
                    <h1 class="hero-main-title">Mendidik Generasi Berakhlak Mulia &amp; Berprestasi</h1>
                    
                    <p class="hero-subtitle">
                        {{ $pengaturan['deskripsi'] ?? 'Mencetak generasi yang berakhlakul karimah, mandiri, kreatif, dan berwawasan luas dengan perpaduan nilai-nilai islami dan kecakapan masa kini.' }}
                    </p>

                    <div class="hero-actions-group">
                        <a href="{{ route('ppdb.create') }}" class="hero-btn-primary">
                            <span>SPMB Online</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if(count($sliders) > 1)
        <!-- Slider Navigation Controls -->
        <button type="button" class="hero-nav-arrow prev" id="heroPrevBtn" aria-label="Slide sebelumnya">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="hero-nav-arrow next" id="heroNextBtn" aria-label="Slide berikutnya">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="hero-dots-container" id="heroDots">
            @foreach($sliders as $idx => $s)
                <button type="button" class="hero-dot-item {{ $idx === 0 ? 'active' : '' }}" data-slide="{{ $idx }}" aria-label="Pindah ke slide {{ $idx + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>

<!-- FLOATING DATA STATISTIK SEKOLAH (BORDERLESS FLOATING ISLAND) -->
<section class="home-stat-island" id="statistikSection">
    <div class="stat-island-container">
        <div class="stat-item-block">
            <div class="stat-icon-wrap"><i class="fa-solid fa-award"></i></div>
            <div class="stat-text-meta">
                <span class="stat-number-display">{{ $pengaturan['identitas_akreditasi'] ?? 'B' }}</span>
                <span class="stat-label-caption">Akreditasi Sekolah</span>
            </div>
        </div>

        <div class="stat-item-block">
            <div class="stat-icon-wrap"><i class="fa-solid fa-school"></i></div>
            <div class="stat-text-meta">
                <span class="stat-number-display">{{ $pengaturan['identitas_bentuk'] ?? 'SMP' }}</span>
                <span class="stat-label-caption">Bentuk Pendidikan</span>
            </div>
        </div>

        <div class="stat-item-block">
            <div class="stat-icon-wrap"><i class="fa-solid fa-id-card"></i></div>
            <div class="stat-text-meta">
                <span class="stat-number-display">{{ $pengaturan['identitas_npsn'] ?? '20501673' }}</span>
                <span class="stat-label-caption">Nomor Pokok Sekolah (NPSN)</span>
            </div>
        </div>

        <div class="stat-item-block">
            <div class="stat-icon-wrap"><i class="fa-solid fa-building-columns"></i></div>
            <div class="stat-text-meta">
                <span class="stat-number-display text-small">{{ strtoupper($pengaturan['identitas_status'] ?? 'SWASTA') }}</span>
                <span class="stat-label-caption">{{ $pengaturan['identitas_naungan'] ?? 'BPP Ma\'arif NU Al Ahmad' }}</span>
            </div>
        </div>
    </div>
</section>

<!-- SAMBUTAN KEPALA SEKOLAH (CLEAN ASYMMETRIC EDITORIAL) -->
@php
    $sambutanFoto = !empty($pengaturan['sambutan_foto'])
        ? (str_starts_with($pengaturan['sambutan_foto'], 'assets/') ? asset($pengaturan['sambutan_foto']) : asset('storage/'.$pengaturan['sambutan_foto']))
        : ($kepalaSekolah && $kepalaSekolah->foto_url ? $kepalaSekolah->foto_url : asset('assets/img/avatar-placeholder.svg'));
    $sambutanNama = $pengaturan['sambutan_nama_kepala'] ?? ($kepalaSekolah->nama ?? 'KH. Drs. M. Sudi Khotib, MM.');
    $sambutanJabatan = $pengaturan['sambutan_jabatan_kepala'] ?? 'Kepala Sekolah ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad');
    $sambutanQuote = $pengaturan['sambutan_quote'] ?? 'Pendidikan bukan hanya tentang mencapai prestasi akademik, tetapi juga tentang membentuk karakter, mengembangkan potensi, dan mempersiapkan peserta didik menjadi pribadi yang berakhlak dan bertanggung jawab.';
    $sambutanPesan = $pengaturan['sambutan_kepala_sekolah'] ?? 'Pendidikan bukan hanya tentang mencapai prestasi akademik, tetapi juga tentang membentuk karakter, mengembangkan potensi, dan mempersiapkan peserta didik menjadi pribadi yang berakhlak dan bertanggung jawab. Di SMP Al Ahmad Krian, kami berikhtiar mendidik tunas-tunas bangsa dengan perpaduan nilai-nilai islami dan kecakapan masa kini.';
@endphp

<section class="section-principal-editorial">
    <div class="editorial-container">
        <!-- FOTO KEPALA SEKOLAH DENGAN FRAME NATURAL -->
        <div class="editorial-photo-side">
            <div class="editorial-photo-wrapper">
                <img src="{{ $sambutanFoto }}" alt="Kepala Sekolah {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}">
                <div class="photo-floating-badge">
                    <i class="fa-solid fa-quote-left"></i>
                    <span>Keteladanan &amp; Akhlak</span>
                </div>
            </div>
        </div>

        <!-- TEKS SAMBUTAN & KUTIPAN -->
        <div class="editorial-content-side">
            <div class="section-kicker">SAMBUTAN KEPALA SEKOLAH</div>
            <h2 class="editorial-heading">Membimbing dengan Hati, Mendidik dengan Karakter</h2>

            <div class="editorial-quote-box">
                <p>&ldquo;{{ $sambutanQuote }}&rdquo;</p>
            </div>

            <p class="editorial-narrative">
                {{ $sambutanPesan }}
            </p>

            <div class="editorial-signature">
                <strong class="leader-name">{{ $sambutanNama }}</strong>
                <span class="leader-role">{{ $sambutanJabatan }}</span>
            </div>
        </div>
    </div>
</section>

<!-- TENTANG SEKOLAH INTRO (SEKSI DENGAN BACKGROUND LEMBUT #F4F7F4) -->
@php
    $tentangGambar = !empty($pengaturan['tentang_sekolah_gambar'])
        ? (str_starts_with($pengaturan['tentang_sekolah_gambar'], 'assets/') ? asset($pengaturan['tentang_sekolah_gambar']) : asset('storage/'.$pengaturan['tentang_sekolah_gambar']))
        : asset('assets/img/sekolah.jpg');
    $tentangTeks = $pengaturan['tentang_sekolah_ringkas'] ?? $pengaturan['tentang_sekolah'] ?? 'SMP Al Ahmad merupakan satuan pendidikan tingkat Sekolah Menengah Pertama swasta yang berlokasi di Jalan Mojosantren, Desa Kemasan, Kecamatan Krian, Kabupaten Sidoarjo, Provinsi Jawa Timur.';
@endphp

<section class="section-about-overview">
    <div class="about-overview-container">
        <div class="about-content-column">
            <div class="section-kicker">MENGENAL KAMI</div>
            <h2 class="about-main-title">Membangun Insan Berprestasi di Lingkungan Pendidikan yang Kondusif</h2>
            <p class="about-lead-text">{{ $tentangTeks }}</p>
            
            <p class="about-body-text">
                Didirikan sejak tahun 1977, sekolah kami konsisten memadukan penguatan karakter berbasis Ahlussunnah wal Jama'ah dengan Kurikulum Merdeka yang adaptif terhadap perkembangan teknologi dan minat bakat siswa.
            </p>

            <!-- 3 VALUE PILLARS (BORDERLESS SOFT CARDS) -->
            <div class="value-pillars-grid">
                <div class="pillar-card">
                    <span class="pillar-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <div>
                        <h4>Karakter Islami</h4>
                        <p>Pembiasaan ibadah, akhlak mulia, dan nilai-nilai Aswaja.</p>
                    </div>
                </div>

                <div class="pillar-card">
                    <span class="pillar-icon"><i class="fa-solid fa-book-open-reader"></i></span>
                    <div>
                        <h4>Akademik &amp; Literasi</h4>
                        <p>Kurikulum Merdeka dengan pengajaran interaktif dan aplikatif.</p>
                    </div>
                </div>

                <div class="pillar-card">
                    <span class="pillar-icon"><i class="fa-solid fa-trophy"></i></span>
                    <div>
                        <h4>Kemandirian &amp; Prestasi</h4>
                        <p>Wadah beragam ekstrakurikuler sains, seni, dan kepemimpinan.</p>
                    </div>
                </div>
            </div>

            <div class="about-action-wrap">
                <a href="{{ route('profil') }}#tentang" class="btn-link-pill">
                    <span>Baca Profil Lengkap Sekolah</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="about-image-column">
            <div class="about-image-frame">
                <img src="{{ $tentangGambar }}" alt="Gedung {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}">
                <div class="image-corner-tag">
                    <strong>Berdiri Sejak 1977</strong>
                    <small>Mencetak ribuan alumni berprestasi</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- QUICK MENU JELAJAHI SEKOLAH (BORDERLESS ULTRA-CLEAN CARDS) -->
<section class="section-explore-hub">
    <div class="explore-container">
        <div class="explore-header-center">
            <div class="section-kicker">INFORMASI SEKOLAH</div>
            <h2 class="explore-title">Jelajahi {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}</h2>
            <p class="explore-subtitle">Temukan seluruh informasi yang Anda butuhkan seputar profil, pembelajaran, dan layanan sekolah.</p>
        </div>

        <div class="explore-cards-grid">
            <a href="{{ route('profil') }}#tentang" class="hub-card">
                <div class="hub-icon-box"><i class="fa-solid fa-school"></i></div>
                <div class="hub-text-block">
                    <h3>Profil Sekolah</h3>
                    <p>Sejarah, visi misi, identitas resmi, dan susunan struktur organisasi sekolah.</p>
                </div>
                <div class="hub-arrow-link">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('akademik') }}#guru" class="hub-card">
                <div class="hub-icon-box"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div class="hub-text-block">
                    <h3>Akademik &amp; Guru</h3>
                    <p>Daftar tenaga pendidik profesional, staf kependidikan, serta fasilitas ruang belajar.</p>
                </div>
                <div class="hub-arrow-link">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('kesiswaan') }}#kegiatan" class="hub-card">
                <div class="hub-icon-box"><i class="fa-solid fa-people-group"></i></div>
                <div class="hub-text-block">
                    <h3>Kesiswaan &amp; Ekskul</h3>
                    <p>Aktivitas siswa, deretan prestasi lomba, dan program pengembangan diri ekstrakurikuler.</p>
                </div>
                <div class="hub-arrow-link">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <a href="{{ route('kontak') }}" class="hub-card">
                <div class="hub-icon-box"><i class="fa-solid fa-comments"></i></div>
                <div class="hub-text-block">
                    <h3>Kontak &amp; Lokasi</h3>
                    <p>Saluran komunikasi WhatsApp, nomor kantor, Google Maps, dan jam operasional layanan.</p>
                </div>
                <div class="hub-arrow-link">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// HERO SLIDER CAROUSEL WITH TIMED TRANSITIONS & TOUCH SWIPE
document.addEventListener('DOMContentLoaded', function () {
    const section = document.getElementById('heroSliderSection');
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot-item');
    const prevBtn = document.getElementById('heroPrevBtn');
    const nextBtn = document.getElementById('heroNextBtn');

    if (!slides.length || slides.length <= 1) return;

    let currentIndex = 0;
    let timer = null;
    const intervalTime = 5000;

    function showSlide(index) {
        if (index < 0) {
            index = slides.length - 1;
        } else if (index >= slides.length) {
            index = 0;
        }

        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });

        currentIndex = index;
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    function startAutoSlide() {
        stopAutoSlide();
        timer = setInterval(nextSlide, intervalTime);
    }

    function stopAutoSlide() {
        if (timer) clearInterval(timer);
    }

    nextBtn?.addEventListener('click', function () {
        nextSlide();
        startAutoSlide();
    });

    prevBtn?.addEventListener('click', function () {
        prevSlide();
        startAutoSlide();
    });

    dots.forEach((dot, i) => {
        dot.addEventListener('click', function () {
            showSlide(i);
            startAutoSlide();
        });
    });

    section?.addEventListener('mouseenter', stopAutoSlide);
    section?.addEventListener('mouseleave', startAutoSlide);

    // Mobile Swipe
    let startX = 0;
    let endX = 0;

    section?.addEventListener('touchstart', function (e) {
        startX = e.changedTouches[0].screenX;
        stopAutoSlide();
    }, { passive: true });

    section?.addEventListener('touchend', function (e) {
        endX = e.changedTouches[0].screenX;
        if (startX - endX > 50) {
            nextSlide();
        } else if (endX - startX > 50) {
            prevSlide();
        }
        startAutoSlide();
    }, { passive: true });

    startAutoSlide();
});
</script>
@endpush
