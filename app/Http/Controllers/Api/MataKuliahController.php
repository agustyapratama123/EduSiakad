<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MataKuliahNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Services\MataKuliahService;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{

    protected $mataKuliahService;

    public function __construct(MataKuliahService $mataKuliahService){
        $this->mataKuliahService = $mataKuliahService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $result = $this->mataKuliahService->getAllData();

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


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMataKuliahRequest $request)
    {
        try {
            $data = $this->mataKuliahService->setMataKuliahData($request->validated());

            return response()->json([
                'status' => 201,
                'message' => 'Data mata kuliah berhasil disimpan',
                'data' => $data,
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menyimpan data mata kuliah.',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->mataKuliahService->getOneData($id);

            return response()->json([
                'status' => 201,
                'message' => 'Data mata kuliah ditemukan',
                'data' => $data,
            ], 201);

        } catch (MataKuliahNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan pada server.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // dd($exception->getMessage());
    // dd(get_class($exception));
    
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
    {
        try {
            $data = $this->mataKuliahService->updateData($id, $request);

            return response()->json([
                'status' => 200,
                'message' => 'Data mata kuliah berhasil diperbarui',
                'data' => $data,
            ], 200);

        } catch (MataKuliahNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        try {
            $this->mataKuliahService->deleteData($id);

            return response()->json([
                'status' => 200,
                'message' => 'Data mata kuliah berhasil dihapus',
            ], 200);

        } catch (MataKuliahNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
