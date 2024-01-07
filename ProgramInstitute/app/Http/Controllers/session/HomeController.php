<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Inscription;
use App\Models\InscriptionSubject;
use App\Models\News;
use App\Models\User;
use App\Models\Person;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        session(['page' => 'Inicio']);
        if (session('role') == 1) {
            $this->dataStudent(Auth::User()->person_id);
        } else {
            $this->dataTeacher(Auth::User()->person_id);
        }

        return view('session.WelcomeSession');
    }

    private function dataStudent($id)
    {
        $student = Student::with([
            'offer:id,program_id' => [
                'program:id,name'
            ]
        ])
            ->where('person_id', $id)
            ->get()
            ->first();

        $approved = InscriptionSubject::where('student_id', $student->id)
            ->where('note', '>=', 3)
            ->get();

        $subject = Subject::where('program_id', $student->offer->program_id)->count();

        $average = InscriptionSubject::where('student_id', $student->id)->avg('note');

        if ($average == '') {
            $average = 0;
        }

        $position = Student::with(['inscriptionSubject' => function ($query) {
            $query->select('student_id', DB::raw('AVG(note)'))
                ->groupBy('student_id');
        }])->whereHas('inscriptionSubject', function ($query) use ($average) {
            $query->havingRaw('AVG(note) > ?', [$average]);
        })
            ->where('offer_id', $student->offer_id)
            ->where('id', '!=', $student->id)
            ->count();

        $activity = Activity::whereHas('offerSubject.inscriptionSubject', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })
            ->orderBy("deadline", "asc")
            ->get(['id', 'description', 'deadline']);

        $news = News::orderBy("date", "asc")->get();

        session(['program' => $student->offer->program->name]);
        session(['program_id' => $student->offer->program_id]);
        session(['student' => $student->id]);
        session(['code' => $student->code]);
        session(['semester' => $student->semester_id]);
        session(['subjects' => count($approved)]);
        session(['subject_tt' => $subject]);
        session(['average' => round($average, 2)]);
        session(['position' => $position + 1]);
        session(['activity' => $activity]);
        session(['news' => $news]);
    }

    private function dataTeacher($id)
    {
        $teacher = Teacher::where('person_id', $id)->get()->first();
        session(['teacher' => $teacher->id]);

        $news = News::orderBy("date", "asc")->get();
        session(['news' => $news]);

        $activity = Activity::whereHas('offerSubject', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->orderBy("deadline", "asc")
            ->get(['id', 'description', 'deadline']);

        session(['activity' => $activity]);
    }
}
