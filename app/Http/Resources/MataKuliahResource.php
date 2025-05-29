<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MataKuliahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'kode'      => $this->kode,
            'nama'      => $this->nama,
            'sks'       => $this->sks,
            'semester'  => $this->semester,
            'deskripsi' => $this->deskripsi,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
        ];
    }
}

