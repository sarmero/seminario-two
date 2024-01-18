<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Offer;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    public function index()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/programs');
        // $program = $response->json("data");
        $program = json_decode(json_encode($response->json("data")));

        return view('start.Program', ['program' => $program]);
    }

    public function content(int $id)
    {
        // $program = Program::find($id);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/programs/'.$id);
        $program = json_decode(json_encode($response->json("data")));

        return view('start.Content', ['program' => $program]);
    }
}
