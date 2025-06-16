<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $namaDepan = ['Andi', 'Siti', 'Bambang', 'Dewi', 'Eko', 'Fajar', 'Gita', 'Hadi', 'Intan', 'Joko'];
        $namaBelakang = ['Wijaya', 'Nurhaliza', 'Subagio', 'Putri', 'Santoso', 'Pratama', 'Wardhani', 'Saputra', 'Lestari', 'Rahmawati'];

        for ($i = 1; $i <= 30; $i++) {
            $first = $namaDepan[array_rand($namaDepan)];
            $last = $namaBelakang[array_rand($namaBelakang)];
            $nama = "$first $last";
            $email = Str::slug($first . '.' . $last) . $i . '@example.com';

            $user = User::create([
                'name' => $nama,
                'email' => $email,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'role_id' => Role::DOSEN,
            ]);

            DB::table('dosen')->insert([
                'nama' => $nama,
                'nidn' => str_pad((string)rand(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                'email' => $email,
                'tanggal_lahir' => now()->subYears(rand(30, 60))->subDays(rand(0, 365))->format('Y-m-d'),
                'alamat' => 'Jl. Contoh Alamat No. ' . rand(1, 100) . ', Kota Contoh',
                'telepon' => '08' . rand(1000000000, 9999999999),
                'user_id' => $user->id,
            ]);
        }
    }
}
