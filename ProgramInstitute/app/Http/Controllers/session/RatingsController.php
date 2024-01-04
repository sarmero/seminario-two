<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RatingsController extends Controller
{
    public function index()
    {
        session(['page' => 'Calificaciones']);
        $semester = Semester::get();
        return view('session.student.RatingsStudent', ['semester' => $semester]);
    }

    public function ratings($id)
    {
        $subject = InscriptionSubject::with([
            'offerSubject:id,subject_id'=>[
                'subject:id,description,semester_id',
                'programming.teacher.person:id,first_name,last_name'
            ]
        ])->whereHas('offerSubject.subject', function ($query) use ($id){
            $query->where('semester_id', '=', $id);
        })->whereHas('inscription.student', function ($query){
            $query->where('code', '=', session('code'));
        })->get();

        return  response()->json(['subject' => $subject,]);
    }
}
