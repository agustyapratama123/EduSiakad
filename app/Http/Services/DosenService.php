<?php

namespace App\Http\Services;

use App\Exceptions\DosenNotFoundException;
use App\Http\Resources\DosenResource;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenService {

    protected $dosen;

    public function __construct(Dosen $dosen)
    {
        $this->dosen = $dosen;
    }

    public function getAllData(){
        $dosen = Dosen::paginate(20); // Atau sesuaikan per page-nya
        return DosenResource::collection($dosen);
    }
    
    public function getOneData($id){

        $dosen = $this->dosen->find($id);
        
        if(!$dosen){
            throw new DosenNotFoundException('dosen not found by id '.$id);
        }

        return new DosenResource($dosen);

    }

    function setDosenData($request) {

        // dd($request);
        return DB::transaction(function () use ($request) {

            // 1. Buat user
            $user = User::create([
                'name'     => $request['nama'],
                'email'    => $request['email'],
                'password' => Hash::make('password_default123'), // atau generate acak
                'role_id'  => 2, // contoh: 2 = dosen
                'is_active'=> true,
            ]);

            // 2. Tambahkan user_id ke data dosen
            $request['user_id'] = $user->id;

            // 3. Buat dosen
            $dosen = Dosen::create($request);

            return new DosenResource($dosen);
        });
        
    }

    function updateData(string $id, Request $request) {

        $data = $request->only(['kode', 'nama', 'sks', 'semester', 'deskripsi']);

        $data['updated_at'] = now();

        // Gunakan transaction untuk menjaga konsistensi data
        return DB::transaction(function () use ($id, $data) {

            $affected = Dosen::where('id', $id)->update($data);

            if ($affected === 0) {
                throw new DosenNotFoundException("Mata kuliah dengan ID {$id} tidak ditemukan atau tidak berubah.");
            }

            $dosenUpdated = Dosen::findOrFail($id);

            return new DosenResource($dosenUpdated);
        });
    }

    function deleteData($id) {

        $deleted = DB::table('mata_kuliah')->where('id', $id)->delete();

        if ($deleted === 0) {
            throw new DosenNotFoundException("Mata kuliah dengan ID {$id} tidak ditemukan atau gagal dihapus.");
        }

        return "data berhasil dihapus.";
    }
}

