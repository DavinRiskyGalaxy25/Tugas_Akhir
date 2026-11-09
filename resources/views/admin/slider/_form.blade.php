@php $s = $slider ?? null; @endphp
<div class="row g-3 mb-3">
    <div class="col-md-8">
        <label class="form-label">Judul Slide (opsional)</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $s->judul ?? '') }}" placeholder="Contoh: Selamat Datang di SMP Al Ahmad Krian">
    </div>

    <div class="col-md-4">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $s->urutan ?? 0) }}" min="0">
    </div>

    <div class="col-12">
        <label class="form-label">Subjudul / Deskripsi Singkat Slide</label>
        <textarea name="subjudul" class="form-control" rows="2" placeholder="Teks penjelasan singkat pada slide">{{ old('subjudul', $s->subjudul ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Teks Tombol (opsional)</label>
        <input type="text" name="tombol_teks" class="form-control" value="{{ old('tombol_teks', $s->tombol_teks ?? 'Selengkapnya') }}" placeholder="Contoh: Selengkapnya / Daftar Sekarang">
    </div>

    <div class="col-md-6">
        <label class="form-label">Tautan / URL Tombol</label>
        <input type="text" name="tombol_url" class="form-control" value="{{ old('tombol_url', $s->tombol_url ?? '/profil#tentang') }}" placeholder="Contoh: /profil atau /ppdb">
    </div>

    <div class="col-md-8">
        <label class="form-label">Gambar Background Slide <span class="text-danger">*</span> {{ $s ? '(Pilih jika ingin mengganti)' : '' }}</label>
        <input type="file" name="gambar" class="form-control" accept="image/*" {{ $s ? '' : 'required' }}>
        <small class="text-muted">Resolusi rekomendasi: minimal 1920x800px (format: JPG, PNG, WEBP, maks. 3MB).</small>
    </div>

    <div class="col-md-4 d-flex align-items-center mt-4">
        <div class="form-check form-switch mt-2">
            <input type="checkbox" name="status_aktif" value="1" class="form-check-input" id="status_aktif" {{ old('status_aktif', $s->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="status_aktif">Aktifkan Slide di Beranda</label>
        </div>
    </div>

    @if($s && $s->gambar)
    <div class="col-12 mt-3">
        <label class="form-label d-block">Pratinjau Gambar Background Saat Ini:</label>
        <img src="{{ $s->gambar_url }}" class="img-fluid rounded border shadow-sm" style="max-height: 200px; width: 100%; object-fit: cover;">
    </div>
    @endif
</div>

