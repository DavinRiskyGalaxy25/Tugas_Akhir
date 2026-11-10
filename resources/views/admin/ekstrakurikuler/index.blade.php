@extends('admin.layouts.admin')

@section('title', 'Ekstrakurikuler')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1 text-dark">Data Ekstrakurikuler</h5>
                <p class="text-muted small mb-0">Kelola foto kegiatan, nama, pembina, dan jadwal ekstrakurikuler sekolah.</p>
            </div>
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus me-1"></i> Tambah Ekstrakurikuler
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th style="width: 70px;">Foto</th>
                        <th>Nama Ekstrakurikuler</th>
                        <th>Pembina</th>
                        <th>Jadwal Latihan</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ekstrakurikuler as $e)
                        <tr>
                            <td>
                                <img src="{{ $e->foto_url }}" alt="{{ $e->nama }}" class="img-thumb" style="width: 52px; height: 52px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
                            </td>
                            <td>
                                <a href="{{ route('admin.ekstrakurikuler.edit', $e) }}" class="dashboard-table-link">
                                    {{ $e->nama }}
                                </a>
                                @if($e->lokasi)
                                    <div class="small text-muted">
                                        <i class="fa-solid fa-location-dot me-1"></i>{{ $e->lokasi }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="text-dark fw-medium">{{ $e->pembina ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="table-secondary-text">{{ $e->jadwal ?? '-' }}</span>
                            </td>
                            <td>
                                @if($e->status_aktif)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.ekstrakurikuler.edit', $e) }}" class="btn btn-sm btn-outline-primary" title="Edit Ekstrakurikuler">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.ekstrakurikuler.destroy', $e) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ekstrakurikuler {{ $e->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data ekstrakurikuler.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $ekstrakurikuler->links() }}
        </div>
    </div>
</div>
@endsection
