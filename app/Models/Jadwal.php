<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{

    use SoftDeletes;
    protected $table = 'jadwal';

    protected $fillable = [
        'id',
        'mata_kuliah_id',
        'dosen_id',
        'ruang',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'semester',
        'tahun_ajaran'
    ];

    /**
     * Get the mata kuliah that owns the jadwal.
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    /**
     * Get the dosen that owns the jadwal.
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
