<?php

namespace App\Policies;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

class MahasiswaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mahasiswa $mahasiswa): bool
    {
        // Admin bisa lihat semua
        if ($user->role_id === Role::ADMIN) {
            return true;
        }

        // Dosen hanya bisa lihat mahasiswa bimbingannya
        if ($user->role_id === Role::DOSEN) {
            return $user->dosen->id === $mahasiswa->dosen_id; // Asumsi relasi dosen-mahasiswa
        }

        // Mahasiswa hanya bisa lihat dirinya sendiri
        if ($user->role_id === Role::MAHASISWA) {
            return $user->mahasiswa->id === $mahasiswa->id; // Asumsi relasi user-mahasiswa
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mahasiswa $mahasiswa): bool
    {
        return false;
    }
}
