@extends('admin.layouts.admin')

@section('title', 'Edit Slide Background')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold mb-0">Edit Slide Background Beranda</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.slider.update', $slider) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.slider._form')
            <div class="d-flex gap-2">
                <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Perbarui Slide</button>
            </div>
        </form>
    </div>
</div>
@endsection

