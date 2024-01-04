<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\OfferSubject;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RatingTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Calificaciones']);
        return view('session.teacher.RatingTeacher', ['subject' => $this->subject()]);
    }

    public function update(Request $request, $id)
    {
        $ins = InscriptionSubject::find($id);
        $ins->update([
            'note' => $request->note,
        ]);

        return redirect()->route('teacher.ratings', ['subject' => $this->subject()]);
    }

    public function student(Request $request)
    {
        $id = $request->subject;

        $studentx = OfferSubject::with([
            'inscriptionSubject:id,note,offer_subject_id,inscription_id' => [
                'inscription:id,student_id' => [
                    'student.admission.person:id,first_name,last_name'
                ]
            ]
        ])->where('id', $id)->get(['id']);

        $student = null;

        foreach ($studentx as $std) {
            $student =  $std->inscriptionSubject;
        }

        return view('session.teacher.ratingTeacher', ['student' => $student, 'subject' => $this->subject()]);
    }

    private function subject()
    {
        $tea = session('teacher');
        $cal = session('calendar');

        return OfferSubject::with('subject:id,description,semester_id')
            ->whereHas('programming', function ($query) use ($tea) {
                $query->where('teacher_id', $tea);
            })->where('calendar_id', $cal)
            ->get(['id', 'subject_id']);
    }

    
}
