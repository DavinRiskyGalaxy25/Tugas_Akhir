@extends('admin.layouts.admin')

@section('title', 'Tambah Ekstrakurikuler')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1 text-dark">Tambah Ekstrakurikuler</h5>
                <p class="text-muted small mb-0">Lengkapi formulir dan unggah foto kegiatan ekstrakurikuler baru.</p>
            </div>
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.ekstrakurikuler.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.ekstrakurikuler._form')

            <div class="d-flex align-items-center gap-2 mt-4 pt-2 border-top">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check me-1"></i> Simpan Ekstrakurikuler
                </button>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
