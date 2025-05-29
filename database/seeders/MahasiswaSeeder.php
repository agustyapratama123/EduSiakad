<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        

        // Buat user untuk mahasiswa
        $user = User::create([
            'name' => 'Mahasiswa Satu',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Role mahasiswa
        ]);

        // Buat mahasiswa
        Mahasiswa::create([
            'nama' => $user->name,
            'nim' => '2023010001',
            'email' => $user->email,
            'id_prodi' => 1,
            'tanggal_lahir' => '2003-04-15',
            'angkatan' => '2023',
            'alamat' => 'Jl. Contoh No.1',
            'telepon' => '081234567890',
            'user_id' => $user->id,
        ]);
    }
}
