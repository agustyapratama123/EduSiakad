<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\DosenMataKuliahNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenMataKuliahRequest;
use App\Http\Services\DosenMataKuliahService;
use App\Models\DosenMataKuliah;
use App\Models\Dosen;
use App\Models\MataKuliah;
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
            
        } catch (\Exception $exception) {
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        } catch(DosenMataKuliahNotFound $exception) {
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }

    public function store(DosenMataKuliahRequest $request)
    {
        try{
            $result = $this->DosenMataKuliahService->setDosenMataKuliahData($request);
        }catch(\Exception $exception){
            $result = [
                'status' => 500,
                'error' => $exception->getMessage()
            ];
        }

        return response()->json($result,200);

    }

    public function show($id)
    {
        $data = DosenMataKuliah::with(['dosen', 'mataKuliah'])->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = DosenMataKuliah::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Data dosen pengampu berhasil dihapus'
        ]);
    }
}
