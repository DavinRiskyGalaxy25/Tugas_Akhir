<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranPpdb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function create(): View
    {
        return view('ppdb');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. PROTEKSI BOT 1: HONEYPOT TRAP (Orang iseng / Bot otomatis)
        // Kolom tersembunyi bot_trap dan website_hp yang hanya diisi oleh robot/crawler
        if ($request->filled('bot_trap') || $request->filled('website_hp')) {
            Log::warning('PPDB Honeypot bot submission detected from IP: ' . $request->ip());
            // Respon seolah sukses untuk membingungkan bot, tanpa menyimpan data
            return back()->with('success', 'Pendaftaran sedang diproses oleh sistem.');
        }

        // 2. PROTEKSI BOT 2: GOOGLE reCAPTCHA v2
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaSecret = config('services.recaptcha.secret_key', env('RECAPTCHA_SECRET_KEY'));

        if (empty($recaptchaResponse)) {
            return back()
                ->withInput()
                ->with('error', 'Verifikasi keamanan reCAPTCHA wajib dicentang untuk membuktikan Anda bukan bot/program otomatis.');
        }

        try {
            $verifyResponse = Http::asForm()->timeout(6)->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip(),
            ]);

            if (!$verifyResponse->successful() || !$verifyResponse->json('success')) {
                Log::warning('reCAPTCHA failed for IP: ' . $request->ip(), [
                    'errors' => $verifyResponse->json('error-codes', []),
                ]);
                return back()
                    ->withInput()
                    ->with('error', 'Verifikasi keamanan reCAPTCHA tidak lolos. Silakan centang kotak reCAPTCHA kembali.');
            }
        } catch (\Throwable $e) {
            Log::warning('reCAPTCHA network error: ' . $e->getMessage());
            // Pada mode lokal / offline development dengan fallback test keys, lanjutkan jika terjadi timeout
            if (app()->isProduction()) {
                return back()
                    ->withInput()
                    ->with('error', 'Gagal memverifikasi keamanan reCAPTCHA karena gangguan jaringan. Silakan coba beberapa saat lagi.');
            }
        }

        // 3. SANITASI & NORMALISASI NILAI INPUT
        if ($request->has('nik')) {
            $request->merge(['nik' => preg_replace('/\D/', '', (string) $request->nik)]);
        }
        if ($request->has('nisn')) {
            $request->merge(['nisn' => preg_replace('/\D/', '', (string) $request->nisn)]);
        }
        if ($request->has('no_hp')) {
            $cleanNoHp = preg_replace('/[^\d+]/', '', (string) $request->no_hp);
            // Format 628 -> 08 untuk standarisasi
            if (str_starts_with($cleanNoHp, '+62')) {
                $cleanNoHp = '0' . substr($cleanNoHp, 3);
            } elseif (str_starts_with($cleanNoHp, '62')) {
                $cleanNoHp = '0' . substr($cleanNoHp, 2);
            }
            $request->merge(['no_hp' => $cleanNoHp]);
        }
        if ($request->has('no_hp_wali')) {
            $cleanNoHpWali = preg_replace('/[^\d+]/', '', (string) $request->no_hp_wali);
            if (str_starts_with($cleanNoHpWali, '+62')) {
                $cleanNoHpWali = '0' . substr($cleanNoHpWali, 3);
            } elseif (str_starts_with($cleanNoHpWali, '62')) {
                $cleanNoHpWali = '0' . substr($cleanNoHpWali, 2);
            }
            $request->merge(['no_hp_wali' => $cleanNoHpWali]);
        }

        // Sanitasi teks dari tag HTML berbahaya
        if ($request->has('nama_lengkap')) {
            $request->merge(['nama_lengkap' => strip_tags(trim((string) $request->nama_lengkap))]);
        }
        if ($request->has('tempat_lahir')) {
            $request->merge(['tempat_lahir' => strip_tags(trim((string) $request->tempat_lahir))]);
        }
        if ($request->has('asal_sekolah')) {
            $request->merge(['asal_sekolah' => strip_tags(trim((string) $request->asal_sekolah))]);
        }
        if ($request->has('nama_wali')) {
            $request->merge(['nama_wali' => strip_tags(trim((string) $request->nama_wali))]);
        }
        if ($request->has('alamat')) {
            $request->merge(['alamat' => strip_tags(trim((string) $request->alamat))]);
        }
        if ($request->has('keterangan_tambahan')) {
            $request->merge(['keterangan_tambahan' => strip_tags(trim((string) $request->keterangan_tambahan))]);
        }

        // 4. CEK DUPLIKASI DATA (NIK & NISN)
        if ($request->filled('nik')) {
            $cleanNik = $request->nik;
            $existing = PendaftaranPpdb::where('nik', $cleanNik)->first();
            if ($existing) {
                return back()
                    ->withInput()
                    ->with('error', 'Calon peserta didik dengan NIK ' . $cleanNik . ' atas nama "' . $existing->nama_lengkap . '" sudah pernah didaftarkan sebelumnya (Status: ' . ucfirst($existing->status) . '). Jika ada kesalahan berkas, silakan hubungi panitia SPMB sekolah.');
            }
        }

        if ($request->filled('nisn')) {
            $cleanNisn = $request->nisn;
            $existingNisn = PendaftaranPpdb::where('nisn', $cleanNisn)->first();
            if ($existingNisn) {
                return back()
                    ->withInput()
                    ->with('error', 'Calon peserta didik dengan NISN ' . $cleanNisn . ' atas nama "' . $existingNisn->nama_lengkap . '" sudah terdaftar pada sistem SPMB.');
            }
        }

        // 5. VALIDASI KOLOM KETAT & WAJIB DOKUMEN
        $rules = [
            // Validasi Identitas Siswa
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:150', 'regex:/^[\pL\s\.,\'`\-]+$/u'],
            'nik' => ['required', 'digits:16'],
            'nisn' => ['required', 'digits:10'],
            'tempat_lahir' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\.,\'`\-]+$/u'],
            'tanggal_lahir' => ['required', 'date', 'before:today', 'after:2000-01-01'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'asal_sekolah' => ['required', 'string', 'min:4', 'max:150'],

            // Validasi Kontak & Orang Tua / Wali
            'no_hp' => ['required', 'regex:/^08[1-9][0-9]{7,11}$/'],
            'email' => ['nullable', 'email:rfc,filter', 'max:150'],
            'nama_wali' => ['required', 'string', 'min:3', 'max:150', 'regex:/^[\pL\s\.,\'`\-]+$/u'],
            'no_hp_wali' => ['required', 'regex:/^08[1-9][0-9]{7,11}$/'],

            // Validasi Alamat & Catatan
            'alamat' => ['required', 'string', 'min:10', 'max:500'],
            'keterangan_tambahan' => ['nullable', 'string', 'max:1000'],

            // 6. WAJIB DOKUMEN (Kartu Keluarga, Akta Kelahiran, Ijazah/SKL, Pas Foto)
            'kartu_keluarga' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'akta_kelahiran' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'ijazah_skl' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'pas_foto' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];

        $messages = [
            'nama_lengkap.required' => 'Nama lengkap calon peserta didik wajib diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh melebihi 150 karakter.',
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf dan tanda baca nama yang valid.',

            'nik.required' => 'NIK (Nomor Induk Kependudukan) wajib diisi.',
            'nik.digits' => 'NIK harus berisi tepat 16 digit angka sesuai Kartu Keluarga (KK).',

            'nisn.required' => 'NISN (Nomor Induk Siswa Nasional) wajib diisi.',
            'nisn.digits' => 'NISN harus berisi tepat 10 digit angka resmi Kemdikbud.',

            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter.',
            'tempat_lahir.regex' => 'Tempat lahir hanya boleh berisi huruf.',

            'tanggal_lahir.required' => 'Tanggal lahir calon siswa wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'tanggal_lahir.after' => 'Tahun kelahiran calon siswa tidak valid.',

            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin siswa.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',

            'asal_sekolah.required' => 'Asal sekolah (SD/MI) wajib diisi.',
            'asal_sekolah.min' => 'Nama asal sekolah minimal 4 karakter (contoh: SDN Krian 1).',

            'no_hp.required' => 'Nomor HP / WhatsApp calon siswa wajib diisi.',
            'no_hp.regex' => 'Format nomor HP/WhatsApp tidak valid. Wajib format Indonesia (contoh: 081234567890).',

            'email.email' => 'Format alamat email tidak valid (contoh: siswa@gmail.com).',

            'nama_wali.required' => 'Nama orang tua / wali wajib diisi.',
            'nama_wali.min' => 'Nama orang tua / wali minimal 3 karakter.',
            'nama_wali.regex' => 'Nama orang tua / wali hanya boleh berisi huruf dan spasi.',

            'no_hp_wali.required' => 'Nomor WhatsApp orang tua / wali wajib diisi.',
            'no_hp_wali.regex' => 'Format nomor HP orang tua/wali tidak valid (contoh: 081234567890).',

            'alamat.required' => 'Alamat lengkap tempat tinggal wajib diisi.',
            'alamat.min' => 'Alamat minimal 10 karakter (mohon cantumkan nama jalan, RT/RW, atau desa/kelurahan).',

            // Pesan Dokumen
            'kartu_keluarga.required' => 'Dokumen scan/foto Kartu Keluarga (KK) wajib dilampirkan.',
            'kartu_keluarga.file' => 'Berkas Kartu Keluarga tidak valid.',
            'kartu_keluarga.mimes' => 'Format Kartu Keluarga harus PDF, JPG, JPEG, atau PNG.',
            'kartu_keluarga.max' => 'Ukuran berkas Kartu Keluarga maksimal 2 MB.',

            'akta_kelahiran.required' => 'Dokumen scan/foto Akta Kelahiran wajib dilampirkan.',
            'akta_kelahiran.file' => 'Berkas Akta Kelahiran tidak valid.',
            'akta_kelahiran.mimes' => 'Format Akta Kelahiran harus PDF, JPG, JPEG, atau PNG.',
            'akta_kelahiran.max' => 'Ukuran berkas Akta Kelahiran maksimal 2 MB.',

            'ijazah_skl.required' => 'Dokumen Ijazah SD/MI atau Surat Keterangan Lulus (SKL) wajib dilampirkan.',
            'ijazah_skl.file' => 'Berkas Ijazah/SKL tidak valid.',
            'ijazah_skl.mimes' => 'Format Ijazah/SKL harus PDF, JPG, JPEG, atau PNG.',
            'ijazah_skl.max' => 'Ukuran berkas Ijazah/SKL maksimal 2 MB.',

            'pas_foto.required' => 'Pas foto calon siswa (3x4 terbaru) wajib dilampirkan.',
            'pas_foto.image' => 'Berkas pas foto harus berupa gambar.',
            'pas_foto.mimes' => 'Format pas foto harus JPG, JPEG, atau PNG.',
            'pas_foto.max' => 'Ukuran pas foto maksimal 2 MB.',
        ];

        $validated = $request->validate($rules, $messages);

        // 7. SIMPAN DOKUMEN FISIK KE STORAGE
        if ($request->hasFile('kartu_keluarga')) {
            $validated['kartu_keluarga'] = $request->file('kartu_keluarga')->store('ppdb/kk', 'public');
        }
        if ($request->hasFile('akta_kelahiran')) {
            $validated['akta_kelahiran'] = $request->file('akta_kelahiran')->store('ppdb/akta', 'public');
        }
        if ($request->hasFile('ijazah_skl')) {
            $validated['ijazah_skl'] = $request->file('ijazah_skl')->store('ppdb/ijazah', 'public');
        }
        if ($request->hasFile('pas_foto')) {
            $validated['pas_foto'] = $request->file('pas_foto')->store('ppdb/foto', 'public');
        }

        // 8. SIMPAN DATA KE DATABASE
        PendaftaranPpdb::create($validated);

        return back()->with('success', 'Alhamdulillah! Formulir pendaftaran dan berkas dokumen calon siswa atas nama ' . $validated['nama_lengkap'] . ' berhasil dikirim. Panitia SPMB akan memverifikasi berkas dan menghubungi nomor WhatsApp Anda.');
    }
}
