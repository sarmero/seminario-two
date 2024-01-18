<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\News;
use App\Models\Teacher;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        session(['page' => 'Inicio']);

        $person = session('person');
        session(['image' => $person['image']]);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/news');
        $news = $response->json("data");

        if (session('role') == 1) {
            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/student/student/' . $person['id']);
            $student = json_decode(json_encode($response->json("data")));

            // var_dump($student);

            $program = $student->offer->program->name;
            $semester =  $student->semester->description;
            $code = $student->code;

            session(['student_id' => $student->id]);
            session(['semester' => $student->semester->id]);
            session(['program_id' => $student->offer->program->id]);

            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/student/approved/' . $student->id);
            $subject = $response->json();

            // var_dump($subject);

            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/student/subject-count/' . $student->offer->program->id);
            $subject_tt = $response->json();

            // var_dump($subject_tt);

            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/student/average/' . $student->id);
            $average = $response->json();

            // var_dump($average);

            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/student/position/' . $student->id . '/offer/' . $student->offer->id);
            $position = $response->json();

            // var_dump($position);


            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/student/activity/' . $student->id);
            $activity = $response->json("data");

            // var_dump($activity);

            return view(
                'session.WelcomeSession',
                [
                    'program' => $program,
                    'semester' => $semester,
                    'code' => $code,
                    'subject' => $subject,
                    'subject_tt' => $subject_tt,
                    'average' => $average,
                    'position' => $position,
                    'activity' => $activity,
                    'news' => $news,
                    'person' => $person
                ]
            );
        } else {
            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/teacher/teacher/' . $person['id']);
            $teacher = json_decode(json_encode($response->json("data")));

            session(['teacher' => $teacher->id]);

            $url = env('URL_SERVER_API');
            $response = Http::get($url . '/v1/teacher/activity/' . $teacher->id);
            $activity = $response->json("data");

            $program = $teacher->program->name;

             return view(
                'session.WelcomeSession',
                [
                    'program' => $program,
                    'activity' => $activity,
                    'news' => $news,
                    'person' => $person
                ]
            );
        }

        // return view('session.WelcomeSession');
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


    }
}
