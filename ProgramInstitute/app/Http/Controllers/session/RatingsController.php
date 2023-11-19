<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RatingsController extends Controller
{
    public function index()
    {
        if (Session::has('session')) {
            if (session('session')) {
                session(['page' => 'Calificaciones']);
                $semester = Semester::get();
                session(['inscription' => 1]);
                return view('session.ratings', ['semester' => $semester]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function ratings(Request $request)
    {
        $semst = $request->input('smt');
        $inscription = session('inscription');

        $subject = Subject::select('subject.description', 'person.first_name', 'person.last_name', 'inscription_subject.note')
            ->join('offer_subject', 'subject.id', '=', 'offer_subject.subject_id')
            ->join('inscription_subject', function ($join) use ($inscription) {
                $join->on('offer_subject.id', '=', 'inscription_subject.offer_subject_id')
                    ->where('inscription_subject.inscription_id', '=', $inscription);
            })
            ->join('programming', 'offer_subject.id', '=', 'programming.offer_subject_id')
            ->join('teacher', 'programming.teacher_id', '=', 'teacher.id')
            ->join('person', 'teacher.person_id', '=', 'person.id')
            ->where('subject.semester_id', '=', $semst)
            ->get();


        $semester = Semester::get();

        return view(
            'session.ratings',
            [
                'subject' => $subject,
                'semester' => $semester,
                'semt' => $semst
            ]
        );
    }
}
