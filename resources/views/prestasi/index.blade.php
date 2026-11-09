@extends('layouts.app')

@section('title', 'Prestasi - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main>
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Prestasi Siswa</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container">
            <div class="achievement-page-grid">
                @forelse($prestasi as $item)
                    <article class="achievement-card">
                        <div class="achievement-image">
                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama_prestasi }}">
                        </div>
                        <div class="achievement-info">
                            <span class="achievement-year"><i class="fa-solid fa-trophy me-1"></i> Tahun {{ $item->tahun }}</span>
                            <h3>{{ $item->nama_prestasi }}</h3>
                            @if($item->nama_siswa)
                                <p class="achievement-winner"><strong>Peraih:</strong> {{ $item->nama_siswa }} &middot; {{ $item->pencapaian ?? '' }}</p>
                            @endif
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 110) }}</p>
                            <a href="{{ route('prestasi.show', $item->slug) }}" class="activity-link">
                                Selengkapnya &rarr;
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">Belum ada data prestasi yang dipublikasikan.</p>
                @endforelse
            </div>

            <div class="pagination-wrapper">
                {{ $prestasi->links() }}
            </div>
        </div>
    </section>
</main>
@endsection
