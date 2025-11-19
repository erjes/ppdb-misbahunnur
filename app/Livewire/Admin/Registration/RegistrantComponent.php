<?php

namespace App\Livewire\Admin\Registration;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class RegistrantComponent extends Component
{
    public $search = ''; 

    public function render()
    {
        $role = Auth::user()->role;
        $jenjang = '';

        if ($role == 'admin_ma') {
            $jenjang = 'MA';
        } elseif ($role == 'admin_mts') {
            $jenjang = 'MTS';
        }

        $students = collect();

        if ($jenjang) {
            $students = Student::with('registration')
                ->whereHas('registration', function($query) use ($jenjang) {
                    $query->where('jenjang_daftar', $jenjang)
                        ->where(function ($q) {
                            $q->where('registrations.status', '!=', 'approved')
                              ->orWhere('registrations.is_paid', 0);
                        });
                })
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                          ->orWhere('nomor_pendaftaran', 'like', '%' . $this->search . '%');
                    });
                })
                ->get();
        }

        return view('livewire.admin.registration.registrant', [
            'students' => $students,
        ]);
    }
}