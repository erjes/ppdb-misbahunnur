<?php

namespace App\Livewire\Student\Registration;

use App\Enums\UserRole;
use Livewire\Component;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\Registration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]

class StepsComponent extends Component
{
    public $formDefinition;
    public $formModel; 
    public $formData = [];
    
    public $currentStep = 1;
    public $maxSteps;

    public $konfirmasi_data_sesuai = false;
    public $setuju_ketentuan = false;


    protected function getNomorUrutPendaftaran(string $prefix): string
    {
        return DB::transaction(function () use ($prefix) {
            
            $lastRegistration = Student::where('nomor_pendaftaran', 'LIKE', $prefix . '%')
                ->orderBy('nomor_pendaftaran', 'desc') 
                ->lockForUpdate()
                ->first();

            $nextNumber = 1;

            if ($lastRegistration) {
                $lastNumber = (int) substr($lastRegistration->nomor_pendaftaran, -3);
                $nextNumber = $lastNumber + 1;
            }

            return sprintf("%03d", $nextNumber);
        });
    }
    
    public function mount($slug = 'ppdb-online')
    {
        $this->formModel = Form::where('slug', $slug)->firstOrFail();
        $formSteps = $this->formModel->form_steps;
        
        $this->formDefinition = is_string($formSteps) ? json_decode($formSteps, true) : $formSteps;
    
        if (!is_array($this->formDefinition)) {
            $this->formDefinition = [];
        }

        $this->maxSteps = count($this->formDefinition);
        
        foreach ($this->formDefinition as $step) {
            foreach ($step['fields'] as $field) {
                $this->formData[$field['name']] = ($field['type'] === 'select') ? '' : null;
            }
        }

        $this->generateNomorPendaftaran();
    }

    public function generateNomorPendaftaran()
    {
        $jenjang = $this->formData['jenjang_daftar'] ?? '';
        $jalur_input = $this->formData['jalur_daftar'] ?? '';
        
        if (empty($jenjang) || empty($jalur_input)) {
            $this->formData['nomor_pendaftaran'] = 'Tunggu Pilihan Jenjang';
            return;
        }

        $tahun = substr(date('Y'), -2);
        $gelombang = $this->formData['gelombang'];
        $kode_jalur = '';
        
        if ($jalur_input == 'Reguler') {
            $kode_jalur = 'A';
        } elseif ($jalur_input == 'Yatim' || $jalur_input == 'Dhuafa') {
            $kode_jalur = 'B';
        } elseif ($jalur_input == 'Prestasi') {
            $kode_jalur = 'C';
        } else {
            $kode_jalur = 'A'; 
        }
        
        $komponen_awal = $tahun . $gelombang . $jenjang . $kode_jalur;
        $nomor_urut = $this->getNomorUrutPendaftaran($komponen_awal);
        $nomor_pendaftaran_lengkap = $komponen_awal . $nomor_urut;
        
        $this->formData['nomor_pendaftaran'] = $nomor_pendaftaran_lengkap;
    }

    public function updated($property, $value)
    {
        // Re-generate nomor pendaftaran jika jenjang atau jalur berubah
        if (in_array($property, ['formData.jenjang_daftar', 'formData.jalur_daftar'])) {
            $this->generateNomorPendaftaran();
        }
    }

    public function nextStep()
    {
        try {
            if ($this->currentStep === 1) {
                $jenjangType = trim($this->formData['jenjang_daftar'] ?? '');
                $jalurType = trim($this->formData['jalur_daftar'] ?? '');
                
                if (empty($jenjangType)) {
                    session()->flash('error', 'Anda harus memilih jenjang pendaftaran (MTS atau MA).');
                    $this->dispatch('scroll-to', target: '#form-start');
                    return;
                }
                if (empty($jalurType)) {
                    session()->flash('error', 'Anda harus memilih jalur pendaftaran.');
                    $this->dispatch('scroll-to', target: '#form-start');
                    return;
                }
                if (!$this->setuju_ketentuan) {
                    session()->flash('error', 'Anda harus menyetujui ketentuan pendaftaran.');
                    $this->dispatch('scroll-to', target: '#form-start');
                    return;
                }
            } else {
                $this->validateCurrentStep();
            }
        } catch (ValidationException $e) {
            $this->dispatch('scroll-to', target: '#form-start');
            throw $e;
        }

        if ($this->currentStep < $this->maxSteps + 1) {
            $this->currentStep++;
            $this->dispatch('scroll-to', target: '#form-start');
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->dispatch('scroll-to', target: '#form-start');
        }
    }


