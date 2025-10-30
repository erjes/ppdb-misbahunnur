<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateregistrationsRequest extends FormRequest
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
            // Student
            'student' => 'sometimes|array',
            'student.nama' => 'sometimes|string|max:150',
            'student.nisn' => 'sometimes|nullable|string|max:25',
            'student.nik' => 'sometimes|nullable|string|max:25',
            'student.no_kk' => 'sometimes|nullable|string|max:25',
            'student.nis' => 'sometimes|nullable|string|max:25',
            'student.jenis_kelamin' => 'sometimes|string|in:Laki-laki,Perempuan,L,P',
            'student.tempat_lahir' => 'sometimes|string|max:100',
            'student.tgl_lahir' => 'sometimes|date',
            'student.agama' => 'sometimes|string|max:50',
            'student.status_keluarga' => 'sometimes|nullable|string|max:50',
            'student.anak_ke' => 'sometimes|integer|min:1',
            'student.paud' => 'sometimes|boolean',
            'student.tk' => 'sometimes|boolean',
            'student.hobi' => 'sometimes|nullable|string|max:100',
            'student.citacita' => 'sometimes|nullable|string|max:100',
            'student.jenjang' => 'sometimes|nullable|string|max:50',

            // Address
            'address' => 'sometimes|array',
            'address.status_tinggal' => 'sometimes|string|max:50',
            'address.alamat' => 'sometimes|string|max:255',
            'address.desa' => 'sometimes|string|max:100',
            'address.kecamatan' => 'sometimes|string|max:100',
            'address.kota' => 'sometimes|string|max:100',
            'address.provinsi' => 'sometimes|string|max:100',
            'address.kode_pos' => 'sometimes|string|max:10',
            'address.transportasi' => 'sometimes|string|max:50',
            'address.jarak' => 'sometimes|nullable|string|max:50',
            'address.waktu' => 'sometimes|nullable|string|max:50',

            // Parents
            'parents' => 'sometimes|array',
            'parents.ayah' => 'sometimes|array',
            'parents.ayah.nik' => 'sometimes|required|string|max:25',
            'parents.ayah.nama' => 'sometimes|required|string|max:150',
            'parents.ayah.tempat_lahir' => 'sometimes|nullable|string|max:100',
            'parents.ayah.tahun_lahir' => 'sometimes|required|integer|min:1900',
            'parents.ayah.pendidikan' => 'sometimes|required|string|max:50',
            'parents.ayah.pekerjaan' => 'sometimes|required|string|max:50',
            'parents.ayah.penghasilan' => 'sometimes|required|string|max:50',

            'parents.ibu' => 'sometimes|array',
            'parents.ibu.nik' => 'sometimes|required|string|max:25',
            'parents.ibu.nama' => 'sometimes|required|string|max:150',
            'parents.ibu.tempat_lahir' => 'sometimes|nullable|string|max:100',
            'parents.ibu.tahun_lahir' => 'sometimes|required|integer|min:1900',
            'parents.ibu.pendidikan' => 'sometimes|required|string|max:50',
            'parents.ibu.pekerjaan' => 'sometimes|required|string|max:50',
            'parents.ibu.penghasilan' => 'sometimes|required|string|max:50',

            'parents.wali' => 'sometimes|array',
            'parents.wali.nik' => 'sometimes|nullable|string|max:25',
            'parents.wali.nama' => 'sometimes|nullable|string|max:150',
            'parents.wali.tempat_lahir' => 'sometimes|nullable|string|max:100',
            'parents.wali.tahun_lahir' => 'sometimes|nullable|integer|min:1900',
            'parents.wali.pendidikan' => 'sometimes|nullable|string|max:50',
            'parents.wali.pekerjaan' => 'sometimes|nullable|string|max:50',
            'parents.wali.penghasilan' => 'sometimes|nullable|string|max:50',
            'parents.wali.no_hp' => 'sometimes|nullable|string|max:20',

            // School
            'school' => 'sometimes|array',
            'school.nama' => 'sometimes|nullable|string|max:150',
            'school.jenjang' => 'sometimes|nullable|string|max:50',
            'school.status' => 'sometimes|nullable|string|max:50',
            'school.npsn' => 'sometimes|nullable|string|max:20',
            'school.lokasi' => 'sometimes|nullable|string|max:100',

            // Registration meta
            'registration' => 'sometimes|array',
            'registration.tgl_daftar' => 'sometimes|nullable|date',
            'registration.tgl_konfirmasi' => 'sometimes|nullable|date|after_or_equal:registration.tgl_daftar',
            'registration.is_confirmed' => 'sometimes|nullable|boolean',
            'registration.is_active' => 'sometimes|nullable|boolean',
            'registration.status' => 'sometimes|nullable|string|max:50',
            'registration.level' => 'sometimes|nullable|string|max:50',
            'registration.tgl_keluar' => 'sometimes|nullable|date',
            'registration.alasan_keluar' => 'sometimes|nullable|string|max:255',
            'registration.online' => 'sometimes|nullable|boolean',
            'registration.is_paid' => 'sometimes|nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'registration.tgl_konfirmasi.after_or_equal' => 'Tanggal konfirmasi harus sama atau setelah tanggal daftar.',
        ];
    }
}
