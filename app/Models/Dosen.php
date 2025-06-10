<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    /** @use HasFactory<\Database\Factories\DosenFactory> */
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nama',
        'nidn',
        'email',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

// app/Models/Dosen.php

    public function mataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'dosen_mata_kuliah')
                    ->withTimestamps();
    }

     public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'dosen_id');
    }

}
