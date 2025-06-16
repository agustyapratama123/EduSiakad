<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\MataKuliah;

class DosenMataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $kelasList = ['A101', 'A102', 'A103', 'B201', 'B202', 'B203', 'C301', 'C302', 'C303', 'D401', 'D402', 'D403'];
        $tahunAjaranList = ['2024/2025', '2025/2026'];

        $dosenIds = Dosen::pluck('id')->toArray();
        $mataKuliahIds = MataKuliah::pluck('id')->toArray();

        foreach ($dosenIds as $dosenId) {
            // Setiap dosen mengajar 3 sampai 6 mata kuliah secara acak
            $mataKuliahUntukDosen = collect($mataKuliahIds)->random(rand(3, 6));

            foreach ($mataKuliahUntukDosen as $mataKuliahId) {
                DB::table('dosen_mata_kuliah')->insert([
                    'dosen_id' => $dosenId,
                    'mata_kuliah_id' => $mataKuliahId,
                    'kelas' => $kelasList[array_rand($kelasList)],
                    'tahun_ajaran' => $tahunAjaranList[array_rand($tahunAjaranList)],
                ]);
            }
        }
    }
}
