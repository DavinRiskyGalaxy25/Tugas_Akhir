<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function index(): View
    {
        $alumni = Alumni::published()->latest()->paginate(9);

        return view('alumni.index', compact('alumni'));
    }

    public function create(): View
    {
        return view('alumni.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'tahun_lulus' => ['nullable', 'string', 'max:10'],
            'pekerjaan_sekarang' => ['nullable', 'string', 'max:255'],
            'pesan_kesan' => ['required', 'string'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        ];

        $messages = [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'tahun_lulus.max' => 'Tahun kelulusan tidak boleh lebih dari 10 karakter.',
            'pekerjaan_sekarang.max' => 'Kegiatan / pekerjaan saat ini tidak boleh lebih dari 255 karakter.',
            'pesan_kesan.required' => 'Kesan dan pesan wajib diisi.',
            'rating.integer' => 'Penilaian bintang harus berupa angka.',
            'rating.min' => 'Penilaian minimal 1 bintang.',
            'rating.max' => 'Penilaian maksimal 5 bintang.',
        ];

        $validated = $request->validate($rules, $messages);

        $validated['rating'] = $validated['rating'] ?? 5;
        $validated['status'] = 'pending';

        Alumni::create($validated);

        return redirect()->route('alumni.index')->with('success', 'Terima kasih! Pesan dan kesan Anda telah kami terima dan akan tampil setelah diverifikasi & disetujui (ACC) oleh admin sekolah.');
    }
}
