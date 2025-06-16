<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Role;

class MataKuliahPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN, Role::MAHASISWA]);
    }

    public function view(User $user, MataKuliah $mataKuliah)
    {
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN, Role::MAHASISWA]);
    }

    public function create(User $user)
    {
        return $user->role_id == Role::ADMIN;
    }

    public function update(User $user, MataKuliah $mataKuliah)
    {
        return $user->role_id == Role::ADMIN;
    }

    public function delete(User $user, MataKuliah $mataKuliah)
    {
        return $user->role_id == Role::ADMIN;
    }
}