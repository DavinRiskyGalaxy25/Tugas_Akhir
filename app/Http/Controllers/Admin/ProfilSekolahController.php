<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanWebsite;
use App\Support\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilSekolahController extends Controller
{
    use HandlesImageUpload;

    public function edit(): View
    {
        $pengaturan = PengaturanWebsite::allSettings();

        return view('admin.profil_sekolah.edit', compact('pengaturan'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // Tentang Sekolah
            'tentang_sekolah' => ['nullable', 'string'],
            'tentang_sekolah_ringkas' => ['nullable', 'string', 'max:500'],
            'tentang_sekolah_gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            // Sejarah
            'sejarah' => ['nullable', 'string'],
            'sejarah_tahun_pendirian' => ['nullable', 'string', 'max:100'],
            'sejarah_izin_operasional' => ['nullable', 'string', 'max:100'],

            // Visi & Misi
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],

            // Identitas Sekolah
            'identitas_npsn' => ['nullable', 'string', 'max:30'],
            'identitas_status' => ['nullable', 'string', 'max:50'],
            'identitas_bentuk' => ['nullable', 'string', 'max:100'],
            'identitas_akreditasi' => ['nullable', 'string', 'max:20'],
            'identitas_kurikulum' => ['nullable', 'string', 'max:100'],
            'identitas_naungan' => ['nullable', 'string', 'max:255'],

            // Sambutan Kepala Sekolah
            'sambutan_nama_kepala' => ['nullable', 'string', 'max:255'],
            'sambutan_jabatan_kepala' => ['nullable', 'string', 'max:255'],
            'sambutan_quote' => ['nullable', 'string'],
            'sambutan_kepala_sekolah' => ['nullable', 'string'],
            'sambutan_foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            // Bagan Struktur Organisasi
            'bagan_struktur_organisasi' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        // Upload Gambar Tentang Sekolah
        if ($request->hasFile('tentang_sekolah_gambar')) {
            $oldImg = PengaturanWebsite::get('tentang_sekolah_gambar');
            if ($oldImg && !str_starts_with($oldImg, 'assets/')) {
                $validated['tentang_sekolah_gambar'] = $this->replaceImage($oldImg, $request->file('tentang_sekolah_gambar'), 'profil');
            } else {
                $validated['tentang_sekolah_gambar'] = $this->storeImage($request->file('tentang_sekolah_gambar'), 'profil');
            }
        }

        // Upload Foto Kepala Sekolah
        if ($request->hasFile('sambutan_foto')) {
            $oldFoto = PengaturanWebsite::get('sambutan_foto');
            if ($oldFoto && !str_starts_with($oldFoto, 'assets/')) {
                $validated['sambutan_foto'] = $this->replaceImage($oldFoto, $request->file('sambutan_foto'), 'profil');
            } else {
                $validated['sambutan_foto'] = $this->storeImage($request->file('sambutan_foto'), 'profil');
            }
        }

        // Upload Bagan Struktur Organisasi
        if ($request->hasFile('bagan_struktur_organisasi')) {
            $oldBagan = PengaturanWebsite::get('bagan_struktur_organisasi');
            if ($oldBagan && !str_starts_with($oldBagan, 'assets/')) {
                $validated['bagan_struktur_organisasi'] = $this->replaceImage($oldBagan, $request->file('bagan_struktur_organisasi'), 'profil');
            } else {
                $validated['bagan_struktur_organisasi'] = $this->storeImage($request->file('bagan_struktur_organisasi'), 'profil');
            }
        }

        foreach ($validated as $key => $value) {
            PengaturanWebsite::set($key, $value ?? '');
        }

        return back()->with('success', 'Data profil sekolah berhasil diperbarui.');
    }
}

