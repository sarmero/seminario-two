<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Calendar;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\District;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PreinscriptionController extends Controller
{

    public function index()
    {
        $district = district::get();
        $cal = Calendar::latest('id')->first();

        $program = Offer::with('program:id,name')
        ->where('calendar_id', $cal->id)->where('state_offer_id', '1')
        ->get(['offer.program_id','offer.id']);

        // echo $program;

        return view('start.Preinscription', ['district' => $district], ['program' => $program]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'document' => 'required|integer|unique:person,number_document|min:10',
            'firstName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'lastName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'phone' => 'required|integer|min:10',
            'mail' => 'required|email|unique:contact,email|max:200',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $url);

        $person = person::create([
            'document' => $request->document,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'district_id' => $request->district,
            'role_id' => 3,
            'image' => $url,
            'email' => $request->mail,
            'phone' => $request->phone,
        ]);

        Admission::create([
            'state_id' => '1',
            'person_id' => $person->id,
            'offer_id' => $request->program,
        ]);

        return  redirect()->route('home');
    }
}
