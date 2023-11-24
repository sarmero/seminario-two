<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Actividades']);
        $subject = Subject::select('subject.description as subject', 'offer_subject.id')
            ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', session('teacher'))
            ->where('offer_subject.calendar_id', session('calendar'))
            ->get();

        return view('session.activityTeacher', ['subject' => $subject]);
    }

    public function store(Request $request)
    {
        $activity = new Activity();
        $activity->description = $request->input('description');
        $activity->offer_subject_id = $request->input('subject');
        $activity->deadline = $request->input('deadline');
        $activity->save();

        return redirect()->route('teacher.activity');
    }

    public function activity(Request $request)
    {
        $id = $request->input('subject');

        $activity = Activity::join('offer_subject', 'offer_subject.id', '=', 'activity.offer_subject_id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', session('teacher'))
            ->select('activity.description', 'activity.deadline')
            ->orderBy("activity.deadline", "asc")
            ->get();

        $subject = Subject::select('subject.description as subject', 'offer_subject.id')
            ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', session('teacher'))
            ->where('offer_subject.calendar_id', session('calendar'))
            ->get();

        return view('session.activityTeacher', ['activity' => $activity, 'subject' => $subject]);
    }
}
