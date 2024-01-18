<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RatingsController extends Controller
{
    public function index()
    {
        session(['page' => 'Calificaciones']);
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/semester');
        $semester = $response->json("data");

        return view('session.student.RatingsStudent', ['semester' => $semester]);
    }

    public function ratings($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/ratings/semester/'.$id.'/student/'.session('student_id'));
        $subject = json_decode(json_encode($response->json("data")));

        return  response()->json(['subject' => $subject,]);
    }
}
