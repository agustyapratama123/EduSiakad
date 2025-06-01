<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenMataKuliahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kelas' => $this->kelas,
            'tahun_ajaran' => $this->tahun_ajaran,
            'dosen' => new DosenResource($this->whenLoaded('dosen')),
            'mata_kuliah' => new MataKuliahResource($this->whenLoaded('mataKuliah')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
