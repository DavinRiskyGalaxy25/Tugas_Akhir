@extends('layouts.app')

@section('title', 'Guru & Tenaga Kependidikan - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <span class="section-label">AKADEMIK</span>
            <h2>Guru &amp; Tenaga Kependidikan</h2>
            <p>Tenaga pendidik dan kependidikan {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container">
            <div class="facility-grid">
                @forelse($guru as $g)
                    <article class="facility-card">
                        <div class="facility-image">
                            <img src="{{ $g->foto_url }}" alt="{{ $g->nama }}">
                        </div>
                        <div class="facility-info">
                            <h3>{{ $g->nama }}</h3>
                            <p><strong>{{ $g->jabatan }}</strong>@if($g->mata_pelajaran) &middot; {{ $g->mata_pelajaran }} @endif</p>
                            @if($g->deskripsi)<p>{{ $g->deskripsi }}</p>@endif
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Data guru belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
