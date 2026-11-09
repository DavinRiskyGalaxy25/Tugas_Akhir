@extends('admin.layouts.admin')
@section('title', 'Pengaturan Website')
@section('content')
<div class="card"><div class="card-body">
    <h5 class="fw-bold mb-3">Pengaturan Website</h5>
    <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" class="form-control" value="{{ old('nama_sekolah', $pengaturan['nama_sekolah'] ?? '') }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Logo Website {{ !empty($pengaturan['logo']) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                @if(!empty($pengaturan['logo_url']))
                    <div class="mt-2 d-flex align-items-center gap-2">
                        <span class="small text-muted">Preview logo:</span>
                        <img src="{{ $pengaturan['logo_url'] }}" class="p-1 bg-white border rounded" style="height: 44px; width: auto; max-width: 100px; object-fit: contain;">
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <label class="form-label">Poster SPMB / PPDB {{ !empty($pengaturan['poster_spmb']) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="file" name="poster_spmb" class="form-control" accept="image/*">
                @if(!empty($pengaturan['poster_spmb']))
                    <div class="mt-2 d-flex align-items-center gap-2">
                        <span class="small text-muted">Poster aktif:</span>
                        <a href="{{ asset('storage/'.$pengaturan['poster_spmb']) }}" target="_blank" class="badge bg-success text-decoration-none">Lihat Poster</a>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $pengaturan['alamat'] ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $pengaturan['telepon'] ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $pengaturan['email'] ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Website</label>
                <input type="text" name="website" class="form-control" value="{{ old('website', $pengaturan['website'] ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi Sekolah</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $pengaturan['deskripsi'] ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Link Instagram</label>
                <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $pengaturan['instagram'] ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Link Facebook</label>
                <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $pengaturan['facebook'] ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Link YouTube</label>
                <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $pengaturan['youtube'] ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Link TikTok</label>
                <input type="text" name="tiktok" class="form-control" value="{{ old('tiktok', $pengaturan['tiktok'] ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Link WhatsApp (format https://wa.me/62xxxx)</label>
                <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $pengaturan['whatsapp'] ?? '') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Pengaturan</button>
    </form>
</div></div>
@endsection
