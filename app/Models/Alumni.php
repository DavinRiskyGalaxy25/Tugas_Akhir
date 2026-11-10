<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nama', 'tahun_lulus', 'pekerjaan_sekarang', 'pesan_kesan', 'rating', 'foto', 'status',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getFotoUrlAttribute(): string
    {
        return $this->foto ? asset('storage/'.$this->foto) : asset('assets/img/no-image.svg');
    }
}
