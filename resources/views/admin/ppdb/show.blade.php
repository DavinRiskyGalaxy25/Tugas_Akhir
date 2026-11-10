@extends('admin.layouts.admin')
@section('title', 'Detail Pendaftar')
@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-4">
                    @if($pendaftar->pas_foto)
                        <img src="{{ asset('storage/' . $pendaftar->pas_foto) }}" alt="Pas Foto {{ $pendaftar->nama_lengkap }}" class="rounded object-fit-cover shadow-sm" style="width: 72px; height: 96px; border: 1px solid #e2e8f0;">
                    @else
                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-secondary" style="width: 72px; height: 96px;">
                            <i class="fa-solid fa-user fa-2x"></i>
                        </div>
                    @endif
                    <div>
                        <h4 class="fw-bold mb-1 text-dark">{{ $pendaftar->nama_lengkap }}</h4>
                        <div class="text-muted small">
                            <span class="me-3"><i class="fa-solid fa-id-card me-1"></i> NIK: <strong>{{ $pendaftar->nik }}</strong></span>
                            <span><i class="fa-solid fa-graduation-cap me-1"></i> NISN: <strong>{{ $pendaftar->nisn ?? '-' }}</strong></span>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold text-uppercase text-secondary small mb-3 pb-2 border-bottom">1. Biodata Calon Siswa</h6>
                <table class="table table-sm table-borderless mb-4">
                    <tr><th width="200" class="text-muted">Tempat, Tgl Lahir</th><td>{{ $pendaftar->tempat_lahir }}, {{ optional($pendaftar->tanggal_lahir)->format('d F Y') ?? '-' }}</td></tr>
                    <tr><th class="text-muted">Jenis Kelamin</th><td>{{ $pendaftar->jenis_kelamin }}</td></tr>
                    <tr><th class="text-muted">Asal Sekolah</th><td><strong>{{ $pendaftar->asal_sekolah }}</strong></td></tr>
                    <tr><th class="text-muted">No. HP / WA Siswa</th><td><a href="https://wa.me/{{ preg_replace('/^0/', '62', $pendaftar->no_hp) }}" target="_blank" class="text-decoration-none text-success fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> {{ $pendaftar->no_hp }}</a></td></tr>
                    <tr><th class="text-muted">Email</th><td>{{ $pendaftar->email ?? '-' }}</td></tr>
                    <tr><th class="text-muted">Alamat Tinggal</th><td>{{ $pendaftar->alamat }}</td></tr>
                </table>

                <h6 class="fw-bold text-uppercase text-secondary small mb-3 pb-2 border-bottom">2. Data Orang Tua / Wali</h6>
                <table class="table table-sm table-borderless mb-4">
                    <tr><th width="200" class="text-muted">Nama Orang Tua / Wali</th><td>{{ $pendaftar->nama_wali }}</td></tr>
                    <tr><th class="text-muted">No. HP / WA Wali</th><td><a href="https://wa.me/{{ preg_replace('/^0/', '62', $pendaftar->no_hp_wali) }}" target="_blank" class="text-decoration-none text-success fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> {{ $pendaftar->no_hp_wali }}</a></td></tr>
                    <tr><th class="text-muted">Keterangan / Minat</th><td>{{ $pendaftar->keterangan_tambahan ?? '-' }}</td></tr>
                    <tr><th class="text-muted">Waktu Pendaftaran</th><td>{{ $pendaftar->created_at->format('d F Y H:i:s') }} ({{ $pendaftar->created_at->diffForHumans() }})</td></tr>
                </table>

                <h6 class="fw-bold text-uppercase text-secondary small mb-3 pb-2 border-bottom">3. Berkas Dokumen Persyaratan</h6>
                <div class="row g-3">
                    <!-- KARTU KELUARGA -->
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold small text-dark"><i class="fa-solid fa-file-invoice text-primary me-2"></i> Kartu Keluarga (KK)</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $pendaftar->kartu_keluarga ? 'Dokumen terlampir' : 'Belum diunggah' }}</div>
                            </div>
                            @if($pendaftar->kartu_keluarga)
                                <a href="{{ asset('storage/' . $pendaftar->kartu_keluarga) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-eye me-1"></i> Buka
                                </a>
                            @else
                                <span class="badge bg-secondary">Tidak ada</span>
                            @endif
                        </div>
                    </div>

                    <!-- AKTA KELAHIRAN -->
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold small text-dark"><i class="fa-solid fa-certificate text-success me-2"></i> Akta Kelahiran</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $pendaftar->akta_kelahiran ? 'Dokumen terlampir' : 'Belum diunggah' }}</div>
                            </div>
                            @if($pendaftar->akta_kelahiran)
                                <a href="{{ asset('storage/' . $pendaftar->akta_kelahiran) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fa-solid fa-eye me-1"></i> Buka
                                </a>
                            @else
                                <span class="badge bg-secondary">Tidak ada</span>
                            @endif
                        </div>
                    </div>

                    <!-- IJAZAH / SKL -->
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold small text-dark"><i class="fa-solid fa-scroll text-warning me-2"></i> Ijazah / SKL</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $pendaftar->ijazah_skl ? 'Dokumen terlampir' : 'Belum diunggah' }}</div>
                            </div>
                            @if($pendaftar->ijazah_skl)
                                <a href="{{ asset('storage/' . $pendaftar->ijazah_skl) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                    <i class="fa-solid fa-eye me-1"></i> Buka
                                </a>
                            @else
                                <span class="badge bg-secondary">Tidak ada</span>
                            @endif
                        </div>
                    </div>

                    <!-- PAS FOTO -->
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold small text-dark"><i class="fa-solid fa-image text-info me-2"></i> Pas Foto 3x4</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $pendaftar->pas_foto ? 'Foto terlampir' : 'Belum diunggah' }}</div>
                            </div>
                            @if($pendaftar->pas_foto)
                                <a href="{{ asset('storage/' . $pendaftar->pas_foto) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fa-solid fa-eye me-1"></i> Buka
                                </a>
                            @else
                                <span class="badge bg-secondary">Tidak ada</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Status Pendaftaran</h6>
                <form method="POST" action="{{ route('admin.ppdb.status', $pendaftar) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label small text-muted">Status Calon Siswa</label>
                        <select name="status" class="form-select">
                            @foreach(['menunggu','diverifikasi','diterima','ditolak'] as $s)
                                <option value="{{ $s }}" {{ $pendaftar->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary w-100"><i class="fa-solid fa-check me-1"></i> Simpan Status</button>
                </form>
                <hr>
                <div class="d-flex flex-column gap-2">
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pendaftar->no_hp_wali) }}?text={{ urlencode('Halo Bapak/Ibu ' . $pendaftar->nama_wali . ', kami dari Panitia SPMB SMP Al Ahmad Krian ingin mengonfirmasi pendaftaran ananda ' . $pendaftar->nama_lengkap . '.') }}" target="_blank" class="btn btn-outline-success w-100">
                        <i class="fa-brands fa-whatsapp me-1"></i> Hubungi Wali via WhatsApp
                    </a>
                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-light w-100">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
