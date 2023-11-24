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
        return view('session.ratingTeacher', ['subject' => $this->subject()]);
    }

    public function update(Request $request, $id)
    {
        $ins = InscriptionSubject::find($id);
        $ins->note = $request->input('note');
        $ins->save();

        return redirect()->route('teacher.ratings', ['subject' => $this->subject()]);
    }

    public function student(Request $request)
    {
        $id = $request->input('subject');

        $student = OfferSubject::select(
            'student.code',
            'person.id as person',
            'person.first_name',
            'person.last_name',
            'inscription_subject.id as inscription',
            'inscription_subject.note'
        )
            ->join('inscription_subject', 'inscription_subject.offer_subject_id', '=', 'offer_subject.id')
            ->join('inscription', 'inscription_subject.inscription_id', '=', 'inscription.id')
            ->join('student', 'inscription.student_id', '=', 'student.id')
            ->join('admission', 'student.admission_id', '=', 'admission.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->where('offer_subject.id', $id)
            ->get();


        return view('session.ratingTeacher', ['student' => $student, 'subject' => $this->subject()]);
    }

    private function subject()
    {
        return Subject::select('offer_subject.id', 'subject.description as subject', 'subject.semester_id as semester')
            ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', session('teacher'))
            ->where('offer_subject.calendar_id', session('calendar'))
            ->get();
    }
}
