<?php

namespace App\Http\Services;

use App\Exceptions\DosenMataKuliahNotFound;
use App\Exceptions\DosenPengampuNotFoundException;
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

    public function getOneData($id): DosenMataKuliahResource{

        $data = DosenMataKuliah::with(['dosen', 'mataKuliah'])->find($id);

        if (!$data) {
            throw new DosenPengampuNotFoundException("Data dosen pengampu dengan ID {$id} tidak ditemukan.");
        }

        return new DosenMataKuliahResource($data);
    }

    public function updateDosenMataKuliahData($id, $request)
    {
        // Cek apakah kombinasi dosen dan mata kuliah sudah ada pada record lain
        $exists = DosenMataKuliah::where('dosen_id', $request['dosen_id'])
            ->where('mata_kuliah_id', $request['mata_kuliah_id'])
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            throw new \Exception('Kombinasi dosen dan mata kuliah sudah digunakan.');
        }

        try {
            DB::beginTransaction();

            $record = DosenMataKuliah::find($id);

            if (!$record) {
                throw new \Exception("Data dengan ID $id tidak ditemukan.");
            }

            $record->update($request->only(['dosen_id', 'mata_kuliah_id']));


            DB::commit();

            return new DosenMataKuliahResource($record);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Gagal memperbarui data: ' . $e->getMessage());
        }
    }




    function deleteData($id) {

        $deleted = DB::table('dosen_mata_kuliah')->where('id', $id)->delete();

        if ($deleted === 0) {
            throw new DosenPengampuNotFoundException("dosen pengampu dengan ID {$id} tidak ditemukan atau gagal dihapus.");
        }

        return "data berhasil dihapus.";
    }
}