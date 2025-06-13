<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Http\Services\MahasiswaService;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{

    protected $MahasiswaService;

    public function __construct(MahasiswaService $MahasiswaService){
        $this->MahasiswaService = $MahasiswaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $result = $this->MahasiswaService->getAllData();

            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error' => $exception->getMessage()
            ], 500);
        }
    }
    

    // POST: /api/mahasiswa (Create)
    public function store(MahasiswaRequest $request)
    {

        try {

            $result = $this->MahasiswaService->setMahasiswaData($request);

            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);

        }catch(\Throwable $e){
            return response()->json([
                'status' => 200,
                'data' => $e->getMessage(),
            ], 200);
        }
        
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