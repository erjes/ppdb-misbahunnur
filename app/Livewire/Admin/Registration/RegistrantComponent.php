<?php

namespace App\Livewire\Admin\Registration;

use Livewire\Component;
use App\Models\Student;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]  
class RegistrantComponent extends Component
{
    public $students;

    public function mount()
    {
        $this->students = Student::with('registration')->get();
    }

    public function render()
    {
        return view('livewire.admin.registration.registrant', [
            'students' => $this->students,
        ]);
    }
}
