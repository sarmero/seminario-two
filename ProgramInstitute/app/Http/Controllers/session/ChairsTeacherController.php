<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChairsTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Catedras']);

        $chairs = Subject::select('subject.description as subject', 'subject.semester_id as semester')
            ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', session('teacher'))
            ->where('offer_subject.calendar_id', session('calendar'))
            ->get();

        return view('session.chairsTeacher', ['chairs' => $chairs]);
    }
}
