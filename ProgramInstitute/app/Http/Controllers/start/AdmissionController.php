<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\person;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;

class AdmissionController extends Controller
{
    public function index()
    {
        return view('start.Admission');
    }

    public function search(Request $request)
    {
        $number = $request->identification;
        $person = Person::where('document', $number)
            ->get()
            ->first(['id', 'first_name', 'last_name']);

        session(['aceptado' => false]);
        session(['rechazado' => false]);
        session(['pendiente' => false]);
        session(['noExiste' => false]);

        session(['name' => '']);
        session(['program' => '']);

        // echo $person . '<br>';

        if ($person) {

            $admitted = Admission::with([
                'offer' => [
                    'program:id,name',
                    'calendar:id,description'
                ]
            ])
                ->where('person_id', $person->id)
                ->first(['id', 'offer_id','state_id']);

            // echo $admitted;


            if ($admitted) {

                session(['name' => $person->first_name . ' ' . $person->last_name]);
                session(['program' => $admitted->offer->program->name]);
                session(['date' => $admitted->offer->calendar->description]);

                if ($admitted->state_id == '1') {
                    session(['aceptado' => true]);
                } else if ($admitted->state_id == '2') {
                    session(['pendiente' => true]);
                } else {
                    session(['rechazado' => true]);
                }
            } else {
                session(['noExiste' => true]);
            }
        } else {
            session(['noExiste' => true]);
        }

        return redirect()->route('search.users');
    }
}
