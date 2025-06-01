<?php

use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\DosenMataKuliahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MataKuliahController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('mata-kuliah', MataKuliahController::class);
Route::apiResource('dosen',DosenController::class);
Route::apiResource('dosen-pengampu', DosenMataKuliahController::class);


