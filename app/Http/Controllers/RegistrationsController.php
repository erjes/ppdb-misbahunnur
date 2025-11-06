<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Student;
use App\Models\Address;
use App\Models\ParentData;
use App\Http\Requests\StoreregistrationsRequest;
use App\Http\Requests\UpdateregistrationsRequest;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $form = \App\Models\Form::where('slug', 'ppdb-online')->first();
        $submissions = collect();
        if ($form) {
            $submissions = FormSubmission::where('form_id', $form->id)->get();
        }
        
        return view('admin.students.index',compact('submissions'));
    }

    public function edit($id){
        $registration = Registration::with(['student.address', 'student.parents'])->findOrFail($id);

        $form = \App\Models\Form::where('slug', 'ppdb-online')->first();

        $formSubmission = null;
        if ($form) {
            $formSubmission = \App\Models\FormSubmission::where('form_id', $form->id)
                ->where('user_type', 'student')
                ->whereJsonContains('submission_data->student_id', $registration->student_id)
                ->first();
        }

        return view('admin.students.edit', [
            'registration' => $registration,
            'student' => $registration->student,
            'address' => $registration->student->address ?? null,
            'parents' => $registration->student->parents ?? collect(),
            'formSubmission' => $formSubmission,
            'form' => $form,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateregistrationsRequest $request, $id)
    {
        $registration = Registration::with('student')->find($id);
        
        if (!$registration) {
            return back()->withErrors('Pendaftaran tidak ditemukan');
        }
        
        $validated = $request->validated();
        
        try {
            DB::transaction(function () use ($registration, $validated) {
                // Update student
                if (isset($validated['student'])) {
                    $studentPayload = $validated['student'];

                    if (isset($validated['school'])) {
                        $studentPayload['asal_sekolah'] = $validated['school']['nama'] ?? null;
                        $studentPayload['npsn_asal'] = $validated['school']['npsn'] ?? null;
                        $studentPayload['jenjang'] = $validated['school']['jenjang'] ?? ($studentPayload['jenjang'] ?? null);
                    }

                    $registration->student->update($studentPayload);
                }

                // Update address
                if (isset($validated['address'])) {
                    $address = $registration->student->address;
                    if ($address) {
                        $address->update($validated['address']);
                    } else {
                        Address::create(array_merge($validated['address'], [
                            'student_id' => $registration->student_id,
                        ]));
                    }
                }

                // Update parents: upsert by hubungan
                if (isset($validated['parents'])) {
                    foreach ($validated['parents'] as $relation => $parentData) {
                        if (!is_array($parentData)) {
                            continue;
                        }
                        $existing = ParentData::where('student_id', $registration->student_id)
                            ->where('hubungan', $relation)
                            ->first();
                        if ($existing) {
                            $existing->update($parentData);
                        } else {
                            ParentData::create(array_merge($parentData, [
                                'student_id' => $registration->student_id,
                                'hubungan' => $relation,
                            ]));
                        }
                    }
                }

                // Update registration
                if (isset($validated['registration'])) {
                    $registration->update($validated['registration']);
                }
            });
            
            return redirect()
                ->route('admin.students.show', $registration->id)
                ->with('status', 'Pendaftaran berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal memperbarui pendaftaran');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registration = Registration::find($id);
        
        if (!$registration) {
            return back()->withErrors('Pendaftaran tidak ditemukan');
        }
        
        try {
            $registration->delete();
            
            return redirect()
                ->route('admin.registrations.index')
                ->with('status', 'Pendaftaran berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus pendaftaran');
        }
    }
}
