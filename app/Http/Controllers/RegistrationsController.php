<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Student;
use App\Models\Address;
use App\Models\ParentData;
use App\Http\Requests\StoreregistrationsRequest;
use App\Http\Requests\UpdateregistrationsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $registrations = Registration::with('student')->latest()->paginate(15);
        
        return view('student.registrations.index'
        // , [
        //     'registrations' => $registrations,
        // ]
         );
    }

    /**
     * Show the multi-step registration form.
     */
    public function create()
    {
        return view('registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreregistrationsRequest $request)
    {
        $validated = $request->validated();

        try {
            $registration = DB::transaction(function () use ($validated) {
                // 1) Create or find Student
                $studentPayload = $validated['student'];

                // map sekolah-asal group into student fields if provided
                if (isset($validated['school'])) {
                    $studentPayload['asal_sekolah'] = $validated['school']['nama'] ?? null;
                    $studentPayload['npsn_asal'] = $validated['school']['npsn'] ?? null;
                    $studentPayload['jenjang'] = $validated['school']['jenjang'] ?? ($studentPayload['jenjang'] ?? null);
                }

                $student = Student::create($studentPayload);

                // 2) Address
                if (isset($validated['address'])) {
                    Address::create(array_merge($validated['address'], [
                        'student_id' => $student->id,
                    ]));
                }

                // 3) Parents (ayah, ibu wajib, wali opsional)
                if (isset($validated['parents'])) {
                    foreach ($validated['parents'] as $relation => $parentData) {
                        if (!is_array($parentData)) {
                            continue;
                        }
                        ParentData::create(array_merge($parentData, [
                            'student_id' => $student->id,
                            'hubungan' => $relation, // ayah|ibu|wali
                        ]));
                    }
                }

                // 4) Registration row
                $registrationPayload = $validated['registration'] ?? [];
                $registrationPayload['student_id'] = $student->id;

                // default values if not set
                $registrationPayload['tgl_daftar'] = $registrationPayload['tgl_daftar'] ?? now();
                $registrationPayload['online'] = $registrationPayload['online'] ?? true;
                $registrationPayload['status'] = $registrationPayload['status'] ?? 'pending';

                return Registration::create($registrationPayload);
            });

            return redirect()
                ->route('registrations.show', $registration->id)
                ->with('status', 'Pendaftaran berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menambah pendaftaran');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registration = Registration::with('student')->find($id);
        
        if (!$registration) {
            abort(404);
        }
        
        return view('registrations.show', [
            'registration' => $registration,
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
                ->route('registrations.show', $registration->id)
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
                ->route('registrations.index')
                ->with('status', 'Pendaftaran berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->withErrors('Gagal menghapus pendaftaran');
        }
    }
}
