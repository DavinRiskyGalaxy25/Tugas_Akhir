@extends('admin.layouts.admin')

@section('title', 'Edit Anggota Struktur Organisasi')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold mb-0">Edit Anggota Struktur Organisasi</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.struktur.update', $struktur) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.struktur._form')
            <div class="d-flex gap-2">
                <a href="{{ route('admin.struktur.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Perbarui Anggota</button>
            </div>
        </form>
    </div>
</div>
@endsection

