<?php

namespace App\Providers;

use App\Models\PengaturanWebsite;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Make the site-wide settings (name, logo, contact info, social
        // links) available to every view, e.g. the shared header/footer.
        View::composer('*', function ($view) {
            static $pengaturan = null;

            if ($pengaturan === null) {
                try {
                    $pengaturan = Schema::hasTable('pengaturan_website')
                        ? PengaturanWebsite::allSettings()
                        : [];
                } catch (\Throwable $e) {
                    $pengaturan = [];
                }

                $logo = $pengaturan['logo'] ?? null;
                if ($logo && Storage::disk('public')->exists($logo)) {
                    $pengaturan['logo_url'] = asset('storage/' . $logo);
                } elseif ($logo && file_exists(public_path($logo))) {
                    $pengaturan['logo_url'] = asset($logo);
                } else {
                    $pengaturan['logo_url'] = asset('assets/img/logo.png');
                }
            }

            $view->with('pengaturan', $pengaturan);
        });
    }
}
