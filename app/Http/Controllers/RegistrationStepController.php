<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationStepController extends Controller
{
    //
    public function status(){
 
    $student = Student::where('user_id', Auth::id())
    ->with('registration')
    ->first();

    return view('students.panel.status', [
    'student' => $student,
    'registration' => $student?->registration, 
    ]);

    }

    
    public function scholarship(){
        return view('students.panel.beasiswa');
    }
    
    public function documents(){
        return view('students.panel.documents');
    }

    public function payment(){
        return view('students.panel.payment');
    }
}