    public function validateCurrentStep()
    {
        $rules = [];
    
        $currentStepData = collect($this->formDefinition)->firstWhere('step_number', $this->currentStep);
    
        if ($currentStepData && $this->currentStep > 1 && $this->currentStep <= $this->maxSteps) {
            foreach ($currentStepData['fields'] as $field) {
                $fieldName = 'formData.' . $field['name'];
                $fieldRules = $field['validation'] ?? '';
    
                if (($field['required'] ?? false) && !str_contains($fieldRules, 'required')) {
                    $fieldRules = 'required|' . $fieldRules;
                }
    
                if (!empty($fieldRules)) {
                    $rules[$fieldName] = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;
                }
            }
        }

        if ($this->currentStep == $this->maxSteps + 1) {
            $rules = array_merge($rules, [
                'konfirmasi_data_sesuai' => ['required', 'accepted'],
            ]);
        }
    
        if (!empty($rules)) {
            $this->validate($rules);
        }
    }
    
    public function submitForm()
    {
        $this->validateCurrentStep();
    
        $nomorPendaftaran = $this->formData['nomor_pendaftaran'];

        DB::transaction(function () use ($nomorPendaftaran) {
            
            $user = User::create([
                'email' => $nomorPendaftaran, 
                'name' => $this->formData['nama_lengkap'],
                'password' => Hash::make($this->formData['nisn']),
                'role' => UserRole::user->value,
                'is_active' => true,
            ]);
            
            $userId = $user->id; 
    
            $student = Student::create([
                'user_id' => $userId, 
                'nomor_pendaftaran' => $nomorPendaftaran, 
                'nama_lengkap' => $this->formData['nama_lengkap'],
                'nisn' => $this->formData['nisn'],
                'nik_siswa' => $this->formData['nik_siswa'],
                'jenis_kelamin' => $this->formData['jenis_kelamin'],
                'tempat_kelahiran' => $this->formData['tempat_kelahiran'],
                'tanggal_lahir' => $this->formData['tanggal_lahir'],
                'agama' => $this->formData['agama'],
                'no_hp' => $this->formData['no_hp'],
                'nama_ayah' => $this->formData['nama_ayah'],
                'nama_ibu' => $this->formData['nama_ibu'],
                'no_kk' => $this->formData['no_kk'],
            ]);
    
            FormSubmission::create([
                'form_id' => $this->formModel->id,
                'student_id' => $student->id,
                'submission_data' => $this->formData,
            ]);

            Registration::create([
                'student_id' =>  $student->id,
                'jenjang_daftar' => $this->formData['jenjang_daftar'],
                'jalur_daftar' => $this->formData['jalur_daftar'],
                'tanggal_daftar' => now(),
                'online' => true,
                'status' => 'pending'
            ]);
            
        });
    
        session()->flash('message', "Pendaftaran Anda berhasil dikirim! Nomor Pendaftaran Anda adalah: **{$nomorPendaftaran}**. Silakan login menggunakan Nomor Pendaftaran dan NISN Anda.");
        $this->currentStep = $this->maxSteps + 2;
    }

    public function rules()
    {
        if ($this->currentStep === 1) {
            return [];
        }
        
        $rules = [];
        $currentStepData = collect($this->formDefinition)->firstWhere('step_number', $this->currentStep);
        
        if ($currentStepData && $this->currentStep > 1 && $this->currentStep <= $this->maxSteps) {
            foreach ($currentStepData['fields'] as $field) {
                $fieldName = 'formData.' . $field['name'];
                $fieldRules = $field['validation'] ?? '';
    
                if (($field['required'] ?? false) && !str_contains($fieldRules, 'required')) {
                    $fieldRules = 'required|' . $fieldRules;
                }
    
                if (!empty($fieldRules)) {
                    $rules[$fieldName] = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;
                }
            }
        }
        
        if ($this->currentStep == $this->maxSteps + 1) {
            $rules = array_merge($rules, [
                'konfirmasi_data_sesuai' => ['required', 'accepted'],
            ]);
        }
        
        return $rules;
    }

    public function getCanProceedFromStep1Property()
    {
        if ($this->currentStep !== 1) {
            return true;
        }
        
        $userType = $this->formData['jenjang_daftar'] ?? '';
        $userTypeSelected = !empty($userType) && $userType !== '';
        return $userTypeSelected && $this->setuju_ketentuan;
    }

    public function render()
    {
        $currentStepData = collect($this->formDefinition)->firstWhere('step_number', $this->currentStep);

        return view('livewire.registration.steps', [
            'currentStepData' => $currentStepData,
        ]);
    }
}
