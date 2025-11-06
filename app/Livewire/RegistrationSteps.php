<?php

namespace App\Livewire;

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

class RegistrationSteps extends Component
{
    public $formDefinition;
    public $formModel; 
    public $formData = [];
    
    public $currentStep = 1;
    public $maxSteps;

    public $konfirmasi_data_sesuai = false;
    public $setuju_ketentuan = false;
    
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

        $nomor_pendaftaran = date('Y') . '-' . rand(1000000000, 9999999999);
        $this->formData['nomor_pendaftaran'] = $nomor_pendaftaran;
    }

    public function nextStep()
    {
        try {
            if ($this->currentStep === 1) {
                $userType = trim($this->formData['user_type'] ?? '');
                if (empty($userType)) {
                    session()->flash('error', 'Anda harus memilih jenis pendaftaran (MTS atau MA).');
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

        DB::transaction(function () {
            $jenisPendaftar = $this->formData['user_type'] ?? $this->formModel->type ?? null;
            
            $user = User::create([
                'email' => $this->formData['nomor_pendaftaran'],
                'name' => $this->formData['nama_lengkap'],
                'password' => Hash::make($this->formData['nisn']),
                'role' => UserRole::user->value,
                'is_active' => true,
            ]);
            
            $userId = $user->id; 
    
            $student = Student::create([
                'user_id' => $userId, 
                'nomor_pendaftaran' => $this->formData['nomor_pendaftaran'], 
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
                'user_type' => $jenisPendaftar,
                'submission_data' => $this->formData,
            ]);

            Registration::create([
                'student_id' =>   $student->id,
                'tgl_daftar' => now(),
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
        
        $userType = $this->formData['user_type'] ?? '';
        $userTypeSelected = !empty($userType) && $userType !== '';
        return $userTypeSelected && $this->setuju_ketentuan;
    }

    public function render()
    {
        $currentStepData = collect($this->formDefinition)->firstWhere('step_number', $this->currentStep);

        return view('livewire.registration-steps', [
            'currentStepData' => $currentStepData,
        ]);
    }
}