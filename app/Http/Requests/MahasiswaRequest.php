<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $mahasiswaId = $this->mahasiswa ? $this->mahasiswa->id : null;

        return [
            'nama' => 'required|string|max:255',
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mahasiswa')->ignore($mahasiswaId)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('mahasiswa')->ignore($mahasiswaId)
            ],
            'id_prodi' => 'required|exists:prodi,id',
            'tanggal_lahir' => 'required|date|before:today',
            'angkatan' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'alamat' => 'required|string|max:500',
            'telepon' => 'required|string|max:20',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama mahasiswa wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'id_prodi.required' => 'Program studi wajib dipilih',
            'id_prodi.exists' => 'Program studi tidak valid',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.before' => 'Tanggal lahir tidak boleh lebih dari hari ini',
            'angkatan.required' => 'Tahun angkatan wajib diisi',
            'angkatan.digits' => 'Tahun angkatan harus 4 digit',
            'angkatan.min' => 'Tahun angkatan tidak valid',
            'angkatan.max' => 'Tahun angkatan tidak boleh lebih dari tahun depan',
            'alamat.required' => 'Alamat wajib diisi',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'user_id.required' => 'User ID wajib diisi',
            'user_id.exists' => 'User tidak valid'
        ];
    }
}