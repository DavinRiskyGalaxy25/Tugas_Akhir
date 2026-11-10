@extends('layouts.app')

@section('title', 'Pendaftaran SPMB - ' . ($pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian'))

@section('content')
<main class="page-content">
    <section class="page-hero">
        <div class="page-hero-content">
            <h2>SPMB {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad Krian' }}</h2>
            <p style="color: rgba(255,255,255,0.85); font-size: 0.95rem; margin-top: 6px;">Penerimaan Peserta Didik Baru Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>
    </section>

    <!-- INFORMASI / ALUR PENDAFTARAN -->
    <section class="ppdb-poster-section">
        <div class="ppdb-poster-container">
            @if(!empty($pengaturan['poster_spmb']))
                <div class="ppdb-poster-image-wrap text-center">
                    <img src="{{ asset('storage/' . $pengaturan['poster_spmb']) }}" alt="Poster SPMB {{ $pengaturan['nama_sekolah'] ?? 'SMP Al Ahmad' }}" class="ppdb-poster-img">
                </div>
            @else
                <!-- ALUR 3 LANGKAH PENDAFTARAN RESMI BORDERLESS -->
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
                                <h3>Pengisian &amp; Unggah Berkas</h3>
                                <p>Isi formulir biodata lengkap, cantumkan NIK &amp; NISN valid, serta lampirkan berkas dokumen asli (KK, Akta, Ijazah/SKL, &amp; Foto).</p>
                            </div>
                        </div>
                        <div class="spmb-step-item">
                            <div class="spmb-step-num">02</div>
                            <div class="spmb-step-info">
                                <h3>Verifikasi Panitia</h3>
                                <p>Panitia SPMB memeriksa kelengkapan dan keabsahan berkas, lalu menghubungi Anda via WhatsApp untuk jadwal pemetaan/wawancara.</p>
                            </div>
                        </div>
                        <div class="spmb-step-item">
                            <div class="spmb-step-num">03</div>
                            <div class="spmb-step-info">
                                <h3>Daftar Ulang Resmi</h3>
                                <p>Konfirmasi administrasi dan penyerahan berkas fisik di sekretariat sekolah untuk penerbitan Nomor Induk Siswa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- FORMULIR PENDAFTARAN SECTION -->
    <section class="content-section" id="formulirSpmb">
        <div class="form-card ppdb-modern-card">
            <div class="form-card-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                    <span class="form-eyebrow"><i class="fa-solid fa-file-signature me-1"></i> FORMULIR PENDAFTARAN RESMI</span>
                    <span class="ppdb-verified-badge"><i class="fa-solid fa-shield-halved me-1"></i> Sistem Terverifikasi Anti-Bot</span>
                </div>
                <h2 class="form-title">Pendaftaran SPMB Online</h2>
                <p class="form-desc">Mohon isi data calon peserta didik dengan teliti dan benar sesuai dokumen kependudukan resmi. Dokumen berkas wajib dilampirkan dalam format PDF atau Gambar (maks. 2MB).</p>
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
                            <strong>Mohon periksa kembali isian formulir Anda ({{ $errors->count() }} kesalahan ditemukan):</strong>
                            <ul style="margin:8px 0 0; padding-left:18px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('ppdb.store') }}" id="ppdbForm" enctype="multipart/form-data" novalidate>
                @csrf

                <!-- HONEYPOT TRAP (Tersembunyi untuk menangkap bot otomatis) -->
                <div style="position: absolute; left: -9999px; opacity: 0; pointer-events: none; height: 0; overflow: hidden;" aria-hidden="true">
                    <label for="bot_trap">Do not fill this</label>
                    <input type="text" id="bot_trap" name="bot_trap" tabindex="-1" autocomplete="off" value="">
                    <label for="website_hp">Do not fill this either</label>
                    <input type="text" id="website_hp" name="website_hp" tabindex="-1" autocomplete="off" value="">
                </div>

                <!-- SEKSI 1: DATA IDENTITAS CALON SISWA -->
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
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap siswa sesuai Kartu Keluarga (KK)" class="@error('nama_lengkap') input-has-error @enderror">
                            @error('nama_lengkap')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIK (16 DIGIT) -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="nik">NIK Siswa (16 Digit) <span class="required-star">*</span></label>
                                <span class="field-feedback" id="nik_feedback"></span>
                            </div>
                            <input type="text" id="nik" name="nik" required maxlength="16" inputmode="numeric" value="{{ old('nik') }}" placeholder="16 digit angka sesuai Kartu Keluarga" class="@error('nik') input-has-error @enderror">
                            @error('nik')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NISN (10 DIGIT KETAT) -->
                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label for="nisn">NISN Siswa (10 Digit) <span class="required-star">*</span></label>
                                <span class="field-feedback" id="nisn_feedback"></span>
                            </div>
                            <input type="text" id="nisn" name="nisn" required maxlength="10" inputmode="numeric" value="{{ old('nisn') }}" placeholder="10 digit Nomor Induk Siswa Nasional" class="@error('nisn') input-has-error @enderror">
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
                                <label for="no_hp">No. WhatsApp Siswa <span class="required-star">*</span></label>
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
                                <label for="email">Alamat Email (opsional)</label>
                                <span class="field-feedback" id="email_feedback"></span>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="siswa@gmail.com" class="@error('email') input-has-error @enderror">
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
                                <label for="no_hp_wali">No. WhatsApp Orang Tua / Wali <span class="required-star">*</span></label>
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
                        <textarea id="alamat" name="alamat" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW, Dusun/Desa/Kelurahan, Kecamatan, Kabupaten/Kota" class="@error('alamat') input-has-error @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- KETERANGAN TAMBAHAN -->
                    <div class="form-group">
                        <div class="form-label-wrap">
                            <label for="keterangan_tambahan">Keterangan Tambahan / Minat &amp; Bakat (opsional)</label>
                        </div>
                        <textarea id="keterangan_tambahan" name="keterangan_tambahan" rows="2" placeholder="Prestasi yang pernah diraih, ekstrakurikuler yang diminati, atau kebutuhan khusus">{{ old('keterangan_tambahan') }}</textarea>
                    </div>
                </div>

                <!-- SEKSI 4: BERKAS DOKUMEN PERSYARATAN (WAJIB DOKUMEN) -->
                <div class="form-section-block">
                    <div class="form-section-header">
                        <span class="form-section-badge">04</span>
                        <div>
                            <h3 class="form-section-heading">Unggah Berkas Dokumen Persyaratan <span class="required-star">*</span></h3>
                            <p class="form-section-subtext">Semua dokumen di bawah ini wajib diunggah dalam format PDF, JPG, JPEG, atau PNG (Maksimal 2 MB per berkas).</p>
                        </div>
                    </div>

                    <div class="docs-upload-grid">
                        <!-- 1. KARTU KELUARGA (KK) -->
                        <div class="doc-upload-card @error('kartu_keluarga') card-has-error @enderror" id="dropzone_kk">
                            <div class="doc-upload-header">
                                <div class="doc-icon"><i class="fa-solid fa-file-invoice"></i></div>
                                <div class="doc-info">
                                    <h4 class="doc-title">Kartu Keluarga (KK) <span class="required-star">*</span></h4>
                                    <span class="doc-hint">Scan / Foto jelas KK asli</span>
                                </div>
                            </div>
                            <div class="doc-file-box">
                                <label for="kartu_keluarga" class="doc-pick-btn">
                                    <i class="fa-solid fa-cloud-arrow-up me-1"></i> Pilih Berkas
                                </label>
                                <span class="doc-file-status" id="status_kk">Belum ada file dipilih</span>
                                <input type="file" id="kartu_keluarga" name="kartu_keluarga" required accept=".pdf,.jpg,.jpeg,.png" class="doc-hidden-input">
                            </div>
                            <div class="doc-format-badge">Format: PDF, JPG, PNG &bull; Maks 2MB</div>
                            @error('kartu_keluarga')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 2. AKTA KELAHIRAN -->
                        <div class="doc-upload-card @error('akta_kelahiran') card-has-error @enderror" id="dropzone_akta">
                            <div class="doc-upload-header">
                                <div class="doc-icon"><i class="fa-solid fa-certificate"></i></div>
                                <div class="doc-info">
                                    <h4 class="doc-title">Akta Kelahiran <span class="required-star">*</span></h4>
                                    <span class="doc-hint">Scan / Foto Akta Kelahiran</span>
                                </div>
                            </div>
                            <div class="doc-file-box">
                                <label for="akta_kelahiran" class="doc-pick-btn">
                                    <i class="fa-solid fa-cloud-arrow-up me-1"></i> Pilih Berkas
                                </label>
                                <span class="doc-file-status" id="status_akta">Belum ada file dipilih</span>
                                <input type="file" id="akta_kelahiran" name="akta_kelahiran" required accept=".pdf,.jpg,.jpeg,.png" class="doc-hidden-input">
                            </div>
                            <div class="doc-format-badge">Format: PDF, JPG, PNG &bull; Maks 2MB</div>
                            @error('akta_kelahiran')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 3. IJAZAH / SKL -->
                        <div class="doc-upload-card @error('ijazah_skl') card-has-error @enderror" id="dropzone_ijazah">
                            <div class="doc-upload-header">
                                <div class="doc-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                <div class="doc-info">
                                    <h4 class="doc-title">Ijazah / SKL SD/MI <span class="required-star">*</span></h4>
                                    <span class="doc-hint">Ijazah atau Surat Keterangan Lulus</span>
                                </div>
                            </div>
                            <div class="doc-file-box">
                                <label for="ijazah_skl" class="doc-pick-btn">
                                    <i class="fa-solid fa-cloud-arrow-up me-1"></i> Pilih Berkas
                                </label>
                                <span class="doc-file-status" id="status_ijazah">Belum ada file dipilih</span>
                                <input type="file" id="ijazah_skl" name="ijazah_skl" required accept=".pdf,.jpg,.jpeg,.png" class="doc-hidden-input">
                            </div>
                            <div class="doc-format-badge">Format: PDF, JPG, PNG &bull; Maks 2MB</div>
                            @error('ijazah_skl')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 4. PAS FOTO SISWA -->
                        <div class="doc-upload-card @error('pas_foto') card-has-error @enderror" id="dropzone_foto">
                            <div class="doc-upload-header">
                                <div class="doc-icon"><i class="fa-solid fa-image-portrait"></i></div>
                                <div class="doc-info">
                                    <h4 class="doc-title">Pas Foto Calon Siswa (3x4) <span class="required-star">*</span></h4>
                                    <span class="doc-hint">Foto rapi berseragam / kemeja</span>
                                </div>
                            </div>
                            <div class="doc-file-box">
                                <label for="pas_foto" class="doc-pick-btn">
                                    <i class="fa-solid fa-cloud-arrow-up me-1"></i> Pilih Foto
                                </label>
                                <span class="doc-file-status" id="status_foto">Belum ada file dipilih</span>
                                <input type="file" id="pas_foto" name="pas_foto" required accept=".jpg,.jpeg,.png" class="doc-hidden-input">
                            </div>
                            <div class="doc-format-badge">Format: JPG, JPEG, PNG &bull; Maks 2MB</div>
                            @error('pas_foto')
                                <div class="field-error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEKSI 5: PROTEKSI KEAMANAN reCAPTCHA -->
                <div class="form-section-block ppdb-recaptcha-section">
                    <div class="recaptcha-box-wrapper">
                        <div class="recaptcha-guidance">
                            <div class="recaptcha-icon"><i class="fa-solid fa-shield-virus"></i></div>
                            <div>
                                <h4 class="recaptcha-title">Verifikasi Keamanan Anti-Bot &amp; Orang Iseng</h4>
                                <p class="recaptcha-desc">Silakan centang kotak reCAPTCHA di bawah ini untuk mengonfirmasi pendaftaran resmi calon peserta didik.</p>
                            </div>
                        </div>

                        <div class="recaptcha-widget-container">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key', env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI')) }}"></div>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS BAR -->
                <div class="form-actions-bar">
                    <div class="form-security-note">
                        <i class="fa-solid fa-circle-check"></i> Seluruh data &amp; dokumen dienkripsi serta diproteksi protokol keamanan resmi SPMB.
                    </div>
                    <div class="form-btn-group">
                        <button type="button" class="btn-form-secondary" id="btnReset">Reset Isian</button>
                        <button type="submit" class="btn-form-primary" id="btnSubmit">
                            <span id="btnSubmitText">Kirim Pendaftaran &amp; Berkas</span>
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- SECTION BANTUAN SPMB -->
    <section class="content-section alternate-section">
        <div class="contact-callout ppdb-contact-callout">
            <div>
                <span class="section-label">BANTUAN &amp; INFORMASI</span>
                <h2>Butuh Bantuan Seputar SPMB?</h2>
                <p>Panitia penerimaan siswa baru siap membantu jika Bapak/Ibu mengalami kendala teknis dalam pengisian data atau unggah dokumen.</p>
            </div>

            @if(!empty($pengaturan['whatsapp']))
            <a href="{{ $pengaturan['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="primary-button ppdb-wa-btn">
                <i class="fa-brands fa-whatsapp me-2"></i> Hubungi Panitia SPMB
            </a>
            @endif
        </div>
    </section>
