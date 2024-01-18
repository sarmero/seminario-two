<?php

namespace App\Http\Controllers\v1\session;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\InscriptionSubject;
use App\Models\News;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (session('role') == 1) {
        //     return $this->dataStudent(Auth::User()->person_id);
        // } else {
        //     return $this->dataTeacher(Auth::User()->person_id);
        // }

        if (Auth::check()){
            return ['user' => 'autenticado'];
        }else{
            return ['user' => 'no autenticado'];
        }


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

        session(['program_id' => $student->offer->program_id]);
        session(['student' => $student->id]);
        session(['code' => $student->code]);

        return [
            'activity' => ActivityResource::collection($activity),
            'news' => $news,
            'position' => ($position + 1),
            'average' => round($average, 2),
            'subject_tt' => $subject,
            'subjects' => count($approved),
            'code' => $student->code,
            'program' => $student->offer->program->name,
            'semester' => $student->semester_id,
        ];
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
