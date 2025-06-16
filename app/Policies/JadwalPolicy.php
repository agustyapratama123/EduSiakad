<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Role;

class JadwalPolicy
{
    public function viewAny(User $user)
    {
        // Admin, dosen, dan mahasiswa bisa melihat daftar jadwal
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN, Role::MAHASISWA]);
    }

    public function view(User $user, Jadwal $jadwal) // Ubah parameter $dosen menjadi $jadwal
    {
        // Admin, dosen, dan mahasiswa bisa melihat detail jadwal
        return in_array($user->role_id, [Role::ADMIN, Role::DOSEN, Role::MAHASISWA]);
    }

    public function create(User $user)
    {
        // HANYA admin yang bisa membuat jadwal baru
        return $user->role_id == Role::ADMIN;
    }

    public function update(User $user, Jadwal $jadwal) // Ubah parameter $dosen menjadi $jadwal
    {
        // Hanya admin yang bisa mengupdate jadwal
        return $user->role_id == Role::ADMIN;
    }

    public function delete(User $user, Jadwal $jadwal) // Ubah parameter $dosen menjadi $jadwal
    {
        // Hanya admin yang bisa menghapus jadwal
        return $user->role_id == Role::ADMIN;
    }

    // Tambahkan jika menggunakan soft deletes
    public function restore(User $user, Jadwal $jadwal)
    {
        return $user->role_id == Role::ADMIN;
    }

    public function forceDelete(User $user, Jadwal $jadwal)
    {
        return $user->role_id == Role::ADMIN;
    }
}