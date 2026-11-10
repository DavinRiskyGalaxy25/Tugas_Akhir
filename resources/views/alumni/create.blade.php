@extends('layouts.app')

@section('title', 'Tulis Pesan Alumni - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>Pesan &amp; Kesan Alumni</h2>
        </div>
    </section>

    <section class="content-section">
        <div class="section-container" style="max-width: 860px; margin: 0 auto;">
            <a href="{{ route('alumni.index') }}" class="back-to-page">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Pesan Alumni
            </a>

            <div class="form-card alumni-form-card">
                <div class="form-card-header">
                    <h2 class="form-title">Tulis Kesan &amp; Cerita Alumni</h2>
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
                                <label for="tahun_lulus">Tahun Kelulusan</label>
                                <span class="field-feedback" id="tahun_lulus_feedback"></span>
                            </div>
                            <input type="text" id="tahun_lulus" name="tahun_lulus" maxlength="4" inputmode="numeric" value="{{ old('tahun_lulus') }}" placeholder="Masukkan tahun kelulusan" class="@error('tahun_lulus') input-has-error @enderror">
                            @error('tahun_lulus')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="pekerjaan_sekarang">Pendidikan / Profesi Saat Ini</label>
                            </div>
                            <input type="text" id="pekerjaan_sekarang" name="pekerjaan_sekarang" value="{{ old('pekerjaan_sekarang') }}" placeholder="Masukkan pendidikan atau profesi saat ini" class="@error('pekerjaan_sekarang') input-has-error @enderror">
                            @error('pekerjaan_sekarang')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- RATING BINTANG INTERAKTIF -->
                        <div class="form-group form-group-full">
                            <div class="form-label-wrap">
                                <label>Penilaian / Rating Sekolah <span class="required-star">*</span></label>
                                <span class="rating-text-hint" id="ratingTextHint">Sangat Baik (5 Bintang)</span>
                            </div>
                            <div class="star-rating-box">
                                <div class="star-rating-inputs" id="starRatingInputs">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating', '5') == $i ? 'checked' : '' }}>
                                        <label for="star{{ $i }}" title="{{ $i }} Bintang">
                                            <i class="fa-solid fa-star"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <small class="field-note">Berikan bintang kepuasan dan apresiasi Anda selama bersekolah di SMP Al Ahmad Krian.</small>
                            @error('rating')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="pesan_kesan">Kesan, Pesan &amp; Pengalaman <span class="required-star">*</span></label>
                            <span class="field-feedback" id="pesan_kesan_feedback"></span>
                        </div>
                        <textarea id="pesan_kesan" name="pesan_kesan" rows="5" required placeholder="Tuliskan pengalaman berkesan selama bersekolah, pesan untuk adik-adik kelas, atau apresiasi untuk bapak/ibu guru..." class="@error('pesan_kesan') input-has-error @enderror">{{ old('pesan_kesan') }}</textarea>
                        @error('pesan_kesan')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions-bar">
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
            tahunFeedback.textContent = 'Format tahun 4 digit (misal: 2020)';
            tahunFeedback.style.color = '#eab308';
        } else {
            tahunFeedback.textContent = '';
        }
    });

    // Interactive Star Rating Text Feedback
    const starLabels = {
        '5': 'Sangat Memuaskan (5 Bintang)',
        '4': 'Bagus Sekali (4 Bintang)',
        '3': 'Cukup Baik (3 Bintang)',
        '2': 'Kurang Memuaskan (2 Bintang)',
        '1': 'Perlu Peningkatan (1 Bintang)'
    };

    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    const ratingHint = document.getElementById('ratingTextHint');

    function updateRatingHint(val) {
        if (ratingHint && starLabels[val]) {
            ratingHint.textContent = starLabels[val];
        }
    }

    ratingInputs.forEach(input => {
        if (input.checked) {
            updateRatingHint(input.value);
        }
        input.addEventListener('change', function () {
            updateRatingHint(this.value);
        });
    });
});
</script>
@endpush
