@extends('admin.layouts.admin')

@section('title', 'Tambah Slide Background')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold mb-0">Tambah Slide Background Beranda</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.slider._form')
            <div class="d-flex gap-2">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Slide</button>
            </div>
        </form>
    </div>
</div>
@endsection

