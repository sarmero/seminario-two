<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ActivityTeacherController extends Controller
{
    private $subject;

    public function __construct()
    {

    }

    public function index()
    {
        $this->subject = Subject::select('subject.description as subject', 'offer_subject.id')
        ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
        ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
        ->where('programming.teacher_id', session('teacher'))
        ->where('offer_subject.calendar_id', session('calendar'))
        ->get();
        session(['page' => 'Actividades']);
        return view('session.teacher.activity.AdminActivityTeacher', ['subject' => $this->subject]);
    }

    public function create(){
        $this->subject = Subject::select('subject.description as subject', 'offer_subject.id')
        ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
        ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
        ->where('programming.teacher_id', session('teacher'))
        ->where('offer_subject.calendar_id', session('calendar'))
        ->get();
        return view('session.teacher.activity.CreateActivity', ['subject' => $this->subject]);
    }

    public function edit($id){
        $activity = Activity::find($id);
        $subject = Subject::select('subject.description')
        ->join('offer_subject', 'offer_subject.subject_id', '=', 'subject.id')
        ->join('activity', 'activity.offer_subject_id', '=', 'offer_subject.id')
        ->where('activity.id',$id)
        ->get()->first();
        return view('session.teacher.activity.EditActivity', ['name' => $subject, 'activity'=> $activity]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required',
            'description' => 'required|regex:/^(\s*\S.*\s*)*$/|min:10',
            'deadline' => 'required|date',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        Activity::create([
            'description' =>  $request->description,
            'deadline' => $request->deadline,
            'offer_subject_id' =>  $request->subject,
        ]);

        return redirect()->route('activity.index');
    }

    public function update(Request $request, $id){
        $validador = Validator::make($request->all(), [
            'description' => 'required|regex:/^(\s*\S.*\s*)*$/|min:10',
            'deadline' => 'required|date',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $activity = Activity::find($id);

        $activity->update([
            'description' =>  $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('activity.index');
    }

    public function show($id)
    {
        $activity = Activity::join('offer_subject', 'offer_subject.id', '=', 'activity.offer_subject_id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', session('teacher'))
            ->where('offer_subject.id',$id)
            ->select('activity.*')
            ->orderBy("activity.deadline", "asc")
            ->get();

        return response()->json(['activity' => $activity]);
    }

    public function destroy($id)
    {
        Activity::destroy($id);
        return  redirect()->route('activity.index');
    }
}
