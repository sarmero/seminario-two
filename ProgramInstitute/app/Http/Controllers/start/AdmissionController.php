<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\person;
use App\Models\Program;

class AdmissionController extends Controller
{
    public function index()
    {
        return view('start.Admission');
    }


    public function search(Request $request)
    {

        $number = $request->input('identification');
        $person = Person::where('number_document', $number)
            ->select('id', 'first_name', 'last_name')
            ->get()
            ->first();

        session(['aceptado' => false]);
        session(['rechazado' => false]);
        session(['pendiente' => false]);
        session(['noExiste' => false]);

        session(['name' => '']);
        session(['program' => '']);




        if ($person) {
            $admitted =  Admission::join('offer', 'admission.offer_id', '=', 'offer.id')
                ->join('program', 'offer.program_id', '=', 'program.id')
                ->join('calendar', 'offer.calendar_id', '=', 'calendar_id')
                ->select('admission.state_id','program.name', 'calendar.description')
                ->get()
                ->first();

            if ($admitted) {

                session(['name' => $person->first_name . ' ' . $person->last_name]);
                session(['program' => $admitted->name]);
                session(['date'=>$admitted->description]);

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
