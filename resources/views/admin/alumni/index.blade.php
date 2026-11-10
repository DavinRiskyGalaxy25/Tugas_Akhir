@extends('admin.layouts.admin')
@section('title', 'Kesan & Pesan Alumni')
@section('content')
<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1 text-dark">Daftar Kesan &amp; Pesan Alumni</h5>
                <p class="text-muted small mb-0">Kelola dan setujui (ACC) kiriman cerita testimoni dari alumni sekolah.</p>
            </div>
            <form class="d-flex gap-2" method="GET">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="border-radius: 8px;">
                    <option value="">Semua Status</option>
                    @foreach(['pending' => 'Pending (Menunggu ACC)', 'published' => 'Disetujui (ACC)', 'rejected' => 'Ditolak / Sembunyi'] as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="min-width: 170px;">Alumni</th>
                        <th style="min-width: 110px;">Rating</th>
                        <th style="min-width: 260px;">Pesan &amp; Kesan</th>
                        <th style="min-width: 130px;">Status ACC</th>
                        <th class="text-end" style="min-width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alumni as $a)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $a->nama }}</div>
                                <small class="text-muted d-block">
                                    @if($a->tahun_lulus) Lulus {{ $a->tahun_lulus }} @endif
                                    @if($a->pekerjaan_sekarang) &middot; {{ $a->pekerjaan_sekarang }} @endif
                                </small>
                            </td>
                            <td>
                                <div class="text-warning d-inline-flex gap-1" title="{{ $a->rating ?? 5 }} Bintang">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= ($a->rating ?? 5) ? 'text-warning' : 'text-muted opacity-25' }}" style="font-size: 0.8rem;"></i>
                                    @endfor
                                </div>
                                <small class="text-muted ms-1 fw-bold">({{ $a->rating ?? 5 }}/5)</small>
                            </td>
                            <td>
                                <div class="text-dark small" style="max-width: 380px; white-space: normal; line-height: 1.5;">
                                    &ldquo;{{ $a->pesan_kesan }}&rdquo;
                                </div>
                            </td>
                            <td>
                                @if($a->status === 'published')
                                    <span class="badge bg-success" style="font-size: 0.8rem; padding: 6px 10px; border-radius: 6px;">
                                        <i class="fa-solid fa-check me-1"></i> Disetujui (ACC)
                                    </span>
                                @elseif($a->status === 'pending')
                                    <span class="badge bg-warning text-dark" style="font-size: 0.8rem; padding: 6px 10px; border-radius: 6px;">
                                        <i class="fa-solid fa-clock me-1"></i> Menunggu ACC
                                    </span>
                                @else
                                    <span class="badge bg-secondary" style="font-size: 0.8rem; padding: 6px 10px; border-radius: 6px;">
                                        <i class="fa-solid fa-eye-slash me-1"></i> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                @if($a->status !== 'published')
                                <form action="{{ route('admin.alumni.approve', $a) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button class="btn btn-sm btn-success text-white px-2" title="ACC / Setujui Tampil">
                                        <i class="fa-solid fa-check me-1"></i> ACC
                                    </button>
                                </form>
                                @endif
                                @if($a->status !== 'rejected')
                                <form action="{{ route('admin.alumni.reject', $a) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button class="btn btn-sm btn-outline-warning px-2" title="Tolak / Sembunyikan">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.alumni.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan alumni ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger px-2" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="fa-solid fa-inbox fa-2x mb-2 text-secondary opacity-50 d-block"></i>
                                Belum ada kiriman data alumni.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $alumni->links() }}
        </div>
    </div>
</div>
@endsection
