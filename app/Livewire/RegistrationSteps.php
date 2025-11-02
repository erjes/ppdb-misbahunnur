<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormSubmission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]

class RegistrationSteps extends Component
{
    use WithFileUploads;

    public $formDefinition;
    public $formModel; 
    public $formData = [];
    
    public $currentStep = 1;
    public $maxSteps;

    public $berkas_upload;
    public $konfirmasi_data_sesuai = false;
    public $setuju_ketentuan = false;
    
    // render skema formulir dari database
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
                // Inisialisasi dengan string kosong untuk select, null untuk yang lain
                $this->formData[$field['name']] = ($field['type'] === 'select') ? '' : null;
            }
        }

        $nomor_pendaftaran = date('Y') . '-' . rand(1000000000, 9999999999);
        $this->formData['nomor_pendaftaran'] = $nomor_pendaftaran;
    }

    // Navigasi

    public function nextStep()
    {
        try {
            // Untuk step 1, validasi manual dulu
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

        // Pindah step
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
    
        // Validasi untuk step 2 - 5
        if ($currentStepData && $this->currentStep > 1 && $this->currentStep <= $this->maxSteps) {
            foreach ($currentStepData['fields'] as $field) {
                $fieldName = 'formData.' . $field['name'];
                $fieldRules = $field['validation'] ?? '';
    
                if (($field['required'] ?? false) && !str_contains($fieldRules, 'required')) {
                    $fieldRules = 'required|' . $fieldRules;
                }
    
                if (!empty($fieldRules)) {
                    // Konversi string rules ke array 
                    $rules[$fieldName] = is_string($fieldRules) ? explode('|', $fieldRules) : $fieldRules;
                }
            }
        }

        if ($this->currentStep == $this->maxSteps + 1) {
            $rules = array_merge($rules, [
                'berkas_upload' => ['required', 'file', 'mimes:pdf,jpg,png', 'max:5120'],
                'konfirmasi_data_sesuai' => ['required', 'accepted'],
            ]);
        }
    
        if (!empty($rules)) {
            $this->validate($rules);
        }
    }
    
    // ---  Submit Formulir ---

    public function submitForm()
    {
        $this->validateCurrentStep();
        
        // 1. Proses Upload Berkas
        $path = $this->berkas_upload->store('public/pendaftaran');

        // 2. Simpan Data ke Database
        $jenisPendaftar = $this->formData['user_type'] ?? $this->formModel->type ?? null;
        
        $submission = FormSubmission::create([
            'form_id' => $this->formModel->id,
            'user_type' => $jenisPendaftar,
            'submission_data' => array_merge(
                $this->formData, 
                ['berkas_path' => $path] 
            ),
        ]);
        
        session()->flash('message', 'Pendaftaran Anda berhasil dikirim');
        $this->currentStep = $this->maxSteps + 2; 
        redirect()->route('registration.index');
    }

    // Rules untuk Livewire validation
    public function rules()
    {
        // Untuk step 1, kembalikan array kosong karena sudah divalidasi manual
        if ($this->currentStep === 1) {
            return [];
        }
        
        // Untuk step lainnya, kembalikan rules dari validateCurrentStep logic
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
                'berkas_upload' => ['required', 'file', 'mimes:pdf,jpg,png', 'max:5120'],
                'konfirmasi_data_sesuai' => ['required', 'accepted'],
            ]);
        }
        
        return $rules;
    }

    // Computed property untuk memeriksa apakah step 1 valid
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