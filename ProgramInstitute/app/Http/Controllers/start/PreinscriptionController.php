<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\District;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PreinscriptionController extends Controller
{

    public function index()
    {
        $district = district::get();

        $program = Offer::join("program", "program.id", "=", "offer.program_id")
            ->select('program.name', 'offer.id')
            ->orderBy("program.name", "asc")
            ->get();

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
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $url);

        $contact = Contact::create([
            'email' => $request->mail,
            'phone' => $request->phone,
        ]);

        $person = person::create([
            'number_document' => $request->document,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'contact_id' => $contact->id,
            'district_id' => $request->district,
            'role_id' => 3,
            'photo' => $url,
        ]);

        Admission::create([
            'state_id' => '1',
            'person_id' => $person->id,
            'offer_id' => $request->program,
        ]);

        return  redirect()->route('home');
    }
}
