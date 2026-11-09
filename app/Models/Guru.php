<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'nama', 'nip_nik', 'jabatan', 'mata_pelajaran',
        'foto', 'deskripsi', 'urutan', 'status_aktif',
    ];

    protected function casts(): array
    {
        return ['status_aktif' => 'boolean'];
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function getFotoUrlAttribute(): string
    {
        if (empty($this->foto)) {
            return asset('assets/img/avatar-placeholder.svg');
        }

        if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
            return $this->foto;
        }

        if (str_starts_with($this->foto, 'assets/')) {
            return (file_exists(public_path($this->foto)) && filesize(public_path($this->foto)) > 0)
                ? asset($this->foto)
                : asset('assets/img/avatar-placeholder.svg');
        }

        if (Storage::disk('public')->exists($this->foto)) {
            return asset('storage/'.$this->foto);
        }

        return asset('assets/img/avatar-placeholder.svg');
    }
}
