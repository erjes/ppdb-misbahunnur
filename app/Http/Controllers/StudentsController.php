<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use App\Models\Student;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'address', 'parents', 'registration'])
            ->latest()
            ->paginate(15);

        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function edit($id){
        return view('students.edit', compact('id'));
    }

    public function show($id)
    {
        $student = Student::with(['user', 'address', 'parents', 'documents', 'grades', 'registration'])
            ->find($id);

        if (!$student) {
            abort(404);
        }

        return view('students.show', [
            'student' => $student,
        ]);
    }

    public function create(){
        return view('students.index');
    }

    public function store(StoreStudentsRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'] ?? null,
                'password' => isset($validated['password'])
                    ? Hash::make($validated['password'])
                    : Hash::make('123456'),
                'role' => 'siswa',
            ]);

            $student = Student::create(array_merge($validated, [
                'user_id' => $user->id,
            ]));

            Registration::create([
                'student_id' => $student->id,
                'tgl_daftar' => now(),
                'status' => 'pending',
                'is_active' => true,
            ]);

            DB::commit();

            return redirect()
                ->route('students.index')
                ->with('status', 'Siswa berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Gagal menambah siswa');
        }
    }

    public function update(UpdateStudentsRequest $request, $id)
    {
        $student = Student::with('user')->find($id);

        if (!$student) {
            return back()->withErrors('Siswa tidak ditemukan');
        }

        $validated = $request->validated();

        DB::beginTransaction();
        try {
            if (isset($validated['name'])) {
                $student->user->update(['name' => $validated['name']]);
                $student->update(['nama' => $validated['name']]);
            }

            if (isset($validated['email'])) {
                $student->user->update(['email' => $validated['email']]);
            }

            $student->update($validated);

            DB::commit();

            return redirect()
                ->route('students.show', $student->id)
                ->with('status', 'Data siswa berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Gagal memperbarui data siswa');
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return back()->withErrors('Siswa tidak ditemukan');
        }

        try {
            $student->user()->delete();
            $student->delete();

            return redirect()
                ->route('students.index')
                ->with('status', 'Siswa berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus siswa');
        }
    }
}
