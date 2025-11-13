<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepaymentsRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'fee_id' => 'required|exists:fees,id',
            'bukti_pembayaran' => 'nullable|string|max:100',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_bayar' => 'nullable|date',
            'bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            'verifikasi' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'ID user wajib diisi.',
            'user_id.exists' => 'User tidak ditemukan.',
            'fee_id.required' => 'ID biaya wajib diisi.',
            'fee_id.exists' => 'Biaya tidak ditemukan.',
            'jumlah.required' => 'Jumlah pembayaran wajib diisi.',
            'jumlah.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'jumlah.min' => 'Jumlah pembayaran tidak boleh negatif.',
            'tanggal_bayar.date' => 'Tanggal bayar harus berupa tanggal yang valid.',
            'bukti.file' => 'Bukti pembayaran harus berupa file yang valid.',
            'bukti.mimes' => 'Bukti pembayaran harus berupa PDF, JPG, JPEG, atau PNG.',
            'bukti.max' => 'Ukuran file bukti pembayaran maksimal 10MB.',
            'verifikasi.boolean' => 'Status verifikasi harus berupa true atau false.',
        ];
    }
}
