<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreregistrationsRequest extends FormRequest
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
            // Student (Identitas calon siswa)
            'student' => 'required|array',
            'student.nama' => 'required|string|max:150',
            'student.nisn' => 'nullable|string|max:25',
            'student.nik' => 'nullable|string|max:25',
            'student.no_kk' => 'nullable|string|max:25',
            'student.nis' => 'nullable|string|max:25',
            'student.jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan,L,P',
            'student.tempat_lahir' => 'required|string|max:100',
            'student.tgl_lahir' => 'required|date',
            'student.agama' => 'required|string|max:50',
            'student.status_keluarga' => 'nullable|string|max:50',
            'student.anak_ke' => 'required|integer|min:1',
            'student.paud' => 'nullable|boolean',
            'student.tk' => 'nullable|boolean',
            'student.hobi' => 'nullable|string|max:100',
            'student.citacita' => 'nullable|string|max:100',
            'student.jenjang' => 'nullable|string|max:50',

            // Address (Alamat)
            'address' => 'required|array',
            'address.status_tinggal' => 'required|string|max:50',
            'address.alamat' => 'required|string|max:255',
            'address.desa' => 'required|string|max:100',
            'address.kecamatan' => 'required|string|max:100',
            'address.kota' => 'required|string|max:100',
            'address.provinsi' => 'required|string|max:100',
            'address.kode_pos' => 'required|string|max:10',
            'address.transportasi' => 'required|string|max:50',
            'address.jarak' => 'nullable|string|max:50',
            'address.waktu' => 'nullable|string|max:50',

            // Parents (Orang tua/wali)
            'parents' => 'required|array',
            'parents.ayah' => 'required|array',
            'parents.ayah.nik' => 'required|string|max:25',
            'parents.ayah.nama' => 'required|string|max:150',
            'parents.ayah.tempat_lahir' => 'nullable|string|max:100',
            'parents.ayah.tahun_lahir' => 'required|integer|min:1900',
            'parents.ayah.pendidikan' => 'required|string|max:50',
            'parents.ayah.pekerjaan' => 'required|string|max:50',
            'parents.ayah.penghasilan' => 'required|string|max:50',

            'parents.ibu' => 'required|array',
            'parents.ibu.nik' => 'required|string|max:25',
            'parents.ibu.nama' => 'required|string|max:150',
            'parents.ibu.tempat_lahir' => 'nullable|string|max:100',
            'parents.ibu.tahun_lahir' => 'required|integer|min:1900',
            'parents.ibu.pendidikan' => 'required|string|max:50',
            'parents.ibu.pekerjaan' => 'required|string|max:50',
            'parents.ibu.penghasilan' => 'required|string|max:50',

            'parents.wali' => 'nullable|array',
            'parents.wali.nik' => 'nullable|string|max:25',
            'parents.wali.nama' => 'nullable|string|max:150',
            'parents.wali.tempat_lahir' => 'nullable|string|max:100',
            'parents.wali.tahun_lahir' => 'nullable|integer|min:1900',
            'parents.wali.pendidikan' => 'nullable|string|max:50',
            'parents.wali.pekerjaan' => 'nullable|string|max:50',
            'parents.wali.penghasilan' => 'nullable|string|max:50',
            'parents.wali.no_hp' => 'nullable|string|max:20',

            // Sekolah Asal (mapped into student)
            'school' => 'nullable|array',
            'school.nama' => 'nullable|string|max:150',
            'school.jenjang' => 'nullable|string|max:50',
            'school.status' => 'nullable|string|max:50',
            'school.npsn' => 'nullable|string|max:20',
            'school.lokasi' => 'nullable|string|max:100',

            // Registration meta
            'registration' => 'nullable|array',
            'registration.tanggal_daftar' => 'nullable|date',
            'registration.tgl_konfirmasi' => 'nullable|date|after_or_equal:registration.tanggal_daftar',
            'registration.is_confirmed' => 'nullable|boolean',
            'registration.is_active' => 'nullable|boolean',
            'registration.status' => 'nullable|string|max:50',
            'registration.level' => 'nullable|string|max:50',
            'registration.tanggal_keluar' => 'nullable|date',
            'registration.alasan_keluar' => 'nullable|string|max:255',
            'registration.online' => 'nullable|boolean',
            'registration.is_paid' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'student.required' => 'Data siswa wajib diisi.',
            'student.nama.required' => 'Nama siswa wajib diisi.',
            'student.jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'student.tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'address.required' => 'Data alamat wajib diisi.',
            'address.alamat.required' => 'Alamat wajib diisi.',
            'parents.required' => 'Data orang tua/wali wajib diisi.',
            'parents.ayah.required' => 'Data ayah wajib diisi.',
            'parents.ibu.required' => 'Data ibu wajib diisi.',
            'registration.tgl_konfirmasi.after_or_equal' => 'Tanggal konfirmasi harus sama atau setelah tanggal daftar.',
        ];
    }
}
