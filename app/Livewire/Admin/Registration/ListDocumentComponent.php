<?php

namespace App\Livewire\Admin\Registration;

use Livewire\Component;
use App\Models\Student;
use App\Models\Document;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class ListDocumentComponent extends Component
{
    public $student;
    public $documents = [];

    public function mount($nomor_pendaftaran)
    {
        $this->student = Student::where('nomor_pendaftaran', $nomor_pendaftaran)->firstOrFail();
        $this->loadDocuments();
    }

    public function loadDocuments()
    {
        $this->documents = Document::where('student_id', $this->student->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.registration.document', [
            'student' => $this->student,
            'documents' => $this->documents
        ]);
    }
}
