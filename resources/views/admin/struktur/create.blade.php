@extends('admin.layouts.admin')

@section('title', 'Tambah Anggota Struktur Organisasi')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold mb-0">Tambah Anggota Struktur Organisasi</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.struktur.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.struktur._form')
            <div class="d-flex gap-2">
                <a href="{{ route('admin.struktur.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Anggota</button>
            </div>
        </form>
    </div>
</div>
@endsection

