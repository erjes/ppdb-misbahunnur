<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoregradesRequest extends FormRequest
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
            'student_id' => 'required|exists:students,id',
            'mapel' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:12',
            'nilai' => 'required|numeric|min:0|max:100',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'ID siswa wajib diisi.',
            'student_id.exists' => 'Siswa tidak ditemukan.',
            'mapel.required' => 'Mata pelajaran wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.integer' => 'Semester harus berupa angka.',
            'semester.min' => 'Semester minimal 1.',
            'semester.max' => 'Semester maksimal 12.',
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.numeric' => 'Nilai harus berupa angka.',
            'nilai.min' => 'Nilai minimal 0.',
            'nilai.max' => 'Nilai maksimal 100.',
        ];
    }
}
