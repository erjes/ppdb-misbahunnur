<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        // ✅ Izinkan semua user (bisa disesuaikan dengan role admin)
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|min:6',
            'no_daftar' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'asal_sekolah' => 'nullable|string|max:100',
            'npsn_asal' => 'nullable|string|max:20',
            'jenjang' => 'nullable|string|max:50',
            'jurusan' => 'nullable|string|max:100',
            'foto' => 'nullable|string|max:255',
            'no_kk' => 'nullable|string|max:20',
            'nis' => 'nullable|string|max:20',
            'status_keluarga' => 'nullable|string|max:20',
            'paud' => 'boolean',
            'tk'=> 'boolean',
            'citacita'  => 'nullable|string|max:50',
            'hobi' => 'nullable|string|max:50',
            'sekolah_tujuan' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama siswa wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
        ];
    }
}
