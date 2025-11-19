<?php

namespace App\Livewire\Admin\Registration;

use Livewire\Component;
use App\Models\Student;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class RequiredDocumentsComponent extends Component
{
    public $student;
    public $documents = [];
    public $newStatus; 

    public function mount($studentId)
    {
        $this->student = Student::with(['registration','documents'])
            ->findOrFail($studentId);

        $this->loadDocuments();
    }

    public function updateStatus()
    {
        $this->student = Student::with(['registration', 'payments.fee'])
            ->where('id', $this->student->id)   
            ->firstOrFail();
        
        if (!in_array($this->newStatus, ['approved', 'rejected', 'pending'])) {
            session()->flash('error', 'Status yang dipilih tidak valid.');
            return;
        }

        $this->student->registration->status = $this->newStatus; 
        $this->student->registration->save();

        $this->loadDocuments(); 

        session()->flash('message', 'Status pendaftaran berhasil diupdate!');
    }

    public function loadDocuments()
    {
        $this->documents = $this->student->documents;
    }

    public function render()
    {
        return view('livewire.admin.registration.documents', [
            'student'   => $this->student,
            'documents' => $this->documents,
        ]);
    }
}
