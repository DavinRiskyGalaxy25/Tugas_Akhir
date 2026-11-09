<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'nama_prestasi', 'slug', 'nama_siswa', 'tingkat',
        'pencapaian', 'tahun', 'deskripsi', 'foto', 'status',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getJudulAttribute(): string
    {
        return $this->nama_prestasi ?? '';
    }

    public function getNamaPeraihAttribute(): ?string
    {
        return $this->nama_siswa;
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/'.$this->foto);
        }
        return asset('assets/img/no-image.svg');
    }

    public static function generateUniqueSlug(string $nama, ?int $ignoreId = null): string
    {
        $slug = Str::slug($nama);
        $original = $slug;
        $i = 1;
        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original.'-'.$i++;
        }

        return $slug;
    }
}
