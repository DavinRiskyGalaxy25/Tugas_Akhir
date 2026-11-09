<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranPpdb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function create(): View
    {
        return view('ppdb');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Bersihkan NIK dari spasi, strip, atau karakter non-angka
        if ($request->has('nik')) {
            $request->merge([
                'nik' => preg_replace('/\D/', '', (string) $request->nik)
            ]);
        }

        // 2. Bersihkan nomor telepon/WhatsApp (hanya angka dan simbol + di awal)
        if ($request->has('no_hp')) {
            $request->merge([
                'no_hp' => preg_replace('/[^\d+]/', '', (string) $request->no_hp)
            ]);
        }
        if ($request->has('no_hp_wali')) {
            $request->merge([
                'no_hp_wali' => preg_replace('/[^\d+]/', '', (string) $request->no_hp_wali)
            ]);
        }

        // 3. Cek apakah NIK ini sudah pernah didaftarkan sebelumnya
        if ($request->filled('nik')) {
            $cleanNik = $request->nik;
            $existing = PendaftaranPpdb::where('nik', $cleanNik)->first();
            if ($existing) {
                return back()
                    ->withInput()
                    ->with('error', 'Calon peserta didik dengan NIK ' . $cleanNik . ' atas nama "' . $existing->nama_lengkap . '" sudah pernah didaftarkan sebelumnya (Status: ' . ucfirst($existing->status) . '). Jika ada kekeliruan data atau ingin melakukan revisi, silakan hubungi pihak panitia sekolah.');
            }
        }

        $rules = [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16'],
            'nisn' => ['nullable', 'string', 'max:20'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'min:10', 'max:20'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'nama_wali' => ['required', 'string', 'max:255'],
            'no_hp_wali' => ['required', 'string', 'min:10', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'keterangan_tambahan' => ['nullable', 'string'],
        ];

        $messages = [
            'nama_lengkap.required' => 'Nama lengkap calon peserta didik wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'nik.required' => 'NIK (Nomor Induk Kependudukan) wajib diisi.',
            'nik.digits' => 'NIK harus berisi tepat 16 digit angka sesuai KK/KTP.',
            'nisn.max' => 'NISN tidak boleh lebih dari 20 digit.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required' => 'Silakan pilih jenis kelamin.',
            'jenis_kelamin.in' => 'Pilihan jenis kelamin tidak valid.',
            'alamat.required' => 'Alamat lengkap tempat tinggal wajib diisi.',
            'no_hp.required' => 'Nomor HP / WhatsApp calon peserta didik wajib diisi.',
            'no_hp.min' => 'Nomor HP / WhatsApp minimal 10 digit angka.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter.',
            'asal_sekolah.required' => 'Asal sekolah (SD/MI) wajib diisi.',
            'asal_sekolah.max' => 'Asal sekolah tidak boleh lebih dari 255 karakter.',
            'nama_wali.required' => 'Nama orang tua / wali wajib diisi.',
            'nama_wali.max' => 'Nama orang tua / wali tidak boleh lebih dari 255 karakter.',
            'no_hp_wali.required' => 'Nomor HP orang tua / wali wajib diisi.',
            'no_hp_wali.min' => 'Nomor HP orang tua / wali minimal 10 digit angka.',
            'no_hp_wali.max' => 'Nomor HP orang tua / wali tidak boleh lebih dari 20 karakter.',
            'email.email' => 'Format alamat email tidak valid (contoh: siswa@email.com).',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        ];

        $validated = $request->validate($rules, $messages);

        PendaftaranPpdb::create($validated);

        return back()->with('success', 'Alhamdulillah! Pendaftaran SPMB calon peserta didik atas nama ' . $validated['nama_lengkap'] . ' berhasil dikirim. Panitia sekolah akan segera meninjau dan memverifikasi berkas pendaftaran Anda.');
    }
}
