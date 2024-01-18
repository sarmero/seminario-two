<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\OfferSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ActivityTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Actividades']);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/list/subject/' . session('teacher'));
        $subject = json_decode(json_encode($response->json("data")));

        return view('session.teacher.activity.AdminActivityTeacher', ['subject' => $subject]);
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/list/subject/' . session('teacher'));
        $subject = json_decode(json_encode($response->json("data")));

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

        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/activity', $request);

        $data = $response->json();
        var_dump($data);

        // return redirect()->route('activity.index');
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

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/activity/' . $id, $request);
        $data = $response->json();

        return redirect()->route('activity.index');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/activity/' . $id);
        $activity = $response->json("data");

        return response()->json(['activity' => $activity]);
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/activity/' . $id);
        $data = $response->json();

        Activity::destroy($id);
        return  redirect()->route('activity.index');
    }
}
