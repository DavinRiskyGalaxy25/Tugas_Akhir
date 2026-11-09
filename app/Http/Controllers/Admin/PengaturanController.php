<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengaturanRequest;
use App\Models\PengaturanWebsite;
use App\Support\HandlesImageUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    use HandlesImageUpload;

    public function edit(): View
    {
        $pengaturan = PengaturanWebsite::allSettings();

        return view('admin.pengaturan.edit', compact('pengaturan'));
    }

    public function update(PengaturanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->storeImage($request->file('logo'), 'pengaturan');
        }

        if ($request->hasFile('poster_spmb')) {
            $data['poster_spmb'] = $this->storeImage($request->file('poster_spmb'), 'pengaturan');
        }

        foreach ($data as $key => $value) {
            PengaturanWebsite::set($key, $value);
        }

        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
