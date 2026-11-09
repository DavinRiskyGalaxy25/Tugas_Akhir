<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;

    protected $table = 'hero_sliders';

    protected $fillable = [
        'judul',
        'subjudul',
        'gambar',
        'tombol_teks',
        'tombol_url',
        'urutan',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'status_aktif' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function getGambarUrlAttribute(): string
    {
        if (empty($this->gambar)) {
            return asset('assets/img/sekolah.jpg');
        }

        if (str_starts_with($this->gambar, 'http://') || str_starts_with($this->gambar, 'https://')) {
            return $this->gambar;
        }

        if (str_starts_with($this->gambar, 'assets/')) {
            return asset($this->gambar);
        }

        return asset('storage/' . $this->gambar);
    }
}

