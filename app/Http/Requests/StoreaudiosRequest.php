<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreaudiosRequest extends FormRequest
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
            'nama' => 'required|string|max:255',
            'file' => 'required|file|mimes:mp3,wav,ogg,aac,flac|max:10240', // max 10MB
            'uploaded_by' => 'required|integer|exists:users,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama audio wajib diisi.',
            'file.required' => 'File audio wajib diupload.',
            'file.file' => 'File harus berupa file yang valid.',
            'file.mimes' => 'File audio harus berupa MP3, WAV, OGG, AAC, atau FLAC.',
            'file.max' => 'Ukuran file audio maksimal 10MB.',
            'uploaded_by.required' => 'ID uploader wajib diisi.',
            'uploaded_by.integer' => 'ID uploader harus berupa angka.',
            'uploaded_by.exists' => 'Uploader tidak ditemukan.',
        ];
    }
}
