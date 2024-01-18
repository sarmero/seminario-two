<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionResource;
use App\Http\Resources\PersonResource;
use App\Models\Admission;
use App\Models\person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function index()
    {
        //
    }

    public function show($id)
    {
        $person = person::with(['role', 'district'])->where('id', $id)->first();
        return new PersonResource($person);
    }

    public function getDocument($number)
    {
        $person = Admission::with([
            'offer:id,calendar_id,program_id' => [
                'program:id,name',
                'calendar'
            ],
            'state',
            'person:id,first_name,last_name'
        ])->whereHas('person',function($query) use($number){
            $query->where('document', $number);
        })
            ->first(['id', 'offer_id','state_id','person_id']);

        return new AdmissionResource($person);
    }


    public function create(Request $request)
    {
        $person = new person();
        $person->document = $request->input('document');
        $person->first_name = $request->input('firstName');
        $person->last_name = $request->input('lastName');
        $person->gender = $request->input('gender');
        $person->email = $request->input('mail');
        $person->phone = $request->input('phone');
        $person->image = $request->input('image');
        $person->district_id = $request->input('district');

        return $person;
    }

    public function edit(Request $request, string $id)
    {
        $person = person::find($id);
        $person->document = $request->input('document');
        $person->first_name = $request->input('firstName');
        $person->last_name = $request->input('lastName');
        $person->gender = $request->input('gender');
        $person->email = $request->input('mail');
        $person->phone = $request->input('phone');
        $person->image = $request->input('image');
        $person->district_id = $request->input('district');

        return $person;
    }

    public function destroy(string $id)
    {
        //
    }
}
