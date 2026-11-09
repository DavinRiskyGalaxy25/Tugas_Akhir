<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\HeroSlider;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $kepalaSekolah = Guru::aktif()->where('jabatan', 'like', '%Kepala Sekolah%')->first();
        $sliders = HeroSlider::aktif()->orderBy('urutan')->get();

        return view('home', compact('kepalaSekolah', 'sliders'));
    }
}
