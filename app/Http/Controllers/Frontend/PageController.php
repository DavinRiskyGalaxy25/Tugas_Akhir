<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\StrukturOrganisasi;
use Illuminate\View\View;

/**
 * Renders the mostly-static informational pages, with the sections
 * that the client asked to be manageable (guru, fasilitas, kegiatan,
 * prestasi, ekstrakurikuler, berita, profil, kontak) pulled live from the database.
 */
class PageController extends Controller
{
    public function profil(): View
    {
        $struktur = StrukturOrganisasi::aktif()->orderBy('urutan')->get();

        return view('profil', compact('struktur'));
    }

    public function akademik(): View
    {
        $guru = Guru::aktif()->orderBy('urutan')->orderBy('nama')->get();
        $fasilitas = Fasilitas::orderBy('urutan')->get();

        return view('akademik', compact('guru', 'fasilitas'));
    }

    public function kesiswaan(): View
    {
        $kegiatan = Kegiatan::published()->latest('tanggal')->take(4)->get();
        $prestasi = Prestasi::published()->latest('tahun')->take(6)->get();
        $ekstrakurikuler = Ekstrakurikuler::aktif()->orderBy('urutan')->get();

        return view('kesiswaan', compact('kegiatan', 'prestasi', 'ekstrakurikuler'));
    }

    public function kontak(): View
    {
        return view('kontak');
    }

    public function informasi(): View
    {
        return view('kontak');
    }

    public function guru(): View
    {
        $guru = Guru::aktif()->orderBy('urutan')->orderBy('nama')->get();

        return view('guru', compact('guru'));
    }

    public function fasilitas(): View
    {
        $fasilitas = Fasilitas::orderBy('urutan')->get();

        return view('fasilitas', compact('fasilitas'));
    }

    public function ekstrakurikuler(): View
    {
        $ekstrakurikuler = Ekstrakurikuler::aktif()->orderBy('urutan')->get();

        return view('ekstrakurikuler', compact('ekstrakurikuler'));
    }
}
