<?php

namespace App\Http\Services;

use App\Exceptions\MataKuliahNotFoundException;
use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    function updateData(string $id, Request $request) {

        $data = $request->only(['kode', 'nama', 'sks', 'semester', 'deskripsi']);

        $data['updated_at'] = now();

        // Gunakan transaction untuk menjaga konsistensi data
        return DB::transaction(function () use ($id, $data) {

            $affected = MataKuliah::where('id', $id)->update($data);

            if ($affected === 0) {
                throw new MataKuliahNotFoundException("Mata kuliah dengan ID {$id} tidak ditemukan atau tidak berubah.");
            }

            $mataKuliahUpdated = MataKuliah::findOrFail($id);

            return new MataKuliahResource($mataKuliahUpdated);
        });
    }
}

