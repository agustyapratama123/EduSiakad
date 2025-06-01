<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDosenRequest extends FormRequest
{
    public function authorize()
    {
        // Sesuaikan jika ingin membatasi siapa yang boleh membuat dosen
        return true;
    }

    public function rules()
    {
        return [
            'nama'           => 'required|string|max:255',
            'nidn'           => 'required|string|unique:dosen,nidn|max:20',
            'email'          => 'required|email|unique:dosen,email|unique:users,email',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'telepon'        => 'required|string|max:20',
        ];
    }
}
