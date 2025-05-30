<?php

namespace App\Http\Services;

use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;

class MataKuliahService {

    public function getAllData(){
        $mataKuliah = MataKuliah::all();
        return MataKuliahResource::collection($mataKuliah);
    }

    function setMataKuliahData($request) {
        // dd($request);

        $mataKuliah = MataKuliah::create($request);

        return $mataKuliah;
        
    }
}