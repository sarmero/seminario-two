<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Contact;
use App\Models\district;
use App\Models\Offer;
use App\Models\person;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $calendar = Calendar::get();
        return view('admin.student.AdminStudent', ['calendar' => $calendar]);
    }

    public function edit($id)
    {
        $district = district::get();

        $student = Student::select('person.*','student.id as ids','contact.email','contact.phone')
        ->join('admission', 'student.admission_id', '=', 'admission.id')
        ->join('person', 'person.id', '=', 'admission.person_id')
        ->join('contact', 'person.contact_id', '=', 'contact.id')
        ->where('student.id', $id)
        ->get()
        ->first();

        return view('admin.student.EditStudent', ['student' => $student, 'district' => $district]);
    }

    public function getPrograms($id)
    {
        $program = Offer::select('offer.id', 'program.name')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('offer.calendar_id', $id)
            ->where('offer.state_offer_id', '2')
            ->orderBy('program.name', 'desc')
            ->get();

        return response()->json(['program' => $program]);
    }

    public function show($id)
    {
        $student = Offer::select('admission.id', 'student.code', 'student.id as ids', 'person.first_name', 'person.last_name')
            ->join('admission', 'admission.offer_id', '=', 'offer.id')
            ->join('student', 'student.admission_id', '=', 'admission.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->where('offer.id', $id)
            ->orderBy('person.first_name', 'desc')
            ->get();

        return response()->json(['student' => $student]);
    }

    public function showPerson($id)
    {
        $person = Offer::select(
            'person.*',
            'role.description as role',
            'program.name',
            'offer.code',
            'modality.description as modality',
            'district.description as district',
            'contact.*',
            'semester.description as semester'
        )
            ->join('admission', 'admission.offer_id', '=', 'offer.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->join('student', 'student.admission_id', '=', 'admission.id')
            ->join('semester', 'student.semester_id', '=', 'semester.id')
            ->join('contact', 'person.contact_id', '=', 'contact.id')
            ->join('role', 'person.role_id', '=', 'role.id')
            ->join('district', 'person.district_id', '=', 'district.id')
            ->join('modality', 'offer.modality_id', '=', 'modality.id')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('admission.id', $id)
            ->get()
            ->first();

        return view('admin.usersDetail.UserDetail', ['person' => $person]);
    }

    public function update(Request $request, $id){

        $validador = Validator::make($request->all(), [
            'document' => 'required|integer|min:10',
            'firstName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'lastName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'phone' => 'required|integer|min:10',
            'mail' => 'required|email|max:200',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $url);


        $person = person::find($id);
        $contact = Contact::find($person->contact_id);

        $contact->update([
            'email' => $request->mail,
            'phone' => $request->phone,
        ]);

        $person->update([
            'number_document' => $request->document,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'district_id' => $request->district,
            'photo' => $url,
        ]);

        return  redirect()->route('student.index');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return  redirect()->route('student.index');
    }

}
