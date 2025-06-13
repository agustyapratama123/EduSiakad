<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MahasiswaNotFoundException;
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
                'status' => 500,
                'message' => 'Gagal menyimpan data mahasiswa.',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    // GET: /api/mahasiswa/{id} (Get by ID)
    public function show($id)
    {

        try{

            $result = $this->MahasiswaService->getOneData($id);

             return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);

        }catch(MahasiswaNotFoundException $e){

            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ], 404);
        }catch(\Exception $e){

            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ], 404);
        }
       
    }

    // PUT/PATCH: /api/mahasiswa/{id} (Update)
    public function update(MahasiswaRequest $request, $id)
    {

        try{
            $result = $this->MahasiswaService->updateData($id, $request);

            return response()->json([
                'status' => 200,
                'message' => 'Data mahasiswa berhasil diperbarui',
                'data' => $result,
            ], 200);

        }catch(MahasiswaNotFoundException $e){

            return response()->json([
                'status' => 404,
                'error' => $e->getMessage()
            ], 404);
        }
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