<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\OfferSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ActivityTeacherController extends Controller
{
    public function index()
    {
        $tea = session('teacher');
        $cal = session('calendar');

        $subject = OfferSubject::with('subject:id,description')
            ->whereHas('programming', function ($query) use ($tea) {
                $query->where('teacher_id', $tea);
            })->where('calendar_id', $cal)
            ->get(['id', 'subject_id']);


        return view('session.teacher.activity.AdminActivityTeacher', ['subject' => $subject]);
    }

    public function create()
    {
        $tea = session('teacher');
        $cal = session('calendar');

        $subject = OfferSubject::with('subject:id,description')
            ->whereHas('programming', function ($query) use ($tea) {
                $query->where('teacher_id', $tea);
            })->where('calendar_id', $cal)
            ->get(['id', 'subject_id']);

        return view('session.teacher.activity.CreateActivity', ['subject' => $subject]);
    }

    public function edit($id)
    {
        $activity = Activity::find($id);

        $subject = Subject::whereHas('offerSubject.activity', function ($query) use ($id) {
            $query->where('id', $id);
        })
            ->get(['id', 'description'])->first();
        return view('session.teacher.activity.EditActivity', ['name' => $subject, 'activity' => $activity]);
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

    public function update(Request $request, $id)
    {
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
        $tea = session('teacher');

        $activity = OfferSubject::with('activity')
            ->whereHas('programming', function ($query) use ($tea) {
                $query->where('teacher_id', $tea);
            })
            ->where('id', $id)
            ->get(['id'])->first();

        return response()->json(['activity' => $activity->activity]);
    }

    public function destroy($id)
    {
        Activity::destroy($id);
        return  redirect()->route('activity.index');
    }
}
