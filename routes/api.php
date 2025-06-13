<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\DosenMataKuliahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MataKuliahController;

use App\Models\Role;
use App\Http\Controllers\Api\MahasiswaController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    // Endpoint umum
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Mata Kuliah - Read only untuk dosen & mahasiswa
    Route::controller(MataKuliahController::class)->group(function () {
        Route::get('/mata-kuliah', 'index')->middleware('role:' . Role::ADMIN . ',' . Role::DOSEN . ',' . Role::MAHASISWA);
        Route::get('/mata-kuliah/{id}', 'show')->middleware('role:' . Role::ADMIN . ',' . Role::DOSEN . ',' . Role::MAHASISWA);
        Route::middleware('role:' . Role::ADMIN)->group(function () {
            Route::post('/mata-kuliah', 'store');
            Route::put('/mata-kuliah/{id}', 'update');
            Route::delete('/mata-kuliah/{id}', 'destroy');
        });
    });

    // Dosen - Read only untuk dosen & mahasiswa
    Route::controller(DosenController::class)->group(function () {
        Route::get('/dosen', 'index')->middleware('role:' . Role::ADMIN . ',' . Role::DOSEN . ',' . Role::MAHASISWA);
        Route::get('/dosen/{id}', 'show')->middleware('role:' . Role::ADMIN . ',' . Role::DOSEN . ',' . Role::MAHASISWA);
        Route::middleware('role:' . Role::ADMIN)->group(function () {
            Route::post('/dosen', 'store');
            Route::put('/dosen/{id}', 'update');
            Route::delete('/dosen/{id}', 'destroy');
        });
    });

    // Mahasiswa - Read only dengan batasan khusus
    Route::controller(MahasiswaController::class)->group(function () {
        // Admin & dosen bisa lihat semua
        Route::get('/mahasiswa', 'index')->middleware('role:' . Role::ADMIN . ',' . Role::DOSEN);
        Route::middleware('role:' . Role::ADMIN)->group(function () {
                Route::post('/mahasiswa', 'store');
                Route::put('/mahasiswa/{id}', 'update');
                Route::delete('/mahasiswa/{id}', 'destroy');
            });
        
        // Show: Admin (semua), Dosen (bimbingannya), Mahasiswa (hanya diri sendiri)
        Route::get('/mahasiswa/{mahasiswa}', 'show');
    });

    // Dosen Pengampu - Hanya admin
    Route::apiResource('dosen-pengampu', DosenMataKuliahController::class)
        ->middleware('role:' . Role::ADMIN);
});

