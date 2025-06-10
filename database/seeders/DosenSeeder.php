<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'Dosen A',
            'email' => 'dosen@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Role mahasiswa
        ]);
        
        Dosen::create([
            'nama' => $user->name,
            'nidn' => '1001234567',
            'email' => $user->email,
            'tanggal_lahir' => '1980-06-15',
            'alamat' => 'Jl. Pendidikan No.10',
            'telepon' => '081234567891',
            'user_id' => $user->id,
        ]);
    }
}
