<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoredocumentsRequest extends FormRequest
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
            'jenis_dokumen' => 'required|string|max:100',
            'no_dokumen' => 'nullable|string|max:100',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // 10MB max
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
            'jenis_dokumen.required' => 'Jenis dokumen wajib diisi.',
            'file.required' => 'File dokumen wajib diupload.',
            'file.file' => 'File harus berupa file yang valid.',
            'file.mimes' => 'File harus berupa PDF, JPG, JPEG, PNG, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}
