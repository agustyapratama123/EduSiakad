<?php

namespace App\Http\Services;

use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaService {
    protected $mahasiswa;

    public function __construct(Mahasiswa $mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }

    public function getAllData(){
        $mahasiswa = Mahasiswa::paginate(20); 
        
        return MahasiswaResource::collection($mahasiswa);
    }

    function setMahasiswaData($request) {

        return DB::transaction(function () use ($request) {

            // 1. Buat user
            $user = User::create([
                'name'     => $request['nama'],
                'email'    => $request['email'],
                'password' => Hash::make('password'), // atau generate acak
                'role_id'  => Role::MAHASISWA, // contoh: 2 = dosen
                'is_active'=> true,
            ]);

            // 2. Tambahkan user_id ke data mahasiswa
            $request['user_id'] = $user->id;

            // 3. Buat mahasiswa
            $mahasiswa = Mahasiswa::create($request->only([
                'nama', 'nim', 'email', 'id_prodi', 'tanggal_lahir', 'angkatan', 'alamat', 'telepon', 'user_id'
            ]));

            return new MahasiswaResource($mahasiswa);
        });
    }

    
}