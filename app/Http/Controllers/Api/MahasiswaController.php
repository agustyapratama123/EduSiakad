<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // GET: /api/mahasiswa (Get All)
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return response()->json([
            'success' => true,
            'data' => $mahasiswas
        ], 200);
    }

    // POST: /api/mahasiswa (Create)
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim|max:20',
            'jurusan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create Data
        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ], 201);
    }

    // GET: /api/mahasiswa/{id} (Get by ID)
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ], 200);
    }

    // PUT/PATCH: /api/mahasiswa/{id} (Update)
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Validasi
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|string|max:255',
            'nim' => 'sometimes|string|unique:mahasiswas,nim,'.$id.'|max:20',
            'jurusan' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update Data
        $mahasiswa->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ], 200);
    }

    // DELETE: /api/mahasiswa/{id} (Delete)
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}