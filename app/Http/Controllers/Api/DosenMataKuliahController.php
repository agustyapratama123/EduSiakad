<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\DosenMataKuliahNotFound;
use App\Exceptions\DosenPengampuNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenMataKuliahRequest;
use App\Http\Services\DosenMataKuliahService;
use Illuminate\Http\Request;


class DosenMataKuliahController extends Controller
{

    protected DosenMataKuliahService $DosenMataKuliahService;

    public function __construct(DosenMataKuliahService $DosenMataKuliahService)
    {
        $this->DosenMataKuliahService = $DosenMataKuliahService;
    }


    public function index()
    {
        try {
            $result = $this->DosenMataKuliahService->getAllData();

            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);

        } catch (DosenMataKuliahNotFound $exception) {
            return response()->json([
                'status' => 404,
                'error' => $exception->getMessage()
            ], 404);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error' => $exception->getMessage()
            ], 500);
        }
    }


   public function store(DosenMataKuliahRequest $request)
    {
        try {
            $result = $this->DosenMataKuliahService->setDosenMataKuliahData($request);

            return response()->json([
                'status' => 201,
                'data' => $result
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error' => $exception->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        try {
            $result = $this->DosenMataKuliahService->getOneData($id);

            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);

        } catch (DosenPengampuNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(DosenMataKuliahRequest $request, string $id)
    {
        try {
            $result = $this->DosenMataKuliahService->updateDosenMataKuliahData($id, $request);

            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);

        } catch (DosenPengampuNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'error' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function destroy($id)
    {
        try {
            $result = $this->DosenMataKuliahService->deleteData($id);

            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil dihapus',
                'data' => $result
            ], 200);

        } catch (DosenPengampuNotFoundException $e) {
            return response()->json([
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
