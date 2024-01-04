<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\OfferSubject;

class ChairsTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Catedras']);

        $tea = session('teacher');
        $cal = session('calendar');

        $chairs = OfferSubject::with('subject:id,description,semester_id')
            ->whereHas('programming', function ($query) use ($tea) {
                $query->where('teacher_id', $tea);
            })->where('calendar_id', $cal)
            ->get(['id', 'subject_id']);

            // echo $chairs;

        return view('session.teacher.chairsTeacher', ['chairs' => $chairs]);

    }
}
