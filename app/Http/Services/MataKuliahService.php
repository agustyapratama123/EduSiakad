<?php

namespace App\Http\Services;

use App\Exceptions\MataKuliahNotFoundException;
use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;

class MataKuliahService {

    protected $mataKuliah;

    public function __construct(MataKuliah $mataKuliah)
    {
        $this->mataKuliah = $mataKuliah;
    }

    public function getAllData(){
        $mataKuliah = MataKuliah::all();
        return MataKuliahResource::collection($mataKuliah);
    }
    
    public function getOneData($id){

        $mataKuliah = $this->mataKuliah->find($id);
        
        if(!$mataKuliah){
            throw new MataKuliahNotFoundException('mata kuliah not found by id '.$id);
        }

        return new MataKuliahResource($mataKuliah);

    }

    function setMataKuliahData($request) {

        $mataKuliah = MataKuliah::create($request);

        return new MataKuliahResource($mataKuliah);
        
    }
}

