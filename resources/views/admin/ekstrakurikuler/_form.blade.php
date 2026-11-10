@php $e = $ekstrakurikuler ?? null; @endphp

<!-- UNGGAH FOTO / GAMBAR EKSTRAKURIKULER (INPUT GAMBAR UTAMA) -->
<div class="mb-4">
    <label class="form-label d-block fw-bold text-dark mb-2">
        Foto / Gambar Kegiatan Ekstrakurikuler
        <span class="text-muted fw-normal small">(Wajib untuk tampilan cover kartu di website)</span>
    </label>

    <div class="img-upload-container d-flex flex-column flex-sm-row align-items-sm-center gap-3">
        <!-- FRAME PRATINJAU GAMBAR -->
        <div class="img-preview-frame">
            <img id="ekskulPreviewImg" src="{{ $e ? $e->foto_url : asset('assets/img/no-image.svg') }}" alt="Pratinjau Foto Ekstrakurikuler">
        </div>

        <div class="flex-grow-1">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                <label for="fotoEkskulInput" class="btn btn-outline-primary btn-sm mb-0">
                    <i class="fa-solid fa-cloud-arrow-up me-1"></i>
                    <span>{{ $e && $e->foto ? 'Ganti Foto Ekstrakurikuler' : 'Pilih Foto Ekstrakurikuler' }}</span>
                </label>
                <input type="file" name="foto" id="fotoEkskulInput" class="d-none" accept="image/png, image/jpeg, image/jpg, image/webp">
                <span id="ekskulFileNameBadge" class="badge bg-secondary d-none"></span>
            </div>
            <div class="small text-muted" style="line-height: 1.5;">
                Format yang didukung: <strong>JPG, JPEG, PNG, WebP</strong>. Maksimal <strong>2MB</strong>.<br>
                Foto ini akan otomatis menjadi cover kartu ekstrakurikuler di halaman kesiswaan.
            </div>
            @error('foto')
                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- INFORMASI DETAIL EKSTRAKURIKULER -->
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold text-dark">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $e->nama ?? '') }}" placeholder="Contoh: Pramuka, Futsal, Tari Tradisional, Qiroah" required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold text-dark">Pembina / Pelatih</label>
        <input type="text" name="pembina" class="form-control @error('pembina') is-invalid @enderror" value="{{ old('pembina', $e->pembina ?? '') }}" placeholder="Contoh: Bpk. Ahmad Fauzi, S.Pd.">
        @error('pembina')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold text-dark">Jadwal Latihan</label>
        <input type="text" name="jadwal" class="form-control @error('jadwal') is-invalid @enderror" value="{{ old('jadwal', $e->jadwal ?? '') }}" placeholder="Contoh: Setiap Sabtu, 08.00 - 10.00 WIB">
        @error('jadwal')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold text-dark">Lokasi Latihan</label>
        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $e->lokasi ?? '') }}" placeholder="Contoh: Lapangan Utama / Aula Sekolah">
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold text-dark">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $e->urutan ?? 0) }}" min="0" placeholder="0">
        <small class="text-muted">Urutan angka lebih kecil akan tampil lebih awal di halaman website.</small>
        @error('urutan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 d-flex align-items-center mt-md-4 pt-md-2">
        <div class="form-check form-switch mt-2">
            <input type="checkbox" name="status_aktif" value="1" class="form-check-input" id="status_aktif" {{ old('status_aktif', $e->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-bold text-dark ms-2" for="status_aktif">Tampilkan di Website (Status Aktif)</label>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold text-dark">Deskripsi / Keterangan Ekstrakurikuler</label>
        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Jelaskan secara singkat tujuan, aktivitas rutin, atau pencapaian dari ekstrakurikuler ini...">{{ old('deskripsi', $e->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fotoEkskulInput');
    const previewImg = document.getElementById('ekskulPreviewImg');
    const fileNameBadge = document.getElementById('ekskulFileNameBadge');

    if (fileInput && previewImg) {
        fileInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                // Tampilkan preview instan
                const reader = new FileReader();
                reader.onload = function(ev) {
                    previewImg.src = ev.target.result;
                };
                reader.readAsDataURL(file);

                // Tampilkan nama berkas
                if (fileNameBadge) {
                    fileNameBadge.textContent = file.name;
                    fileNameBadge.classList.remove('d-none');
                }
            }
        });
    }
});
</script>
