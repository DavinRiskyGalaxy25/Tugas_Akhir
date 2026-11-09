@extends('layouts.app')

@section('title', 'Fasilitas - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Fasilitas</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container">
            <div class="facility-grid">
                @forelse($fasilitas as $f)
                    <article class="facility-card">
                        <div class="facility-image">
                            <img src="{{ $f->foto_url }}" alt="{{ $f->nama }}">
                        </div>
                        <div class="facility-info">
                            <h3>{{ $f->nama }}</h3>
                            <p>{{ $f->deskripsi }}</p>
                            @if($f->kondisi || $f->lokasi)
                                <p><small>@if($f->kondisi){{ $f->kondisi }}@endif @if($f->lokasi) &middot; {{ $f->lokasi }} @endif</small></p>
                            @endif
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
