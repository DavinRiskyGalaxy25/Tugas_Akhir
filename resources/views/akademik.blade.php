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
            <div class="section-heading-with-action">
                <div class="section-heading-text">
                    <h2>Guru &amp; Tenaga Kependidikan</h2>
                </div>
                <a href="{{ route('guru') }}" class="btn-daftar-guru" title="Lihat Semua Daftar Guru">
                    <span>Daftar Guru</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="teacher-slider">
                <button type="button" class="teacher-slider-button teacher-prev" aria-label="Guru sebelumnya">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="teacher-slider-window">
                    <div class="teacher-slider-track">
                        @forelse($guru as $g)
                            <article class="teacher-card"
                                data-nama="{{ $g->nama }}"
                                data-jabatan="{{ $g->jabatan }}"
                                data-mapel="{{ $g->mata_pelajaran ?? '-' }}"
                                data-nip="{{ $g->nip_nik ?? '-' }}"
                                data-foto="{{ $g->foto_url }}"
                                data-deskripsi="{{ $g->deskripsi ?? 'Tenaga pendidik profesional di SMP Al Ahmad Krian.' }}">
                                <button type="button" class="teacher-photo" aria-label="Lihat foto dan informasi {{ $g->nama }}">
                                    <img src="{{ $g->foto_url }}" alt="{{ $g->nama }}" loading="lazy">
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
                <h2>Fasilitas Sekolah</h2>
            </div>

            <div class="facility-grid">
                @forelse($fasilitas as $f)
                    <article class="facility-card">
                        <div class="facility-image">
                            <img src="{{ $f->foto_url }}" alt="{{ $f->nama }}">
                        </div>
                        <div class="facility-info">
                            <h3>{{ $f->nama }}</h3>
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
