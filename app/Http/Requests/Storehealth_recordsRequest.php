<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storehealth_recordsRequest extends FormRequest
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
            'hepatitis' => 'nullable|boolean',
            'polio' => 'nullable|boolean',
            'bcg' => 'nullable|boolean',
            'campak' => 'nullable|boolean',
            'dpt' => 'nullable|boolean',
            'covid' => 'nullable|boolean',
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
            'hepatitis.boolean' => 'Status hepatitis harus berupa true atau false.',
            'polio.boolean' => 'Status polio harus berupa true atau false.',
            'bcg.boolean' => 'Status BCG harus berupa true atau false.',
            'campak.boolean' => 'Status campak harus berupa true atau false.',
            'dpt.boolean' => 'Status DPT harus berupa true atau false.',
            'covid.boolean' => 'Status COVID harus berupa true atau false.',
        ];
    }
}
