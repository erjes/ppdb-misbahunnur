<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateaddressesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_id' => 'sometimes|exists:students,id',
            'alamat' => 'sometimes|string|max:255',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'desa' => 'sometimes|string|max:100',
            'kecamatan' => 'sometimes|string|max:100',
            'kota' => 'sometimes|string|max:100',
            'provinsi' => 'sometimes|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'koordinat' => 'nullable|string|max:100',
            'transportasi' => 'nullable|string|max:50',
            'status_tinggal' => 'nullable|string|max:50',
            'jarak' => 'nullable|numeric|min:0',
            'waktu' => 'nullable|string|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'student_id.exists' => 'Siswa tidak ditemukan.',
            'jarak.numeric' => 'Jarak harus berupa angka.',
            'jarak.min' => 'Jarak tidak boleh negatif.',
        ];
    }
}
