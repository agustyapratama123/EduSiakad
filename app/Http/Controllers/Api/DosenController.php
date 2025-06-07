<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\DosenNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Services\DosenService;
use Illuminate\Http\Request;

class DosenController extends Controller
{

    protected $DosenService;

    public function __construct(DosenService $DosenService){
        $this->DosenService = $DosenService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = $this->DosenService->getAllData();

            return response()->json([
                'status' => 200,
                'data' => $data
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Terjadi kesalahan saat mengambil data dosen.',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDosenRequest $request)
    {
        try {
            $data = $this->DosenService->setDosenData($request->validated());

            return response()->json([
                'status' => 200,
                'message' => 'Data dosen berhasil disimpan',
                'data' => $data
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Gagal menyimpan data dosen.',
                'error' => $exception->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = $this->DosenService->getOneData($id);

            return response()->json([
                'status' => 200,
                'data' => $data
            ], 200);

        } catch (DosenNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error' => $exception->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $this->DosenService->updateData($id, $request);

            return response()->json([
                'status' => 200,
                'message' => 'Data dosen berhasil diperbarui',
                'data' => $data,
            ], 200);

        } catch (DosenNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->DosenService->deleteData($id);
        }catch (\Exception $exception) {
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }catch(DosenNotFoundException $DosenNotFoundException){
            $result=[
                'status' => 500,
                'error' => $DosenNotFoundException->getMessage()
            ];
        }

        return response()->json($result, $result['status']);


    }
}
