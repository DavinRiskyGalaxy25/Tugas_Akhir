@extends('layouts.app')

@section('title', 'Akademik - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">

    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Akademik</h2>
        </div>
    </section>

    <section id="guru" class="content-section">
        <div class="section-container">
            <div class="section-heading">
                <span class="section-label">TENAGA PENDIDIK</span>
                <h2>Guru &amp; Tenaga Kependidikan</h2>
                <p>Tenaga pendidik dan kependidikan {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
            </div>

            <div class="teacher-slider">
                <button type="button" class="teacher-slider-button teacher-prev" aria-label="Guru sebelumnya">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="teacher-slider-window">
                    <div class="teacher-slider-track">
                        @forelse($guru as $g)
                            <article class="teacher-card">
                                <button type="button" class="teacher-photo" data-image="{{ $g->foto_url }}" data-name="{{ $g->nama }}">
                                    <img src="{{ $g->foto_url }}" alt="{{ $g->nama }}">
                                    <span class="teacher-photo-overlay"><i class="fa-solid fa-expand"></i></span>
                                </button>
                                <div class="teacher-info">
                                    <span>{{ strtoupper($g->jabatan) }}</span>
                                    <h3>{{ $g->nama }}</h3>
                                    <p>{{ $g->mata_pelajaran ?? $g->jabatan }}</p>
                                </div>
                            </article>
                        @empty
                            <p class="empty-state">Data guru belum tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <button type="button" class="teacher-slider-button teacher-next" aria-label="Guru berikutnya">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <section id="fasilitas" class="content-section alternate-section">
        <div class="section-container">
            <div class="section-heading center">
                <span class="section-label">SARANA PRASARANA</span>
                <h2>Fasilitas Sekolah</h2>
                <p>Fasilitas yang tersedia untuk mendukung kegiatan belajar dan aktivitas siswa {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}.</p>
            </div>

            <div class="facility-grid">
                @forelse($fasilitas as $f)
                    <article class="facility-card">
                        <div class="facility-image">
                            <img src="{{ $f->foto_url }}" alt="{{ $f->nama }}">
                        </div>
                        <div class="facility-info">
                            <h3>{{ $f->nama }}</h3>
                            <p>{{ $f->deskripsi }}</p>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Data fasilitas belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

</main>
@endsection
