<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';

    protected $fillable = [
        'nama', 'icon', 'foto', 'deskripsi', 'pembina',
        'jadwal', 'lokasi', 'status_aktif', 'urutan',
    ];

    protected function casts(): array
    {
        return ['status_aktif' => 'boolean'];
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function getFotoUrlAttribute(): ?string
    {
        if ($this->foto && Storage::disk('public')->exists($this->foto)) {
            return asset('storage/'.$this->foto);
        }
        return null;
    }
}
