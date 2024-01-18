<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\person;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class AdmissionController extends Controller
{
    public function index()
    {
        return view('start.Admission');
    }

    public function search(Request $request)
    {
        $number = $request->identification;

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/person/document/' . $number);
        $person = json_decode(json_encode($response->json("data")));

        session(['aceptado' => false]);
        session(['rechazado' => false]);
        session(['pendiente' => false]);
        session(['noExiste' => false]);

        session(['name' => '']);
        session(['program' => '']);

        // echo $person . '<br>';

        if ($person) {
            session(['name' => $person->person->first_name . ' ' . $person->person->last_name]);
            session(['program' => $person->offer->program->name]);
            session(['date' => $person->offer->calendar->description]);

            if ($person->state->id == '1') {
                session(['aceptado' => true]);
            } else if ($person->state->id == '2') {
                session(['pendiente' => true]);
            } else {
                session(['rechazado' => true]);
            }
        } else {
            session(['noExiste' => true]);
        }

        return redirect()->route('search.users');
    }
}
