@extends('layouts.app')

@section('title', 'Alumni - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <span class="section-label">ALUMNI</span>
            <h2>Kesan &amp; Pesan Alumni</h2>
            <p>Bagikan pengalamanmu selama bersekolah di {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
        </div>
    </section>

    <section class="content-section">
        <div class="form-card">
            <div class="section-heading left">
                <span class="section-label">FORMULIR ALUMNI</span>
                <h2>Tulis Kesan &amp; Pesan</h2>
                <p>Pesan Anda akan tampil setelah disetujui oleh admin sekolah.</p>
            </div>

            @if(session('success'))
                <div class="alert-box success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-box error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <strong>Mohon periksa kembali formulir Anda:</strong>
                        <ul style="margin:4px 0 0; padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('alumni.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="nama">Nama Lengkap <span class="required-star">*</span></label>
                            <span class="field-feedback" id="nama_feedback"></span>
                        </div>
                        <input type="text" id="nama" name="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" class="@error('nama') input-has-error @enderror">
                        @error('nama')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="tahun_lulus">Tahun Lulus (opsional)</label>
                            <span class="field-feedback" id="tahun_lulus_feedback"></span>
                        </div>
                        <input type="text" id="tahun_lulus" name="tahun_lulus" maxlength="4" inputmode="numeric" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2022" class="@error('tahun_lulus') input-has-error @enderror">
                        @error('tahun_lulus')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="pekerjaan_sekarang">Kegiatan / Pekerjaan Sekarang</label>
                        </div>
                        <input type="text" id="pekerjaan_sekarang" name="pekerjaan_sekarang" value="{{ old('pekerjaan_sekarang') }}" placeholder="Contoh: Mahasiswa, Wirausaha, dsb." class="@error('pekerjaan_sekarang') input-has-error @enderror">
                        @error('pekerjaan_sekarang')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-wrap">
                        <label for="pesan_kesan">Kesan &amp; Pesan <span class="required-star">*</span></label>
                        <span class="field-feedback" id="pesan_kesan_feedback"></span>
                    </div>
                    <textarea id="pesan_kesan" name="pesan_kesan" rows="4" required placeholder="Tuliskan cerita, kesan, dan pesan inspiratif Anda selama di sekolah..." class="@error('pesan_kesan') input-has-error @enderror">{{ old('pesan_kesan') }}</textarea>
                    @error('pesan_kesan')
                        <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="reset" class="secondary-button dark">Reset</button>
                    <button type="submit" class="primary-button">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </section>

    <section class="content-section alternate-section">
        <div class="section-heading">
            <h2>Kesan &amp; Pesan Alumni Lainnya</h2>
        </div>

        @if($alumni->isNotEmpty())
            <div class="facility-grid">
                @foreach($alumni as $al)
                    <article class="facility-card">
                        <div class="facility-info">
                            <p style="font-style:italic;">&ldquo;{{ $al->pesan_kesan }}&rdquo;</p>
                            <h3>{{ $al->nama }}</h3>
                            <p><small>Alumni {{ $al->tahun_lulus }}@if($al->pekerjaan_sekarang) &middot; {{ $al->pekerjaan_sekarang }} @endif</small></p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="empty-state">Belum ada kesan &amp; pesan yang dipublikasikan.</p>
        @endif
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tahunInput = document.getElementById('tahun_lulus');
    const tahunFeedback = document.getElementById('tahun_lulus_feedback');

    tahunInput?.addEventListener('input', function () {
        let val = tahunInput.value.replace(/\D/g, '').slice(0, 4);
        tahunInput.value = val;
        if (val.length > 0 && val.length < 4) {
            tahunFeedback.className = 'field-feedback warning';
            tahunFeedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Format 4 digit (contoh: 2022)`;
        } else if (val.length === 4) {
            tahunFeedback.className = 'field-feedback success';
            tahunFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Sesuai`;
        } else {
            tahunFeedback.className = 'field-feedback';
            tahunFeedback.textContent = '';
        }
    });
});
</script>
@endpush
