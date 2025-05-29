<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'admin', 'description' => 'Administrator sistem'],
            ['id' => 2, 'name' => 'mahasiswa', 'description' => 'Pengguna mahasiswa'],
            ['id' => 3, 'name' => 'dosen', 'description' => 'Pengguna dosen'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
