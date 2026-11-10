<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPpdb extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_ppdb';

    protected $fillable = [
        'nama_lengkap', 'nik', 'nisn', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'alamat', 'no_hp', 'asal_sekolah', 'nama_wali',
        'no_hp_wali', 'email', 'keterangan_tambahan', 'status',
        'kartu_keluarga', 'akta_kelahiran', 'ijazah_skl', 'pas_foto',
    ];

    protected function casts(): array
    {
        return ['tanggal_lahir' => 'date'];
    }
}
