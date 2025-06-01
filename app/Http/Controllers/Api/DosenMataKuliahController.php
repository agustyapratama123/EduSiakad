<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        }
        return response()->json([
            'status' => 200,
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'kelas' => 'nullable|string|max:50',
            'tahun_ajaran' => 'nullable|string|max:20',
        ]);

        $data = DosenMataKuliah::create($validated);

        return response()->json([
            'status' => 201,
            'message' => 'Data dosen pengampu berhasil disimpan',
            'data' => $data
        ]);
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
