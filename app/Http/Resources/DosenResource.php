<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DosenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'nama'           => $this->nama,
            'nidn'           => $this->nidn,
            'email'          => $this->email,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'alamat'         => $this->alamat,
            'telepon'        => $this->telepon,
            'user_id'        => $this->user_id,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
