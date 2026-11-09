@extends('layouts.app')

@section('title', 'Daftar Guru & Tenaga Kependidikan - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Daftar Guru</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container">
            <div class="teacher-directory-grid">
                @forelse($guru as $g)
                    <article class="teacher-card teacher-directory-card"
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

            @if($guru->hasPages())
                <div class="teacher-pagination">
                    @if($guru->onFirstPage())
                        <span class="teacher-pagination-btn disabled" aria-disabled="true">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $guru->previousPageUrl() }}" class="teacher-pagination-btn" aria-label="Halaman Sebelumnya">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Sebelumnya</span>
                        </a>
                    @endif

                    <div class="teacher-pagination-info">
                        Halaman <strong>{{ $guru->currentPage() }}</strong> dari <strong>{{ $guru->lastPage() }}</strong>
                    </div>

                    @if($guru->hasMorePages())
                        <a href="{{ $guru->nextPageUrl() }}" class="teacher-pagination-btn" aria-label="Halaman Berikutnya">
                            <span>Berikutnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    @else
                        <span class="teacher-pagination-btn disabled" aria-disabled="true">
                            <span>Berikutnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
