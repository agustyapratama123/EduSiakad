<?php

namespace App\Http\Services;

use App\Exceptions\DosenMataKuliahNotFound;
use App\Http\Resources\DosenMataKuliahResource;
use App\Models\DosenMataKuliah;

class DosenMataKuliahService{

    protected $DosenMataKuliah;

    public function __construct(DosenMataKuliah $DosenMataKuliah)
    {
        $this->DosenMataKuliah = $DosenMataKuliah;
    }

    public function getAllData(){
        $data = DosenMataKuliah::with(['dosen', 'mataKuliah'])->get();

        // dd($data);
        if($data->isEmpty()){
            throw new DosenMataKuliahNotFound('belum ada data.');
        }

        return DosenMataKuliahResource::collection($data);
    }
}