</main>
@endsection

@push('scripts')
<!-- Google reCAPTCHA v2 Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('ppdbForm');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnSubmitText = document.getElementById('btnSubmitText');
    const alertBox = document.getElementById('alertBoxContainer');

    // Input Identitas
    const namaInput = document.getElementById('nama_lengkap');
    const namaFeedback = document.getElementById('nama_lengkap_feedback');
    const nikInput = document.getElementById('nik');
    const nikFeedback = document.getElementById('nik_feedback');
    const nisnInput = document.getElementById('nisn');
    const nisnFeedback = document.getElementById('nisn_feedback');
    const tempatLahirInput = document.getElementById('tempat_lahir');
    const tempatLahirFeedback = document.getElementById('tempat_lahir_feedback');
    const tglLahirInput = document.getElementById('tanggal_lahir');
    const tglLahirFeedback = document.getElementById('tanggal_lahir_feedback');
    const jkInput = document.getElementById('jenis_kelamin');
    const jkFeedback = document.getElementById('jenis_kelamin_feedback');
    const asalSekolahInput = document.getElementById('asal_sekolah');
    const asalSekolahFeedback = document.getElementById('asal_sekolah_feedback');

    // Input Kontak
    const noHpInput = document.getElementById('no_hp');
    const noHpFeedback = document.getElementById('no_hp_feedback');
    const emailInput = document.getElementById('email');
    const emailFeedback = document.getElementById('email_feedback');
    const namaWaliInput = document.getElementById('nama_wali');
    const namaWaliFeedback = document.getElementById('nama_wali_feedback');
    const noHpWaliInput = document.getElementById('no_hp_wali');
    const noHpWaliFeedback = document.getElementById('no_hp_wali_feedback');
    const alamatInput = document.getElementById('alamat');
    const alamatFeedback = document.getElementById('alamat_feedback');

    // Input File Dokumen
    const docInputs = [
        { input: document.getElementById('kartu_keluarga'), status: document.getElementById('status_kk'), card: document.getElementById('dropzone_kk'), name: 'Kartu Keluarga' },
        { input: document.getElementById('akta_kelahiran'), status: document.getElementById('status_akta'), card: document.getElementById('dropzone_akta'), name: 'Akta Kelahiran' },
        { input: document.getElementById('ijazah_skl'), status: document.getElementById('status_ijazah'), card: document.getElementById('dropzone_ijazah'), name: 'Ijazah / SKL' },
        { input: document.getElementById('pas_foto'), status: document.getElementById('status_foto'), card: document.getElementById('dropzone_foto'), name: 'Pas Foto 3x4' }
    ];

    // Interaktivitas File Dokumen
    docInputs.forEach(doc => {
        if (!doc.input) return;
        doc.input.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const sizeMb = (file.size / (1024 * 1024)).toFixed(2);

                if (file.size > 2 * 1024 * 1024) {
                    doc.status.innerHTML = `<span class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Berkas terlalu besar (${sizeMb} MB). Maksimal 2MB</span>`;
                    doc.card?.classList.add('card-has-error');
                    doc.card?.classList.remove('card-has-success');
                    this.value = '';
                } else {
                    doc.status.innerHTML = `<span class="text-success"><i class="fa-solid fa-circle-check"></i> ${file.name} (${sizeMb} MB)</span>`;
                    doc.card?.classList.remove('card-has-error');
                    doc.card?.classList.add('card-has-success');
                }
            } else {
                doc.status.textContent = 'Belum ada file dipilih';
                doc.card?.classList.remove('card-has-success');
            }
        });
    });

    // Auto-scroll ke form jika ada alert feedback
    const hasFeedback = alertBox && alertBox.querySelector('.alert-box');
    if (hasFeedback) {
        setTimeout(function() {
            const formSection = document.getElementById('formulirSpmb');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 150);
    }

    // 1. VALIDASI NIK (Tepat 16 Digit Angka)
    function validateNik() {
        if (!nikInput || !nikFeedback) return true;
        let cleanVal = nikInput.value.replace(/\D/g, '');
        if (nikInput.value !== cleanVal) nikInput.value = cleanVal;

        const len = cleanVal.length;
        if (len === 0) {
            nikFeedback.className = 'field-feedback error';
            nikFeedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> NIK wajib 16 digit`;
            nikInput.classList.add('input-has-error');
            nikInput.classList.remove('input-has-warning', 'input-has-success');
            return false;
        }

        if (len < 16) {
            nikFeedback.className = 'field-feedback warning';
            nikFeedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> NIK ${len}/16 digit`;
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

    // 2. VALIDASI NISN (Tepat 10 Digit Angka)
    function validateNisn() {
        if (!nisnInput || !nisnFeedback) return true;
        let cleanVal = nisnInput.value.replace(/\D/g, '');
        if (nisnInput.value !== cleanVal) nisnInput.value = cleanVal;

        const len = cleanVal.length;
        if (len === 0) {
            nisnFeedback.className = 'field-feedback error';
            nisnFeedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> NISN wajib 10 digit`;
            nisnInput.classList.add('input-has-error');
            nisnInput.classList.remove('input-has-warning', 'input-has-success');
            return false;
        }

        if (len < 10) {
            nisnFeedback.className = 'field-feedback warning';
            nisnFeedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> NISN ${len}/10 digit`;
            nisnInput.classList.add('input-has-warning');
            nisnInput.classList.remove('input-has-success', 'input-has-error');
            return false;
        } else if (len === 10) {
            nisnFeedback.className = 'field-feedback success';
            nisnFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> NISN valid (10 digit)`;
            nisnInput.classList.remove('input-has-warning', 'input-has-error');
            nisnInput.classList.add('input-has-success');
            return true;
        }
        return false;
    }

    nisnInput?.addEventListener('input', validateNisn);
    nisnInput?.addEventListener('blur', validateNisn);

    // 3. VALIDASI NOMOR WHATSAPP (Format 08...)
    function validatePhone(input, feedback) {
        if (!input || !feedback) return true;
        let cleanVal = input.value.replace(/[^\d+]/g, '');
        if (input.value !== cleanVal) input.value = cleanVal;

        // Normalisasi 62 -> 0
        if (cleanVal.startsWith('+62')) cleanVal = '0' + cleanVal.slice(3);
        else if (cleanVal.startsWith('62')) cleanVal = '0' + cleanVal.slice(2);

        const len = cleanVal.length;
        if (len === 0) {
            feedback.className = 'field-feedback error';
            feedback.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Nomor HP wajib diisi`;
            input.classList.add('input-has-error');
            input.classList.remove('input-has-warning', 'input-has-success');
            return false;
        }

        const phoneRegex = /^08[1-9][0-9]{7,11}$/;
        if (!phoneRegex.test(cleanVal)) {
            feedback.className = 'field-feedback warning';
            feedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Contoh: 081234567890`;
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

    noHpInput?.addEventListener('input', () => validatePhone(noHpInput, noHpFeedback));
    noHpInput?.addEventListener('blur', () => validatePhone(noHpInput, noHpFeedback));
    noHpWaliInput?.addEventListener('input', () => validatePhone(noHpWaliInput, noHpWaliFeedback));
    noHpWaliInput?.addEventListener('blur', () => validatePhone(noHpWaliInput, noHpWaliFeedback));

    // 4. VALIDASI EMAIL (Opsional namun harus valid jika diisi)
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
            emailFeedback.innerHTML = `<i class="fa-solid fa-triangle-exclamation"></i> Format email belum benar`;
            emailInput.classList.add('input-has-warning');
            emailInput.classList.remove('input-has-success', 'input-has-error');
            return false;
        } else {
            emailFeedback.className = 'field-feedback success';
            emailFeedback.innerHTML = `<i class="fa-solid fa-circle-check"></i> Email valid`;
            emailInput.classList.remove('input-has-warning', 'input-has-error');
            emailInput.classList.add('input-has-success');
            return true;
        }
    }

    emailInput?.addEventListener('input', validateEmail);
    emailInput?.addEventListener('blur', validateEmail);

    // 5. HELPER VALIDASI FIELD TEKS & SELECT BIASA
    function validateRequired(input, feedback, minLength = 3, message = 'Wajib diisi') {
        if (!input) return true;
        const val = input.value.trim();
        if (val.length < minLength) {
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

    namaInput?.addEventListener('blur', () => validateRequired(namaInput, namaFeedback, 3, 'Nama lengkap wajib diisi'));
    tempatLahirInput?.addEventListener('blur', () => validateRequired(tempatLahirInput, tempatLahirFeedback, 3, 'Tempat lahir wajib diisi'));
    jkInput?.addEventListener('change', () => validateRequired(jkInput, jkFeedback, 1, 'Pilih jenis kelamin'));
    asalSekolahInput?.addEventListener('blur', () => validateRequired(asalSekolahInput, asalSekolahFeedback, 4, 'Asal sekolah wajib diisi'));
    namaWaliInput?.addEventListener('blur', () => validateRequired(namaWaliInput, namaWaliFeedback, 3, 'Nama orang tua/wali wajib diisi'));
    alamatInput?.addEventListener('blur', () => validateRequired(alamatInput, alamatFeedback, 10, 'Alamat minimal 10 karakter'));

    // 6. VALIDASI SUBMIT KESELURUHAN (Termasuk Dokumen & reCAPTCHA)
    form?.addEventListener('submit', function (e) {
        let isFormValid = true;
        let firstInvalidElement = null;

        function markInvalid(element, isValid) {
            if (!isValid) {
                isFormValid = false;
                if (!firstInvalidElement) {
                    firstInvalidElement = element;
                }
            }
        }

        markInvalid(namaInput, validateRequired(namaInput, namaFeedback, 3, 'Nama lengkap wajib diisi'));
        markInvalid(nikInput, validateNik());
        markInvalid(nisnInput, validateNisn());
        markInvalid(tempatLahirInput, validateRequired(tempatLahirInput, tempatLahirFeedback, 3, 'Tempat lahir wajib diisi'));
        markInvalid(tglLahirInput, tglLahirInput && tglLahirInput.value !== '');
        markInvalid(jkInput, validateRequired(jkInput, jkFeedback, 1, 'Pilih jenis kelamin'));
        markInvalid(asalSekolahInput, validateRequired(asalSekolahInput, asalSekolahFeedback, 4, 'Asal sekolah wajib diisi'));
        markInvalid(noHpInput, validatePhone(noHpInput, noHpFeedback));
        markInvalid(emailInput, validateEmail());
        markInvalid(namaWaliInput, validateRequired(namaWaliInput, namaWaliFeedback, 3, 'Nama wali wajib diisi'));
        markInvalid(noHpWaliInput, validatePhone(noHpWaliInput, noHpWaliFeedback));
        markInvalid(alamatInput, validateRequired(alamatInput, alamatFeedback, 10, 'Alamat minimal 10 karakter'));

        // Cek Dokumen Wajib
        docInputs.forEach(doc => {
            if (doc.input && (!doc.input.files || doc.input.files.length === 0)) {
                markInvalid(doc.card, false);
                doc.card?.classList.add('card-has-error');
                doc.status.innerHTML = `<span class="text-danger"><i class="fa-solid fa-circle-exclamation"></i> ${doc.name} wajib diunggah</span>`;
            }
        });

        // Cek reCAPTCHA (jika sudah termuat di browser)
        if (typeof grecaptcha !== 'undefined') {
            const recaptchaVal = grecaptcha.getResponse();
            if (!recaptchaVal) {
                isFormValid = false;
                alert('Silakan centang kotak reCAPTCHA (Saya bukan robot) untuk melanjutkan pendaftaran.');
                const recaptchaBox = document.querySelector('.recaptcha-box-wrapper');
                if (recaptchaBox && !firstInvalidElement) firstInvalidElement = recaptchaBox;
            }
        }

        if (!isFormValid) {
            e.preventDefault();
            if (firstInvalidElement) {
                firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (typeof firstInvalidElement.focus === 'function') firstInvalidElement.focus();
            }
            return false;
        }

        // Tampilkan loading saat proses upload berkas
        if (btnSubmit) {
            btnSubmit.style.pointerEvents = 'none';
            btnSubmit.style.opacity = '0.8';
            if (btnSubmitText) {
                btnSubmitText.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Mengunggah Berkas &amp; Mendaftar...';
            }
        }
    });

    // Reset Form
    document.getElementById('btnReset')?.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mengosongkan seluruh data dan dokumen yang telah diunggah?')) {
            form.reset();
            document.querySelectorAll('.field-feedback').forEach(el => {
                el.className = 'field-feedback';
                el.textContent = '';
            });
            document.querySelectorAll('.input-has-warning, .input-has-error, .input-has-success').forEach(el => {
                el.classList.remove('input-has-warning', 'input-has-error', 'input-has-success');
            });
            docInputs.forEach(doc => {
                doc.status.textContent = 'Belum ada file dipilih';
                doc.card?.classList.remove('card-has-success', 'card-has-error');
            });
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.reset();
            }
        }
    });

    // Initial triggers for old input
    if (nikInput && nikInput.value.length > 0) validateNik();
    if (nisnInput && nisnInput.value.length > 0) validateNisn();
    if (noHpInput && noHpInput.value.length > 0) validatePhone(noHpInput, noHpFeedback);
    if (noHpWaliInput && noHpWaliInput.value.length > 0) validatePhone(noHpWaliInput, noHpWaliFeedback);
});
</script>
@endpush
