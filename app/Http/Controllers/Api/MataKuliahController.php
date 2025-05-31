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
        } catch (\Exception $exception) {
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }

        return response()->json($result,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMataKuliahRequest $request)
    {

        $result = ['status' => 200];

        try {
            $result['data'] = $this->mataKuliahService->setMataKuliahData($request->validated());
        } catch (\Exception $exception) {
            // dd(get_class($exception));
            $result=[
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }

        return response()->json([
            'message' => 'Data mata kuliah berhasil disimpan',
            'data' => $result,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->mataKuliahService->getOneData($id);
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            // dd(get_class($exception));
            $result=[
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }catch(MataKuliahNotFoundException $mataKuliahNotFoundException){
            $result=[
                'status' => 500,
                'error' => $mataKuliahNotFoundException->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->mataKuliahService->updateData($id, $request);
        }catch (\Exception $exception) {
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }catch(MataKuliahNotFoundException $mataKuliahNotFoundException){
            $result=[
                'status' => 500,
                'error' => $mataKuliahNotFoundException->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->mataKuliahService->deleteData($id);
        }catch (\Exception $exception) {
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }catch(MataKuliahNotFoundException $mataKuliahNotFoundException){
            $result=[
                'status' => 500,
                'error' => $mataKuliahNotFoundException->getMessage()
            ];
        }

        return response()->json($result, $result['status']);


    }
}
