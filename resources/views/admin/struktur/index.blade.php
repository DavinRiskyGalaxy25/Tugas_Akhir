@extends('admin.layouts.admin')

@section('title', 'Kelola Struktur Organisasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="fw-bold mb-1"><i class="fa-solid fa-sitemap text-success me-2"></i> Struktur Organisasi Sekolah</h5>
        <p class="text-muted small mb-0">Kelola susunan pengurus, kepala sekolah, dan waka yang tampil pada halaman profil.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.profil-sekolah.edit') }}#tab-bagan" class="btn btn-outline-success">
            <i class="fa-solid fa-image me-1"></i> Upload Bagan Gambar
        </a>
        <a href="{{ route('admin.struktur.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus me-1"></i> Tambah Pejabat / Pengurus
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">Urutan</th>
                        <th style="width: 80px;">Foto</th>
                        <th>Jabatan</th>
                        <th>Nama Pengurus</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 120px;" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($struktur as $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $item->urutan }}</td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ $item->foto_url }}" class="rounded-circle border" style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 48px; height: 48px;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                    {{ $item->jabatan }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $item->nama }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary">
                                    {{ ucfirst(str_replace('_', ' ', $item->kategori)) }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $item->keterangan ?? '—' }}</small>
                            </td>
                            <td>
                                @if($item->status_aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.struktur.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.struktur.destroy', $item) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus anggota struktur ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-users fs-2 d-block mb-2 text-secondary"></i>
                                Belum ada anggota struktur organisasi yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($struktur->hasPages())
    <div class="card-footer bg-white">
        {{ $struktur->links() }}
    </div>
    @endif
</div>
@endsection

