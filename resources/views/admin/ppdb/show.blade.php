@extends('admin.layouts.admin')
@section('title', 'Detail Pendaftar')
@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card"><div class="card-body">
            <h5 class="fw-bold mb-3">Detail Pendaftar</h5>
            <table class="table table-borderless">
                <tr><th width="220">Nama Lengkap</th><td>{{ $pendaftar->nama_lengkap }}</td></tr>
                <tr><th>NIK</th><td>{{ $pendaftar->nik }}</td></tr>
                <tr><th>NISN</th><td>{{ $pendaftar->nisn ?? '-' }}</td></tr>
                <tr><th>Tempat, Tanggal Lahir</th><td>{{ $pendaftar->tempat_lahir }}, {{ optional($pendaftar->tanggal_lahir)->format('d F Y') ?? '-' }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ $pendaftar->jenis_kelamin }}</td></tr>
                <tr><th>Alamat</th><td>{{ $pendaftar->alamat }}</td></tr>
                <tr><th>No HP</th><td>{{ $pendaftar->no_hp }}</td></tr>
                <tr><th>Email</th><td>{{ $pendaftar->email ?? '-' }}</td></tr>
                <tr><th>Asal Sekolah</th><td>{{ $pendaftar->asal_sekolah }}</td></tr>
                <tr><th>Nama Wali</th><td>{{ $pendaftar->nama_wali }}</td></tr>
                <tr><th>No HP Wali</th><td>{{ $pendaftar->no_hp_wali }}</td></tr>
                <tr><th>Keterangan Tambahan</th><td>{{ $pendaftar->keterangan_tambahan ?? '-' }}</td></tr>
                <tr><th>Tanggal Daftar</th><td>{{ $pendaftar->created_at->format('d F Y H:i') }}</td></tr>
            </table>
        </div></div>
    </div>
    <div class="col-lg-4">
        <div class="card"><div class="card-body">
            <h6 class="fw-bold mb-3">Ubah Status</h6>
            <form method="POST" action="{{ route('admin.ppdb.status', $pendaftar) }}">
                @csrf @method('PUT')
                <select name="status" class="form-select mb-3">
                    @foreach(['menunggu','diverifikasi','diterima','ditolak'] as $s)
                        <option value="{{ $s }}" {{ $pendaftar->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary w-100">Simpan Status</button>
            </form>
            <a href="{{ route('admin.ppdb.index') }}" class="btn btn-light w-100 mt-2">Kembali</a>
        </div></div>
    </div>
</div>
@endsection
