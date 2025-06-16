<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Role;

class MahasiswaPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN]);
    }

    public function view(User $user, Mahasiswa $mahasiswa)
    {
        if ($user->role_id === Role::ADMIN) {
            return true;
        }

        if ($user->role_id === Role::DOSEN) {
            // Asumsi: Mahasiswa punya relasi dosen_id
            return $mahasiswa->dosen_id === $user->id;
        }

        if ($user->role_id === Role::MAHASISWA) {
            return $mahasiswa->user_id === $user->id;
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->role_id === Role::ADMIN;
    }

    public function update(User $user, Mahasiswa $mahasiswa)
    {
        return $user->role_id === Role::ADMIN;
    }

    public function delete(User $user, Mahasiswa $mahasiswa)
    {
        return $user->role_id === Role::ADMIN;
    }
}