<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\OfferSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RatingTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Calificaciones']);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/list/subject/' . session('teacher'));
        $subject = json_decode(json_encode($response->json("data")));
        // var_dump($subject);

        return view('session.teacher.RatingTeacher', ['subject' => $subject]);
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/rating/' . $id, [
            'note' => $request->note,
        ]);
        $data = $response->json();

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/list/subject/' . session('teacher'));
        $subject = json_decode(json_encode($response->json("data")));

        return redirect()->route('teacher.ratings', ['subject' => $subject]);
    }

    public function student(Request $request)
    {
        $id = $request->subject;

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/rating/' . $id);
        $student = json_decode(json_encode($response->json("data")));

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/list/subject/' . session('teacher'));
        $subject = json_decode(json_encode($response->json("data")));

        return view('session.teacher.ratingTeacher', ['student' => $student, 'subject' => $subject]);
    }
}
