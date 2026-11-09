@php $s = $struktur ?? null; @endphp
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Nama Pejabat / Pengurus <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $s->nama ?? '') }}" placeholder="Contoh: KH. Drs. M. Sudi Khotib, MM." required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Jabatan Organisasi <span class="text-danger">*</span></label>
        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $s->jabatan ?? '') }}" placeholder="Contoh: KEPALA SEKOLAH / WAKA KURIKULUM 1" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kategori / Level</label>
        <select name="kategori" class="form-select">
            <option value="kepala_sekolah" @selected(old('kategori', $s->kategori ?? '') == 'kepala_sekolah')>Kepala Sekolah (Level Utama)</option>
            <option value="waka" @selected(old('kategori', $s->kategori ?? '') == 'waka')>Wakil Kepala Sekolah</option>
            <option value="staf" @selected(old('kategori', $s->kategori ?? '') == 'staf')>Staf / Tata Usaha / Guru</option>
            <option value="pimpinan" @selected(old('kategori', $s->kategori ?? '') == 'pimpinan')>Pimpinan / Dewan Lainnya</option>
        </select>
    </div>

    <div class="col-md-5">
        <label class="form-label">Keterangan / Sapaan (opsional)</label>
        <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $s->keterangan ?? '') }}" placeholder="Contoh: Abah Sudi / Bidang Akademik">
    </div>

    <div class="col-md-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $s->urutan ?? 0) }}" min="0">
    </div>

    <div class="col-md-6">
        <label class="form-label">Foto Pejabat (opsional) {{ $s && $s->foto ? '(Pilih jika ingin mengganti)' : '' }}</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <small class="text-muted">Format: JPG, PNG, WEBP (maks. 2MB).</small>
    </div>

    <div class="col-md-6 d-flex align-items-center mt-4">
        <div class="form-check form-switch mt-2">
            <input type="checkbox" name="status_aktif" value="1" class="form-check-input" id="status_aktif" {{ old('status_aktif', $s->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="status_aktif">Tampilkan di Bagan Struktur</label>
        </div>
    </div>

    @if($s && $s->foto)
    <div class="col-12 mt-2">
        <label class="form-label d-block">Foto Saat Ini:</label>
        <img src="{{ $s->foto_url }}" class="rounded border shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    @endif
</div>

