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
            $result = $this->DosenService->getAllData();
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
    public function store(StoreDosenRequest $request)
    {

        $result = ['status' => 200];

        try {
            $result['data'] = $this->DosenService->setDosenData($request->validated());
        } catch (\Exception $exception) {
            // dd(get_class($exception));
            $result=[
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }

        return response()->json([
            'message' => 'Data dosen berhasil disimpan',
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
            $result['data'] = $this->DosenService->getOneData($id);
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            // dd(get_class($exception));
            $result=[
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->DosenService->updateData($id, $request);
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
