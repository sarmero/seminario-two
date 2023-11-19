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
        $person = new person();
        $person->number_document = $request->input('document');
        $person->first_name = $request->input('firstName');
        $person->last_name = $request->input('lastName');
        $person->gender = $request->input('gender');
        $person->contact_id = $this->contact($request->input('phone'), $request->input('mail'));
        $person->district_id = $request->input('district');
        $person->role_id = 1;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('public/image/profile/users');
            $url = Storage::url($path);
            $person->photo = $url;
        }

        // $user->password = bcrypt($request->input('password'));
        //<img src="data:image/jpeg;base64,{{ base64_encode($persona->foto) }}" alt="Foto de la persona">

        $person->save();

        $offer = $request->input('program');
        $this->admission($person->id, $offer);

        return  redirect()->route('home');
    }

    private function contact($phone, $mail)
    {
        $contact = new Contact();
        $contact->email = $mail;
        $contact->phone = $phone;
        $contact->save();
        return $contact->id;
    }

    private function admission($id, $offer)
    {
        $admission = new Admission();
        $admission->state_id = 1;
        $admission->person_id = $id;
        $admission->offer_id = $offer;
        $admission->save();
    }
}
