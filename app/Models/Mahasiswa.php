<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaFactory> */
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'id_prodi',
        'tanggal_lahir',
        'angkatan',
        'alamat',
        'telepon',
        'user_id',
    ];

    // Relasi ke dosen pembimbing
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
