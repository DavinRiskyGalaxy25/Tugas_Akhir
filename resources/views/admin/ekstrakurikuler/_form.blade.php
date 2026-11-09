@php $e = $ekstrakurikuler ?? null; @endphp
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $e->nama ?? '') }}" placeholder="Contoh: Pramuka, Futsal, Qiroah" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Ikon Cadangan (Font Awesome class, opsional)</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $e->icon ?? 'fa-solid fa-star') }}" placeholder="Contoh: fa-solid fa-campground">
        <small class="text-muted">Digunakan sebagai cadangan jika gambar kegiatan tidak diunggah.</small>
    </div>
    <div class="col-md-6">
        <label class="form-label">Pembina / Pelatih</label>
        <input type="text" name="pembina" class="form-control" value="{{ old('pembina', $e->pembina ?? '') }}" placeholder="Nama guru / pembina ekskul">
    </div>
    <div class="col-md-6">
        <label class="form-label">Jadwal Latihan</label>
        <input type="text" name="jadwal" class="form-control" value="{{ old('jadwal', $e->jadwal ?? '') }}" placeholder="Contoh: Setiap Sabtu, 08.00 - 10.00 WIB">
    </div>
    <div class="col-md-6">
        <label class="form-label">Lokasi Latihan</label>
        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $e->lokasi ?? '') }}" placeholder="Contoh: Lapangan Utama / Aula Sekolah">
    </div>
    <div class="col-md-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $e->urutan ?? 0) }}" min="0">
    </div>
    <div class="col-md-3 d-flex align-items-center mt-4">
        <div class="form-check form-switch mt-2">
            <input type="checkbox" name="status_aktif" value="1" class="form-check-input" id="status_aktif" {{ old('status_aktif', $e->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="status_aktif">Tampilkan di Website</label>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi Ekstrakurikuler</label>
        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan tujuan, aktivitas, dan manfaat dari ekstrakurikuler ini...">{{ old('deskripsi', $e->deskripsi ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Foto Kegiatan Ekstrakurikuler {{ $e && $e->foto ? '(Pilih jika ingin mengganti)' : '' }}</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        <small class="text-muted">Akan ditampilkan sebagai cover kartu di halaman kesiswaan (Maks. 2MB).</small>
    </div>
    <div class="col-md-6">
        @if($e && $e->foto)
            <label class="form-label d-block">Foto Saat Ini:</label>
            <img src="{{ $e->foto_url }}" class="rounded border shadow-sm" style="max-height: 120px; width: 180px; object-fit: cover;">
        @endif
    </div>
</div>
