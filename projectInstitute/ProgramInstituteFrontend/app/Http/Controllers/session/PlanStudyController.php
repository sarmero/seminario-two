<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PlanStudyController extends Controller
{
    public function index()
    {
        session(['page' => 'Plan de estudio']);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/planstudy/' .  session('program_id'));
        $subject = json_decode(json_encode($response->json()));

        return view('session.student.PlanStudyStudent', ['subject' => $subject]);
    }
}
