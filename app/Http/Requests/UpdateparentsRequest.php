<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateparentsRequest extends FormRequest
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
            'hubungan' => 'sometimes|string|max:50',
            'nik' => 'nullable|string|max:20',
            'nama' => 'sometimes|string|max:255',
            'tempat_lahir' => 'nullable|string|max:100',
            'tahun_lahir' => 'nullable|integer|min:1900|max:' . date('Y'),
            'pendidikan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'penghasilan' => 'nullable|numeric|min:0',
            'no_hp' => 'nullable|string|max:20',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'student_id.exists' => 'Siswa tidak ditemukan.',
            'tahun_lahir.integer' => 'Tahun lahir harus berupa angka.',
            'tahun_lahir.min' => 'Tahun lahir tidak valid.',
            'tahun_lahir.max' => 'Tahun lahir tidak boleh lebih dari tahun ini.',
            'penghasilan.numeric' => 'Penghasilan harus berupa angka.',
            'penghasilan.min' => 'Penghasilan tidak boleh negatif.',
        ];
    }
}
