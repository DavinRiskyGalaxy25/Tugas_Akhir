<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Support\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSliderController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        $sliders = HeroSlider::orderBy('urutan')->orderByDesc('id')->paginate(10);

        return view('admin.slider.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.slider.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'tombol_teks' => ['nullable', 'string', 'max:100'],
            'tombol_url' => ['nullable', 'string', 'max:255'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'status_aktif' => ['nullable'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->storeImage($request->file('gambar'), 'sliders');
        }

        HeroSlider::create($validated);

        return redirect()->route('admin.slider.index')->with('success', 'Gambar background slider berhasil ditambahkan.');
    }

    public function edit(HeroSlider $slider): View
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, HeroSlider $slider): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'tombol_teks' => ['nullable', 'string', 'max:100'],
            'tombol_url' => ['nullable', 'string', 'max:255'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'status_aktif' => ['nullable'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif', true);
        $validated['urutan'] = $validated['urutan'] ?? 0;

        if ($request->hasFile('gambar')) {
            if ($slider->gambar && !str_starts_with($slider->gambar, 'assets/')) {
                $validated['gambar'] = $this->replaceImage($slider->gambar, $request->file('gambar'), 'sliders');
            } else {
                $validated['gambar'] = $this->storeImage($request->file('gambar'), 'sliders');
            }
        }

        $slider->update($validated);

        return redirect()->route('admin.slider.index')->with('success', 'Gambar background slider berhasil diperbarui.');
    }

    public function destroy(HeroSlider $slider): RedirectResponse
    {
        if ($slider->gambar && !str_starts_with($slider->gambar, 'assets/')) {
            $this->deleteImage($slider->gambar);
        }

        $slider->delete();

        return back()->with('success', 'Slider berhasil dihapus.');
    }
}

