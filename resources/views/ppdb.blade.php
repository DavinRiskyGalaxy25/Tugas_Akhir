@extends('layouts.app')

@section('title', 'Pendaftaran SPMB - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <span class="section-label">PENERIMAAN PESERTA DIDIK BARU</span>
            <h2>SPMB {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</h2>
            <p>Formulir pendaftaran resmi calon peserta didik baru Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}.</p>
        </div>
    </section>

    <!-- INFORMASI / POSTER SECTION -->
    <section class="ppdb-poster-section">
        <div class="ppdb-poster-container">
            @if(!empty($pengaturan['poster_spmb']))
                <div class="ppdb-poster-image-wrap text-center">
                    <img src="{{ asset('storage/' . $pengaturan['poster_spmb']) }}" alt="Poster SPMB {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}" class="ppdb-poster-img">
                </div>
            @else
                <!-- ALUR 3 LANGKAH PENDAFTARAN RESMI (MENGGANTIKAN PLACEHOLDER KOSONG) -->
                <div class="spmb-guide-wrapper">
                    <div class="spmb-guide-header">
                        <span class="spmb-guide-eyebrow">PANDUAN PENDAFTARAN</span>
                        <h2>Alur Pendaftaran Calon Siswa Baru</h2>
                        <p>Tiga tahapan mudah untuk bergabung menjadi bagian dari keluarga besar {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}.</p>
                    </div>
                    <div class="spmb-steps-grid">
                        <div class="spmb-step-item">
                            <div class="spmb-step-num">01</div>
                            <div class="spmb-step-info">
                                <h3>Pengisian Formulir</h3>
                                <p>Lengkapi biodata calon siswa, nomor identitas (NIK/NISN), dan data kontak wali pada formulir di bawah ini.</p>
                            </div>
                        </div>
                        <div class="spmb-step-item">
                            <div class="spmb-step-num">02</div>
                            <div class="spmb-step-info">
                                <h3>Verifikasi Berkas</h3>
                                <p>Panitia SPMB memeriksa kelengkapan data dan akan menghubungi Anda via WhatsApp resmi untuk jadwal pemetaan/wawancara.</p>
                            </div>
                        </div>
                        <div class="spmb-step-item">
                            <div class="spmb-step-num">03</div>
                            <div class="spmb-step-info">
                                <h3>Daftar Ulang</h3>
                                <p>Penyerahan dokumen fisik (KK, Akta Kelahiran, Ijazah/SKL) dan konfirmasi administrasi di sekretariat sekolah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="content-section" id="formulirSpmb">
        <div class="form-card">
            <div class="form-card-header">
                <span class="form-eyebrow">FORMULIR PENDAFTARAN</span>
                <h2 class="form-title">Pendaftaran SPMB Online</h2>
                <p class="form-desc">Isi formulir pendaftaran dengan teliti dan benar sesuai dokumen kependudukan resmi (Kartu Keluarga / Akta Kelahiran).</p>
            </div>

            <!-- FEEDBACK ALERTS -->
            <div id="alertBoxContainer">
                @if(session('success'))
                    <div class="alert-box success" role="alert">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-box error" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-box error" role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>
                            <strong>Mohon periksa kembali isian formulir Anda:</strong>
                            <ul style="margin:6px 0 0; padding-left:18px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('ppdb.store') }}" id="ppdbForm" novalidate>
                @csrf

                <!-- SEKSI 1: DATA CALON SISWA -->
                <div class="form-section-block">
                    <div class="form-section-header">
                        <span class="form-section-badge">01</span>
                        <h3 class="form-section-heading">Data Identitas Calon Siswa</h3>
                    </div>

                    <div class="form-grid">
                        <!-- NAMA LENGKAP -->
                        <div class="form-group form-group-full">
                            <div class="form-label-wrap">
                                <label for="nama_lengkap">Nama Lengkap Siswa <span class="required-star">*</span></label>
                                <span class="field-feedback" id="nama_lengkap_feedback"></span>
                            </div>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap siswa sesuai KK/Akta" class="@error('nama_lengkap') input-has-error @enderror">
                            @error('nama_lengkap')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="nik">NIK Siswa (16 Digit) <span class="required-star">*</span></label>
                                <span class="field-feedback" id="nik_feedback"></span>
                            </div>
                            <input type="text" id="nik" name="nik" required maxlength="16" inputmode="numeric" value="{{ old('nik') }}" placeholder="16 digit angka sesuai Kartu Keluarga (KK)" class="@error('nik') input-has-error @enderror">
                            @error('nik')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NISN -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="nisn">NISN (opsional)</label>
                                <span class="field-feedback" id="nisn_feedback"></span>
                            </div>
                            <input type="text" id="nisn" name="nisn" maxlength="20" inputmode="numeric" value="{{ old('nisn') }}" placeholder="Nomor Induk Siswa Nasional (jika ada)" class="@error('nisn') input-has-error @enderror">
                            @error('nisn')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- TEMPAT LAHIR -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="tempat_lahir">Tempat Lahir <span class="required-star">*</span></label>
                                <span class="field-feedback" id="tempat_lahir_feedback"></span>
                            </div>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" required value="{{ old('tempat_lahir') }}" placeholder="Kota / Kabupaten tempat lahir" class="@error('tempat_lahir') input-has-error @enderror">
                            @error('tempat_lahir')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="tanggal_lahir">Tanggal Lahir <span class="required-star">*</span></label>
                                <span class="field-feedback" id="tanggal_lahir_feedback"></span>
                            </div>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}" class="@error('tanggal_lahir') input-has-error @enderror">
                            @error('tanggal_lahir')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- JENIS KELAMIN -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="jenis_kelamin">Jenis Kelamin <span class="required-star">*</span></label>
                                <span class="field-feedback" id="jenis_kelamin_feedback"></span>
                            </div>
                            <select id="jenis_kelamin" name="jenis_kelamin" required class="@error('jenis_kelamin') input-has-error @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" @selected(old('jenis_kelamin')=='Laki-laki')>Laki-laki</option>
                                <option value="Perempuan" @selected(old('jenis_kelamin')=='Perempuan')>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ASAL SEKOLAH -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="asal_sekolah">Asal Sekolah (SD/MI) <span class="required-star">*</span></label>
                                <span class="field-feedback" id="asal_sekolah_feedback"></span>
                            </div>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" required value="{{ old('asal_sekolah') }}" placeholder="Contoh: SDN Krian 1 / MI Al Ahmad" class="@error('asal_sekolah') input-has-error @enderror">
                            @error('asal_sekolah')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEKSI 2: DATA KONTAK & WALI -->
                <div class="form-section-block">
                    <div class="form-section-header">
                        <span class="form-section-badge">02</span>
                        <h3 class="form-section-heading">Data Kontak &amp; Orang Tua / Wali</h3>
                    </div>

                    <div class="form-grid">
                        <!-- NOMOR HP / WA SISWA -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="no_hp">No. HP / WhatsApp Siswa <span class="required-star">*</span></label>
                                <span class="field-feedback" id="no_hp_feedback"></span>
                            </div>
                            <input type="tel" id="no_hp" name="no_hp" required inputmode="numeric" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" class="@error('no_hp') input-has-error @enderror">
                            @error('no_hp')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- EMAIL SISWA -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="email">Email Siswa / Wali (opsional)</label>
                                <span class="field-feedback" id="email_feedback"></span>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="siswa@email.com" class="@error('email') input-has-error @enderror">
                            @error('email')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NAMA ORANG TUA / WALI -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="nama_wali">Nama Orang Tua / Wali <span class="required-star">*</span></label>
                                <span class="field-feedback" id="nama_wali_feedback"></span>
                            </div>
                            <input type="text" id="nama_wali" name="nama_wali" required value="{{ old('nama_wali') }}" placeholder="Nama ayah / ibu / wali murid" class="@error('nama_wali') input-has-error @enderror">
                            @error('nama_wali')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NO HP ORANG TUA / WALI -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="no_hp_wali">No. HP / WhatsApp Orang Tua / Wali <span class="required-star">*</span></label>
                                <span class="field-feedback" id="no_hp_wali_feedback"></span>
                            </div>
                            <input type="tel" id="no_hp_wali" name="no_hp_wali" required inputmode="numeric" value="{{ old('no_hp_wali') }}" placeholder="Contoh: 081234567890" class="@error('no_hp_wali') input-has-error @enderror">
                            @error('no_hp_wali')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEKSI 3: ALAMAT & KETERANGAN TAMBAHAN -->
                <div class="form-section-block">
                    <div class="form-section-header">
                        <span class="form-section-badge">03</span>
                        <h3 class="form-section-heading">Alamat Domisili &amp; Catatan</h3>
                    </div>

                    <!-- ALAMAT LENGKAP -->
                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="alamat">Alamat Lengkap Tempat Tinggal <span class="required-star">*</span></label>
                            <span class="field-feedback" id="alamat_feedback"></span>
                        </div>
                        <textarea id="alamat" name="alamat" rows="3" required placeholder="Nama jalan, RT/RW, Dusun/Kelurahan/Desa, Kecamatan, Kota/Kabupaten" class="@error('alamat') input-has-error @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- KETERANGAN TAMBAHAN -->
                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="keterangan_tambahan">Keterangan Tambahan / Minat Bakat (opsional)</label>
                        </div>
                        <textarea id="keterangan_tambahan" name="keterangan_tambahan" rows="2" placeholder="Catatan prestasi siswa, cabang ekstrakurikuler yang diminati, atau kebutuhan pendampingan">{{ old('keterangan_tambahan') }}</textarea>
                    </div>
                </div>

                <div class="form-actions-bar">
                    <div class="form-security-note">
                        <i class="fa-solid fa-shield-halved"></i> Data pendaftaran dienkripsi dan hanya digunakan untuk keperluan resmi SPMB.
                    </div>
                    <div class="form-btn-group">
                        <button type="button" class="btn-form-secondary" id="btnReset">Reset Formulir</button>
                        <button type="submit" class="btn-form-primary" id="btnSubmit">
                            <span id="btnSubmitText">Kirim Pendaftaran</span>
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="content-section alternate-section">
        <div class="contact-callout">
            <div>
                <span class="section-label">BANTUAN &amp; INFORMASI</span>
                <h2>Butuh bantuan seputar SPMB?</h2>
                <p>Silakan hubungi panitia penerimaan siswa baru melalui WhatsApp jika mengalami kendala pendaftaran.</p>
            </div>

            @if(!empty($pengaturan['whatsapp']))
            <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="primary-button">
                <i class="fa-brands fa-whatsapp me-2"></i> Hubungi Panitia
            </a>
            @endif
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('ppdbForm');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnSubmitText = document.getElementById('btnSubmitText');
    const alertBox = document.getElementById('alertBoxContainer');

    // Input elements
    const namaInput = document.getElementById('nama_lengkap');
    const namaFeedback = document.getElementById('nama_lengkap_feedback');
    const nikInput = document.getElementById('nik');
    const nikFeedback = document.getElementById('nik_feedback');
    const tempatLahirInput = document.getElementById('tempat_lahir');
    const tempatLahirFeedback = document.getElementById('tempat_lahir_feedback');
    const tglLahirInput = document.getElementById('tanggal_lahir');
    const tglLahirFeedback = document.getElementById('tanggal_lahir_feedback');
    const jkInput = document.getElementById('jenis_kelamin');
    const jkFeedback = document.getElementById('jenis_kelamin_feedback');
    const noHpInput = document.getElementById('no_hp');
    const noHpFeedback = document.getElementById('no_hp_feedback');
    const emailInput = document.getElementById('email');
    const emailFeedback = document.getElementById('email_feedback');
    const asalSekolahInput = document.getElementById('asal_sekolah');
    const asalSekolahFeedback = document.getElementById('asal_sekolah_feedback');
    const namaWaliInput = document.getElementById('nama_wali');
    const namaWaliFeedback = document.getElementById('nama_wali_feedback');
    const noHpWaliInput = document.getElementById('no_hp_wali');
    const noHpWaliFeedback = document.getElementById('no_hp_wali_feedback');
    const alamatInput = document.getElementById('alamat');
    const alamatFeedback = document.getElementById('alamat_feedback');

    // AUTO-SCROLL KE FORM / ALERT JIKA ADA FEEDBACK DARI SERVER
    const hasFeedback = alertBox && alertBox.querySelector('.alert-box');
    if (hasFeedback) {
        setTimeout(function() {
            const formSection = document.getElementById('formulirSpmb');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 150);
    }

    // 1. VALIDASI NIK (16 DIGIT)
    function validateNik() {
        if (!nikInput || !nikFeedback) return true;
        let rawVal = nikInput.value;
        let cleanVal = rawVal.replace(/\D/g, '');
        if (rawVal !== cleanVal) nikInput.value = cleanVal;

        const len = cleanVal.length;
        if (len === 0) {
            nikFeedback.className = 'field-feedback error';
            nikFeedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> NIK wajib 16 digit angka`;
            nikInput.classList.add('input-has-error');
            nikInput.classList.remove('input-has-warning', 'input-has-success');
            return false;
        }

        if (len < 16) {
            const kurang = 16 - len;
            nikFeedback.className = 'field-feedback warning';
            nikFeedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> NIK ${len}/16 digit (kurang ${kurang})`;
            nikInput.classList.add('input-has-warning');
            nikInput.classList.remove('input-has-success', 'input-has-error');
            return false;
        } else if (len === 16) {
            nikFeedback.className = 'field-feedback success';
            nikFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> NIK valid (16 digit)`;
            nikInput.classList.remove('input-has-warning', 'input-has-error');
            nikInput.classList.add('input-has-success');
            return true;
        }
        return false;
    }

    nikInput?.addEventListener('input', validateNik);
    nikInput?.addEventListener('blur', validateNik);

    // 2. VALIDASI NO. HP
    function validatePhone(input, feedback, isRequired = true) {
        if (!input || !feedback) return true;
        let rawVal = input.value;
        let cleanVal = rawVal.replace(/[^\d+]/g, '');
        if (rawVal !== cleanVal) input.value = cleanVal;

        const len = cleanVal.length;
        if (len === 0) {
            if (isRequired) {
                feedback.className = 'field-feedback error';
                feedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Nomor HP wajib diisi`;
                input.classList.add('input-has-error');
                input.classList.remove('input-has-warning', 'input-has-success');
                return false;
            } else {
                feedback.className = 'field-feedback';
                feedback.textContent = '';
                input.classList.remove('input-has-warning', 'input-has-error', 'input-has-success');
                return true;
            }
        }

        if (len < 10) {
            feedback.className = 'field-feedback warning';
            feedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Min. 10 digit (saat ini: ${len})`;
            input.classList.add('input-has-warning');
            input.classList.remove('input-has-success', 'input-has-error');
            return false;
        } else if (len > 16) {
            feedback.className = 'field-feedback warning';
            feedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Maksimal 16 digit`;
            input.classList.add('input-has-warning');
            input.classList.remove('input-has-success', 'input-has-error');
            return false;
        } else {
            feedback.className = 'field-feedback success';
            feedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Nomor valid`;
            input.classList.remove('input-has-warning', 'input-has-error');
            input.classList.add('input-has-success');
            return true;
        }
    }

    noHpInput?.addEventListener('input', () => validatePhone(noHpInput, noHpFeedback, true));
    noHpInput?.addEventListener('blur', () => validatePhone(noHpInput, noHpFeedback, true));
    noHpWaliInput?.addEventListener('input', () => validatePhone(noHpWaliInput, noHpWaliFeedback, true));
    noHpWaliInput?.addEventListener('blur', () => validatePhone(noHpWaliInput, noHpWaliFeedback, true));

    // 3. VALIDASI EMAIL
    function validateEmail() {
        if (!emailInput || !emailFeedback) return true;
        const val = emailInput.value.trim();
        if (val === '') {
            emailFeedback.className = 'field-feedback';
            emailFeedback.textContent = '';
            emailInput.classList.remove('input-has-warning', 'input-has-error', 'input-has-success');
            return true;
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(val)) {
            emailFeedback.className = 'field-feedback warning';
            emailFeedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Format email belum sesuai`;
            emailInput.classList.add('input-has-warning');
            emailInput.classList.remove('input-has-success', 'input-has-error');
            return false;
        } else {
            emailFeedback.className = 'field-feedback success';
            emailFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Format valid`;
            emailInput.classList.remove('input-has-warning', 'input-has-error');
            emailInput.classList.add('input-has-success');
            return true;
        }
    }

    emailInput?.addEventListener('input', validateEmail);
    emailInput?.addEventListener('blur', validateEmail);

    // 4. VALIDASI TANGGAL LAHIR
    function validateTanggalLahir() {
        if (!tglLahirInput || !tglLahirFeedback) return true;
        const val = tglLahirInput.value;
        if (!val) {
            tglLahirFeedback.className = 'field-feedback error';
            tglLahirFeedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Tanggal lahir wajib dipilih`;
            tglLahirInput.classList.add('input-has-error');
            tglLahirInput.classList.remove('input-has-success');
            return false;
        }
        const selectedDate = new Date(val);
        const today = new Date();
        if (selectedDate >= today) {
            tglLahirFeedback.className = 'field-feedback error';
            tglLahirFeedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Harus sebelum hari ini`;
            tglLahirInput.classList.add('input-has-error');
            tglLahirInput.classList.remove('input-has-success');
            return false;
        } else {
            tglLahirFeedback.className = 'field-feedback success';
            tglLahirFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Sesuai`;
            tglLahirInput.classList.remove('input-has-warning', 'input-has-error');
            tglLahirInput.classList.add('input-has-success');
            return true;
        }
    }

    tglLahirInput?.addEventListener('change', validateTanggalLahir);

    // 5. HELPER VALIDASI FIELD TEKS BIASA
    function validateRequired(input, feedback, message) {
        if (!input) return true;
        const val = input.value.trim();
        if (val === '') {
            if (feedback) {
                feedback.className = 'field-feedback error';
                feedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${message}`;
            }
            input.classList.add('input-has-error');
            input.classList.remove('input-has-success');
            return false;
        } else {
            if (feedback) {
                feedback.className = 'field-feedback success';
                feedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Terisi`;
            }
            input.classList.remove('input-has-error');
            input.classList.add('input-has-success');
            return true;
        }
    }

    namaInput?.addEventListener('input', () => { if (namaInput.value.trim().length > 0) validateRequired(namaInput, namaFeedback, 'Nama lengkap wajib diisi'); });
    namaInput?.addEventListener('blur', () => validateRequired(namaInput, namaFeedback, 'Nama lengkap wajib diisi'));

    tempatLahirInput?.addEventListener('input', () => { if (tempatLahirInput.value.trim().length > 0) validateRequired(tempatLahirInput, tempatLahirFeedback, 'Tempat lahir wajib diisi'); });
    tempatLahirInput?.addEventListener('blur', () => validateRequired(tempatLahirInput, tempatLahirFeedback, 'Tempat lahir wajib diisi'));

    jkInput?.addEventListener('change', () => validateRequired(jkInput, jkFeedback, 'Pilih jenis kelamin'));

    asalSekolahInput?.addEventListener('input', () => { if (asalSekolahInput.value.trim().length > 0) validateRequired(asalSekolahInput, asalSekolahFeedback, 'Asal sekolah wajib diisi'); });
    asalSekolahInput?.addEventListener('blur', () => validateRequired(asalSekolahInput, asalSekolahFeedback, 'Asal sekolah wajib diisi'));

    namaWaliInput?.addEventListener('input', () => { if (namaWaliInput.value.trim().length > 0) validateRequired(namaWaliInput, namaWaliFeedback, 'Nama wali wajib diisi'); });
    namaWaliInput?.addEventListener('blur', () => validateRequired(namaWaliInput, namaWaliFeedback, 'Nama wali wajib diisi'));

    alamatInput?.addEventListener('input', () => { if (alamatInput.value.trim().length > 0) validateRequired(alamatInput, alamatFeedback, 'Alamat tempat tinggal wajib diisi'); });
    alamatInput?.addEventListener('blur', () => validateRequired(alamatInput, alamatFeedback, 'Alamat lengkap wajib diisi'));

    // 6. VALIDASI LENGKAP SAAT FORM DISUBMIT
    form?.addEventListener('submit', function (e) {
        let isFormValid = true;
        let firstInvalidElement = null;

        function markInvalid(input, isValid) {
            if (!isValid) {
                isFormValid = false;
                if (!firstInvalidElement) {
                    firstInvalidElement = input;
                }
            }
        }

        markInvalid(namaInput, validateRequired(namaInput, namaFeedback, 'Nama lengkap wajib diisi'));
        markInvalid(nikInput, validateNik());
        markInvalid(tempatLahirInput, validateRequired(tempatLahirInput, tempatLahirFeedback, 'Tempat lahir wajib diisi'));
        markInvalid(tglLahirInput, validateTanggalLahir());
        markInvalid(jkInput, validateRequired(jkInput, jkFeedback, 'Pilih jenis kelamin'));
        markInvalid(noHpInput, validatePhone(noHpInput, noHpFeedback, true));
        markInvalid(emailInput, validateEmail());
        markInvalid(asalSekolahInput, validateRequired(asalSekolahInput, asalSekolahFeedback, 'Asal sekolah wajib diisi'));
        markInvalid(namaWaliInput, validateRequired(namaWaliInput, namaWaliFeedback, 'Nama wali wajib diisi'));
        markInvalid(noHpWaliInput, validatePhone(noHpWaliInput, noHpWaliFeedback, true));
        markInvalid(alamatInput, validateRequired(alamatInput, alamatFeedback, 'Alamat tempat tinggal wajib diisi'));

        if (!isFormValid) {
            e.preventDefault();
            if (firstInvalidElement) {
                firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalidElement.focus();
            }
            return false;
        }

        // Tampilkan loading state pada tombol submit agar tidak terjadi klik ganda
        if (btnSubmit) {
            btnSubmit.style.pointerEvents = 'none';
            btnSubmit.style.opacity = '0.75';
            btnSubmit.style.cursor = 'not-allowed';
            if (btnSubmitText) {
                btnSubmitText.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Mengirim Pendaftaran...';
            }
            setTimeout(function () {
                btnSubmit.disabled = true;
            }, 50);
        }
    });

    // Reset handler dengan konfirmasi agar isian tidak sengaja terhapus
    document.getElementById('btnReset')?.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mengosongkan seluruh isian formulir ini?')) {
            form.reset();
            document.querySelectorAll('.field-feedback').forEach(el => {
                el.className = 'field-feedback';
                el.textContent = '';
            });
            document.querySelectorAll('.input-has-warning, .input-has-error, .input-has-success').forEach(el => {
                el.classList.remove('input-has-warning', 'input-has-error', 'input-has-success');
            });
        }
    });

    // Trigger feedback awal jika ada nilai lama dari server redirect (old input)
    if (nikInput && nikInput.value.length > 0) validateNik();
    if (noHpInput && noHpInput.value.length > 0) validatePhone(noHpInput, noHpFeedback, true);
    if (noHpWaliInput && noHpWaliInput.value.length > 0) validatePhone(noHpWaliInput, noHpWaliFeedback, true);
});
</script>
@endpush
