<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AlumniController as AdminAlumniController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EkstrakurikulerController as AdminEkstrakurikulerController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\HeroSliderController as AdminHeroSliderController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProfilSekolahController as AdminProfilSekolahController;
use App\Http\Controllers\Admin\StrukturOrganisasiController as AdminStrukturOrganisasiController;
use App\Http\Controllers\Frontend\AlumniController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\KegiatanController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PpdbController;
use App\Http\Controllers\Frontend\PrestasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend (public) routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/akademik', [PageController::class, 'akademik'])->name('akademik');
Route::get('/kesiswaan', [PageController::class, 'kesiswaan'])->name('kesiswaan');
Route::get('/informasi', [PageController::class, 'kontak'])->name('informasi');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/guru', [PageController::class, 'guru'])->name('guru');
Route::get('/fasilitas', [PageController::class, 'fasilitas'])->name('fasilitas');
Route::get('/ekstrakurikuler', [PageController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{slug}', [PrestasiController::class, 'show'])->name('prestasi.show');

Route::get('/ppdb', [PpdbController::class, 'create'])->name('ppdb.create');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/spmb', [PpdbController::class, 'create'])->name('spmb');
Route::post('/spmb', [PpdbController::class, 'store'])->name('spmb.store');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/kirim', [AlumniController::class, 'create'])->name('alumni.create');
Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');

Route::redirect('/login', '/admin/login')->name('login');

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only admin auth routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');
    });

    // Everything below requires an authenticated admin user
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // CMS Profil Sekolah (Visi Misi, Sejarah, Tentang Sekolah, Identitas, Sambutan Kepala Sekolah)
        Route::get('/profil-sekolah', [AdminProfilSekolahController::class, 'edit'])->name('profil-sekolah.edit');
        Route::put('/profil-sekolah', [AdminProfilSekolahController::class, 'update'])->name('profil-sekolah.update');

        // CMS Slider / Banner Hero Home (Background slider)
        Route::resource('slider', AdminHeroSliderController::class)->except('show')->parameters(['slider' => 'slider']);

        // CMS Struktur Organisasi
        Route::resource('struktur', AdminStrukturOrganisasiController::class)->except('show')->parameters(['struktur' => 'struktur']);

        Route::resource('guru', AdminGuruController::class)->except('show');
        Route::resource('berita', AdminBeritaController::class)->except('show')->parameters(['berita' => 'berita']);
        Route::resource('kegiatan', AdminKegiatanController::class)->except('show')->parameters(['kegiatan' => 'kegiatan']);
        Route::resource('prestasi', AdminPrestasiController::class)->except('show')->parameters(['prestasi' => 'prestasi']);
        Route::resource('ekstrakurikuler', AdminEkstrakurikulerController::class)->except('show')->parameters(['ekstrakurikuler' => 'ekstrakurikuler']);
        Route::resource('fasilitas', AdminFasilitasController::class)->except('show')->parameters(['fasilitas' => 'fasilitas']);

        Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
        Route::get('/ppdb/export', [AdminPpdbController::class, 'export'])->name('ppdb.export');
        Route::get('/ppdb/{ppdb}', [AdminPpdbController::class, 'show'])->name('ppdb.show');
        Route::put('/ppdb/{ppdb}/status', [AdminPpdbController::class, 'updateStatus'])->name('ppdb.status');
        Route::delete('/ppdb/{ppdb}', [AdminPpdbController::class, 'destroy'])->name('ppdb.destroy');

        Route::get('/alumni', [AdminAlumniController::class, 'index'])->name('alumni.index');
        Route::put('/alumni/{alumni}/approve', [AdminAlumniController::class, 'approve'])->name('alumni.approve');
        Route::put('/alumni/{alumni}/reject', [AdminAlumniController::class, 'reject'])->name('alumni.reject');
        Route::delete('/alumni/{alumni}', [AdminAlumniController::class, 'destroy'])->name('alumni.destroy');

        Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
        Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

        Route::middleware('superadmin')->prefix('pengaturan/admin')->name('pengaturan.admin.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{admin}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{admin}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{admin}', [AdminUserController::class, 'destroy'])->name('destroy');
        });
    });
});
