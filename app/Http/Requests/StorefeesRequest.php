<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorefeesRequest extends FormRequest
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
            'nama_biaya' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'aktif' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_biaya.required' => 'Nama biaya wajib diisi.',
            'jumlah.required' => 'Jumlah biaya wajib diisi.',
            'jumlah.numeric' => 'Jumlah biaya harus berupa angka.',
            'jumlah.min' => 'Jumlah biaya tidak boleh negatif.',
            'aktif.boolean' => 'Status aktif harus berupa true atau false.',
        ];
    }
}
