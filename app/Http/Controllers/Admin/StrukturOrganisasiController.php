<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use App\Support\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StrukturOrganisasiController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        $struktur = StrukturOrganisasi::orderBy('urutan')->orderBy('id')->paginate(15);

        return view('admin.struktur.index', compact('struktur'));
    }

    public function create(): View
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:50'],
            'keterangan' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'status_aktif' => ['nullable'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['kategori'] = $validated['kategori'] ?? 'pimpinan';

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->storeImage($request->file('foto'), 'struktur');
        }

        StrukturOrganisasi::create($validated);

        return redirect()->route('admin.struktur.index')->with('success', 'Anggota struktur organisasi berhasil ditambahkan.');
    }

    public function edit(StrukturOrganisasi $struktur): View
    {
        return view('admin.struktur.edit', compact('struktur'));
    }

    public function update(Request $request, StrukturOrganisasi $struktur): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:50'],
            'keterangan' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'status_aktif' => ['nullable'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['kategori'] = $validated['kategori'] ?? 'pimpinan';

        if ($request->hasFile('foto')) {
            if ($struktur->foto && !str_starts_with($struktur->foto, 'assets/')) {
                $validated['foto'] = $this->replaceImage($struktur->foto, $request->file('foto'), 'struktur');
            } else {
                $validated['foto'] = $this->storeImage($request->file('foto'), 'struktur');
            }
        }

        $struktur->update($validated);

        return redirect()->route('admin.struktur.index')->with('success', 'Anggota struktur organisasi berhasil diperbarui.');
    }

    public function destroy(StrukturOrganisasi $struktur): RedirectResponse
    {
        if ($struktur->foto && !str_starts_with($struktur->foto, 'assets/')) {
            $this->deleteImage($struktur->foto);
        }

        $struktur->delete();

        return back()->with('success', 'Anggota struktur organisasi berhasil dihapus.');
    }
}

