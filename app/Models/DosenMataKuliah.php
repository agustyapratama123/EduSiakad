<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenMataKuliah extends Model
{
    protected $table = 'dosen_mata_kuliah';

    protected $fillable = [
        'dosen_id',
        'mata_kuliah_id',
        'kelas',
        'tahun_ajaran',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}
