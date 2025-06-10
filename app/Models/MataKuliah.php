<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    /** @use HasFactory<\Database\Factories\MataKuliahFactory> */
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode',
        'nama',
        'sks',
        'semester',
        'deskripsi',
    ];
    
    // app/Models/MataKuliah.php

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_mata_kuliah')
                    ->withTimestamps();
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'mata_kuliah_id');
    }


}
