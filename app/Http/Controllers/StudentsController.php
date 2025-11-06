<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\Student;
use App\Models\User;
use App\Models\Registration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function index()
    {
        // $students = Student::with(['user', 'address', 'parents', 'registration'])
        //     ->latest()
        //     ->paginate(15);

        // return view('admin.students.index', [
        //     'students' => $students,
        // ]);
        $form = Form::where('slug', 'ppdb-online')->first();
        $submissions = collect();
        if ($form) {
            $submissions = FormSubmission::where('form_id', $form->id)->get();
        }
        
        return view('admin.students.index',compact('submissions'));
    }

    public function edit($id){
        return view('admin.students.edit', compact('id'));
    }

    public function show($id)
    {
        $student = Student::with(['user', 'address', 'parents', 'documents', 'grades', 'registration'])
            ->find($id);

        if (!$student) {
            abort(404);
        }

        return view('admin.students.show', [
            'student' => $student,
        ]);
    }

    public function create(){
        return view('admin.students.index');
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
                ->route('admin.students.index')
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
                ->route('admin.students.show', $student->id)
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
                ->route('admin.students.index')
                ->with('status', 'Siswa berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus siswa');
        }
    }
}
