<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 123; $i++) {
            $namaDepan = ['Aditya', 'Amanda', 'Budi', 'Citra', 'Dimas', 'Elvira', 'Fajar', 'Gina', 'Hendra', 'Indah', 'Joko', 'Kartika', 'Lukman', 'Maya', 'Niko', 'Oktavia', 'Putra', 'Qory', 'Rian', 'Sinta', 'Taufik', 'Ulfah', 'Vicky', 'Winda', 'Yoga', 'Zahra', 'Yuliana'];
            $namaBelakang = ['Nugroho', 'Putri', 'Santoso', 'Lestari', 'Saputra', 'Widya', 'Rahman', 'Maharani', 'Pratama', 'Ramadhani', 'Susanto', 'Sari', 'Hakim', 'Oktaviani', 'Firmansyah', 'Salsabila', 'Mahendra', 'Annisa', 'Nugraha', 'Dewi', 'Hidayat', 'Nuraini', 'Adi', 'Fitria', 'Permana', 'Ayu', 'Kartika'];
            $jk = ['L', 'P'];

            $first = $namaDepan[array_rand($namaDepan)];
            $last = $namaBelakang[array_rand($namaBelakang)];
            $nama = "$first $last";
            $email = Str::slug($first . '.' . $last) . $i . '@example.com';

            $user = User::create([
                'name' => $nama,
                'email' => $email,
                'password' => Hash::make('password'),
                'role_id' => Role::MAHASISWA,
            ]);

            Mahasiswa::create([
                'nama' => $nama,
                'nim' => '202301' . str_pad((string)$i, 4, '0', STR_PAD_LEFT),
                'email' => $email,
                'id_prodi' => 1,
                'tanggal_lahir' => now()->subYears(rand(18, 22))->subDays(rand(0, 365))->format('Y-m-d'),
                'angkatan' => '2023',
                'alamat' => 'Jl. Kampus No. ' . rand(1, 100),
                'telepon' => '08' . rand(1000000000, 9999999999),
                'jenis_kelamin' => $jk[array_rand($jk)],
                'user_id' => $user->id,
            ]);
        }
    }
}
