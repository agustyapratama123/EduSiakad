<?php

namespace App\Http\Services;

use App\Exceptions\DosenMataKuliahNotFound;
use App\Http\Resources\DosenMataKuliahResource;
use App\Models\DosenMataKuliah;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class DosenMataKuliahService{

    protected $DosenMataKuliah;

    public function __construct(DosenMataKuliah $DosenMataKuliah)
    {
        $this->DosenMataKuliah = $DosenMataKuliah;
    }

    public function getAllData(){
        $data = DosenMataKuliah::with(['dosen', 'mataKuliah'])->get();

        if($data->isEmpty()){
            throw new DosenMataKuliahNotFound('belum ada data.');
        }

        
        return DosenMataKuliahResource::collection($data);
    }

    public function setDosenMataKuliahData($request){

        $exists = DosenMataKuliah::where('dosen_id', $request['dosen_id'])
            ->where('mata_kuliah_id', $request['mata_kuliah_id'])
            ->exists(); // ✅ lebih cepat dari ->first()

        if ($exists) {
            throw new \Exception('Dosen sudah mengampu mata kuliah ini.');
        }

        try {
            DB::beginTransaction();

            $result = DosenMataKuliah::create($request);

            DB::commit();
            return new DosenMataKuliahResource($result);
        } catch (\Exception $e) {
            DB::rollBack();
            // Hindari throw response langsung dalam Exception
            throw new \Exception('Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}