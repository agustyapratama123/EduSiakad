<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Role;

class DosenPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN, Role::MAHASISWA]);
    }

    public function view(User $user, Dosen $dosen)
    {
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN, Role::MAHASISWA]);
    }

    public function create(User $user)
    {
        return $user->role_id === Role::ADMIN;
    }

    public function update(User $user, Dosen $dosen)
    {
        return $user->role_id === Role::ADMIN;
    }

    public function delete(User $user, Dosen $dosen)
    {
        return $user->role_id === Role::ADMIN;
    }
}
