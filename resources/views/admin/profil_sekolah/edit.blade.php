@extends('admin.layouts.admin')

@section('title', 'Kelola Profil Sekolah')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-1"><i class="fa-solid fa-school text-success me-2"></i> Pengelolaan Profil Sekolah</h5>
                <p class="text-muted small mb-0">Kelola Visi Misi, Sejarah, Tentang Sekolah, Identitas, dan Sambutan Kepala Sekolah.</p>
            </div>
            <a href="{{ route('profil') }}" target="_blank" class="btn btn-sm btn-outline-success">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Lihat Halaman Profil
            </a>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.profil-sekolah.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nav Tabs -->
            <ul class="nav nav-pills mb-4 gap-2" id="profilTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="visi-tab" data-bs-toggle="tab" data-bs-target="#tab-visi" type="button" role="tab">
                        <i class="fa-solid fa-bullseye me-1"></i> Visi &amp; Misi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sejarah-tab" data-bs-toggle="tab" data-bs-target="#tab-sejarah" type="button" role="tab">
                        <i class="fa-solid fa-landmark me-1"></i> Sejarah
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tentang-tab" data-bs-toggle="tab" data-bs-target="#tab-tentang" type="button" role="tab">
                        <i class="fa-solid fa-circle-info me-1"></i> Tentang Sekolah
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="identitas-tab" data-bs-toggle="tab" data-bs-target="#tab-identitas" type="button" role="tab">
                        <i class="fa-solid fa-id-card me-1"></i> Identitas Sekolah
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sambutan-tab" data-bs-toggle="tab" data-bs-target="#tab-sambutan" type="button" role="tab">
                        <i class="fa-solid fa-comment-dots me-1"></i> Sambutan Kepala Sekolah
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bagan-tab" data-bs-toggle="tab" data-bs-target="#tab-bagan" type="button" role="tab">
                        <i class="fa-solid fa-sitemap me-1"></i> Bagan Struktur
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="profilTabsContent">

                <!-- 1. TAB VISI & MISI -->
                <div class="tab-pane fade show active" id="tab-visi" role="tabpanel">
                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-lightbulb text-warning me-2"></i> Visi Sekolah</h6>
                        <div class="mb-3">
                            <label class="form-label">Pernyataan Visi</label>
                            <textarea name="visi" class="form-control" rows="3" placeholder="Tuliskan visi sekolah...">{{ old('visi', $pengaturan['visi'] ?? '') }}</textarea>
                            <small class="text-muted">Akan ditampilkan pada bagian kartu Visi Sekolah.</small>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-bullseye text-danger me-2"></i> Misi Sekolah</h6>
                        <div class="mb-3">
                            <label class="form-label">Daftar Misi Sekolah (Pisahkan setiap poin misi dengan baris baru / Enter)</label>
                            <textarea name="misi" class="form-control" rows="6" placeholder="Poin 1...&#10;Poin 2...&#10;Poin 3...">{{ old('misi', $pengaturan['misi'] ?? '') }}</textarea>
                            <small class="text-muted">Setiap baris kalimat baru akan otomatis menjadi butir list (bullet point) di halaman website.</small>
                        </div>
                    </div>
                </div>

                <!-- 2. TAB SEJARAH -->
                <div class="tab-pane fade" id="tab-sejarah" role="tabpanel">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Informasi Sejarah</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal / Tahun Pendirian</label>
                                <input type="text" name="sejarah_tahun_pendirian" class="form-control" value="{{ old('sejarah_tahun_pendirian', $pengaturan['sejarah_tahun_pendirian'] ?? '17 Juli 1977') }}" placeholder="Contoh: 17 Juli 1977">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor SK / Izin Operasional</label>
                                <input type="text" name="sejarah_izin_operasional" class="form-control" value="{{ old('sejarah_izin_operasional', $pengaturan['sejarah_izin_operasional'] ?? '421.3/2700/404.3.1/2010') }}" placeholder="Nomor izin operasional sekolah">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Teks Sejarah Sekolah Lengkap</label>
                                <textarea name="sejarah" class="form-control" rows="8" placeholder="Tuliskan narasi perjalanan dan sejarah sekolah...">{{ old('sejarah', $pengaturan['sejarah'] ?? '') }}</textarea>
                                <small class="text-muted">Dapat ditulis dalam beberapa paragraf.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. TAB TENTANG SEKOLAH -->
                <div class="tab-pane fade" id="tab-tentang" role="tabpanel">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-building text-info me-2"></i> Narasi &amp; Gambar Tentang Sekolah</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Ringkasan Tentang Sekolah (Ditampilkan di Beranda)</label>
                                <textarea name="tentang_sekolah_ringkas" class="form-control" rows="2" placeholder="Ringkasan singkat untuk section beranda...">{{ old('tentang_sekolah_ringkas', $pengaturan['tentang_sekolah_ringkas'] ?? '') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi Lengkap Tentang Sekolah (Ditampilkan di Halaman Profil)</label>
                                <textarea name="tentang_sekolah" class="form-control" rows="6" placeholder="Teks lengkap tentang profil dan keberadaan sekolah...">{{ old('tentang_sekolah', $pengaturan['tentang_sekolah'] ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto / Gambar Sekolah {{ !empty($pengaturan['tentang_sekolah_gambar']) ? '(Pilih jika ingin mengganti)' : '' }}</label>
                                <input type="file" name="tentang_sekolah_gambar" class="form-control" accept="image/*">
                                <small class="text-muted">Maksimal 2MB (format: JPG, PNG, WEBP).</small>
                            </div>
                            <div class="col-md-6">
                                @if(!empty($pengaturan['tentang_sekolah_gambar']))
                                    <label class="form-label d-block">Gambar Saat Ini:</label>
                                    @php
                                        $imgUrl = str_starts_with($pengaturan['tentang_sekolah_gambar'], 'assets/')
                                            ? asset($pengaturan['tentang_sekolah_gambar'])
                                            : asset('storage/'.$pengaturan['tentang_sekolah_gambar']);
                                    @endphp
                                    <img src="{{ $imgUrl }}" class="img-fluid rounded border shadow-sm" style="max-height: 160px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. TAB IDENTITAS SEKOLAH -->
                <div class="tab-pane fade" id="tab-identitas" role="tabpanel">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-id-card text-success me-2"></i> Data Identitas Sekolah</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">NPSN (Nomor Pokok Sekolah Nasional)</label>
                                <input type="text" name="identitas_npsn" class="form-control" value="{{ old('identitas_npsn', $pengaturan['identitas_npsn'] ?? '20501673') }}" placeholder="Contoh: 20501673">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status Sekolah</label>
                                <input type="text" name="identitas_status" class="form-control" value="{{ old('identitas_status', $pengaturan['identitas_status'] ?? 'Swasta') }}" placeholder="Contoh: Swasta">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bentuk Pendidikan</label>
                                <input type="text" name="identitas_bentuk" class="form-control" value="{{ old('identitas_bentuk', $pengaturan['identitas_bentuk'] ?? 'Sekolah Menengah Pertama (SMP)') }}" placeholder="Contoh: Sekolah Menengah Pertama (SMP)">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Akreditasi</label>
                                <input type="text" name="identitas_akreditasi" class="form-control" value="{{ old('identitas_akreditasi', $pengaturan['identitas_akreditasi'] ?? 'B') }}" placeholder="Contoh: A / B / Unggul">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kurikulum yang Diterapkan</label>
                                <input type="text" name="identitas_kurikulum" class="form-control" value="{{ old('identitas_kurikulum', $pengaturan['identitas_kurikulum'] ?? 'Kurikulum Merdeka') }}" placeholder="Contoh: Kurikulum Merdeka">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Yayasan / Lembaga Naungan</label>
                                <input type="text" name="identitas_naungan" class="form-control" value="{{ old('identitas_naungan', $pengaturan['identitas_naungan'] ?? 'Badan Pelaksana Pendidikan Ma\'arif NU Al-Ahmad') }}" placeholder="Nama yayasan naungan">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. TAB SAMBUTAN KEPALA SEKOLAH -->
                <div class="tab-pane fade" id="tab-sambutan" role="tabpanel">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-user-tie text-primary me-2"></i> Sambutan Kepala Sekolah</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Kepala Sekolah</label>
                                <input type="text" name="sambutan_nama_kepala" class="form-control" value="{{ old('sambutan_nama_kepala', $pengaturan['sambutan_nama_kepala'] ?? 'KH. Drs. M. Sudi Khotib, MM.') }}" placeholder="Nama beserta gelar">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jabatan / Gelar Panggilan</label>
                                <input type="text" name="sambutan_jabatan_kepala" class="form-control" value="{{ old('sambutan_jabatan_kepala', $pengaturan['sambutan_jabatan_kepala'] ?? 'Kepala Sekolah SMP Al Ahmad Krian') }}" placeholder="Contoh: Kepala Sekolah SMP Al Ahmad Krian">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Kutipan Singkat (Quote di Beranda)</label>
                                <textarea name="sambutan_quote" class="form-control" rows="2" placeholder="Kutipan pesan bijak kepala sekolah...">{{ old('sambutan_quote', $pengaturan['sambutan_quote'] ?? '') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Teks Sambutan Lengkap</label>
                                <textarea name="sambutan_kepala_sekolah" class="form-control" rows="5" placeholder="Teks sambutan kepala sekolah...">{{ old('sambutan_kepala_sekolah', $pengaturan['sambutan_kepala_sekolah'] ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto Kepala Sekolah {{ !empty($pengaturan['sambutan_foto']) ? '(Pilih jika ingin mengganti)' : '' }}</label>
                                <input type="file" name="sambutan_foto" class="form-control" accept="image/*">
                                <small class="text-muted">Format foto: JPG, PNG, WEBP.</small>
                            </div>
                            <div class="col-md-6">
                                @if(!empty($pengaturan['sambutan_foto']))
                                    <label class="form-label d-block">Foto Saat Ini:</label>
                                    @php
                                        $fotoUrl = str_starts_with($pengaturan['sambutan_foto'], 'assets/')
                                            ? asset($pengaturan['sambutan_foto'])
                                            : asset('storage/'.$pengaturan['sambutan_foto']);
                                    @endphp
                                    <img src="{{ $fotoUrl }}" class="rounded border shadow-sm" style="max-height: 140px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. TAB BAGAN STRUKTUR ORGANISASI -->
                <div class="tab-pane fade" id="tab-bagan" role="tabpanel">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-sitemap text-success me-2"></i> Gambar Bagan Struktur Organisasi</h6>
                                <p class="text-muted small mb-0">Unggah bagan/infografis bagan organisasi jika ada.</p>
                            </div>
                            <a href="{{ route('admin.struktur.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-users me-1"></i> Kelola Daftar Pengurus
                            </a>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Unggah Gambar Bagan {{ !empty($pengaturan['bagan_struktur_organisasi']) ? '(Pilih jika ingin mengganti)' : '' }}</label>
                                <input type="file" name="bagan_struktur_organisasi" class="form-control" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, WEBP (maksimal 3MB).</small>
                            </div>
                            <div class="col-md-6">
                                @if(!empty($pengaturan['bagan_struktur_organisasi']))
                                    <label class="form-label d-block">Bagan Saat Ini:</label>
                                    @php
                                        $baganUrl = str_starts_with($pengaturan['bagan_struktur_organisasi'], 'assets/')
                                            ? asset($pengaturan['bagan_struktur_organisasi'])
                                            : asset('storage/'.$pengaturan['bagan_struktur_organisasi']);
                                    @endphp
                                    <a href="{{ $baganUrl }}" target="_blank">
                                        <img src="{{ $baganUrl }}" class="img-fluid rounded border shadow-sm" style="max-height: 200px; object-fit: contain;">
                                    </a>
                                @else
                                    <p class="text-muted small">Belum ada bagan yang diunggah. Website akan menampilkan kartu struktur organisasi pejabat/staf.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

