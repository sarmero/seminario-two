<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ChairsTeacherController extends Controller
{
    public function index()
    {
        session(['page' => 'Catedras']);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/teacher/subject/'.session('teacher'));
        $chairs = $response->json("data");

        // var_dump($chairs);

        return view('session.teacher.chairsTeacher', ['chairs' => $chairs]);

    }
}
