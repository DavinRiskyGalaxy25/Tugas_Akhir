@extends('admin.layouts.admin')

@section('title', 'Slider Background Beranda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="fw-bold mb-1"><i class="fa-solid fa-images text-success me-2"></i> Gambar Background Slider Beranda</h5>
        <p class="text-muted small mb-0">Kelola gambar banner/background slider utama di halaman depan sekolah (otomatis bergeser dan dapat digeser).</p>
    </div>
    <a href="{{ route('admin.slider.create') }}" class="btn btn-success">
        <i class="fa-solid fa-plus me-1"></i> Tambah Slide Baru
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">Urutan</th>
                        <th style="width: 140px;">Gambar</th>
                        <th>Judul &amp; Teks Slide</th>
                        <th>Tombol Aksi</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 120px;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sliders as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->urutan }}</td>
                            <td>
                                <img src="{{ $item->gambar_url }}" class="rounded shadow-sm border" style="width: 120px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <strong class="d-block">{{ $item->judul ?? '— Tanpa Judul —' }}</strong>
                                <small class="text-muted">{{ Str::limit($item->subjudul, 80) }}</small>
                            </td>
                            <td>
                                @if($item->tombol_teks)
                                    <span class="badge bg-light text-dark border">
                                        {{ $item->tombol_teks }} &rarr; {{ $item->tombol_url }}
                                    </span>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.slider.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit Slide">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.slider.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus slide background ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Slide">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-image fs-2 d-block mb-2 text-secondary"></i>
                                Belum ada slide background yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($sliders->hasPages())
    <div class="card-footer bg-white">
        {{ $sliders->links() }}
    </div>
    @endif
</div>
@endsection

