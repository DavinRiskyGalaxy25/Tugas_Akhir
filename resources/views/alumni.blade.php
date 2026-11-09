@extends('layouts.app')

@section('title', 'Alumni - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Kesan &amp; Pesan Alumni</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="form-card">
            <div class="form-card-header">
                <span class="form-eyebrow">JEJARING ALUMNI</span>
                <h2 class="form-title">Tulis Kesan &amp; Cerita Alumni</h2>
                <p class="form-desc">Bagikan pengalaman, kenangan berharga, dan inspirasi Anda selama menempuh pendidikan di {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
            </div>

            @if(session('success'))
                <div class="alert-box success" role="alert">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-box error" role="alert">
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
                    <div class="form-group form-group-full">
                        <div class="form-label-wrap">
                            <label for="nama">Nama Lengkap <span class="required-star">*</span></label>
                            <span class="field-feedback" id="nama_feedback"></span>
                        </div>
                        <input type="text" id="nama" name="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap Anda" class="@error('nama') input-has-error @enderror">
                        @error('nama')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="tahun_lulus">Tahun Kelulusan (opsional)</label>
                            <span class="field-feedback" id="tahun_lulus_feedback"></span>
                        </div>
                        <input type="text" id="tahun_lulus" name="tahun_lulus" maxlength="4" inputmode="numeric" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2022" class="@error('tahun_lulus') input-has-error @enderror">
                        @error('tahun_lulus')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="pekerjaan_sekarang">Pendidikan / Profesi Sekarang</label>
                        </div>
                        <input type="text" id="pekerjaan_sekarang" name="pekerjaan_sekarang" value="{{ old('pekerjaan_sekarang') }}" placeholder="Contoh: Mahasiswa ITS / Wiraswasta" class="@error('pekerjaan_sekarang') input-has-error @enderror">
                        @error('pekerjaan_sekarang')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-wrap">
                        <label for="pesan_kesan">Kesan, Pesan &amp; Pengalaman <span class="required-star">*</span></label>
                        <span class="field-feedback" id="pesan_kesan_feedback"></span>
                    </div>
                    <textarea id="pesan_kesan" name="pesan_kesan" rows="4" required placeholder="Ceritakan pengalaman berkesan, pesan untuk adik kelas, atau kesan terhadap bapak/ibu guru..." class="@error('pesan_kesan') input-has-error @enderror">{{ old('pesan_kesan') }}</textarea>
                    @error('pesan_kesan')
                        <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions-bar">
                    <div class="form-security-note">
                        <i class="fa-solid fa-info-circle"></i> Pesan akan ditinjau oleh pihak sekolah sebelum ditampilkan pada direktori alumni.
                    </div>
                    <div class="form-btn-group">
                        <button type="reset" class="btn-form-secondary">Reset</button>
                        <button type="submit" class="btn-form-primary">
                            <span>Kirim Kisah Alumni</span>
                            <i class="fa-solid fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="content-section alternate-section">
        <div class="section-container">
            <div class="section-heading">
                <span class="section-label">DIREKTORI ALUMNI</span>
                <h2>Kisah &amp; Jejak Langkah Alumni</h2>
                <p>Aspirasi dan pengalaman dari para lulusan {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
            </div>

            @if($alumni->isNotEmpty())
                <div class="alumni-stories-grid">
                    @foreach($alumni as $al)
                        <article class="alumni-card">
                            <blockquote class="alumni-quote-text">
                                &ldquo;{{ $al->pesan_kesan }}&rdquo;
                            </blockquote>
                            <div class="alumni-author-meta">
                                <div class="alumni-avatar-badge">
                                    {{ strtoupper(substr($al->nama, 0, 1)) }}
                                </div>
                                <div class="alumni-author-details">
                                    <h3 class="alumni-name">{{ $al->nama }}</h3>
                                    <span class="alumni-sub">
                                        @if($al->tahun_lulus) Lulusan {{ $al->tahun_lulus }} @endif
                                        @if($al->pekerjaan_sekarang) &middot; {{ $al->pekerjaan_sekarang }} @endif
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state-box">
                    <p>Belum ada kisah alumni yang dipublikasikan saat ini.</p>
                </div>
            @endif
        </div>
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
