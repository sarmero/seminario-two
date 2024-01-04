<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Calendar;
use App\Models\Contact;
use App\Models\district;
use App\Models\Offer;
use App\Models\person;
use App\Models\Program;
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

        $student = Student::with([
            'admission:id,person_id' => [
                'person' => [
                    'contact'
                ]
            ]
        ])
            ->where('id', $id)
            ->get()
            ->first();

        // echo $student;

        return view('admin.student.EditStudent', [
            'student' => $student->id,
            'person'=> $student->admission->person,
            'contact'=>$student->admission->person->contact,
            'district' => $district
        ]);
    }

    public function getPrograms($id)
    {
        $program = Program::with('offer:id,program_id')
            ->whereHas('offer', function ($query) use ($id) {
                $query->where('calendar_id', $id)
                    ->where('state_offer_id', '2');
            })
            ->orderBy('name', 'desc')
            ->get(['id', 'name']);

        return response()->json(['program' => $program]);
    }

    public function show($id)
    {
        $student = Admission::with([
            'person:id,first_name,last_name',
            'student:id,admission_id,code'
        ])->where('offer_id', $id)
            ->get(['id', 'person_id']);

        return response()->json([
            'student' => $student,
        ]);
    }

    public function showPerson($id)
    {
        $per = Offer::with([
            'admission' => [
                'person' => [
                    'contact',
                    'district',
                    'role'
                ],
                'student' => [
                    'semester'
                ]
            ],
            'modality',
            'program:id,name'

        ])->whereHas(
            'admission',
            function ($query) use ($id) {
                $query->where('id', $id);
            }
        )->get()->first();

        foreach ($per->admission as  $adm) {
            $person = $adm->person;
            foreach ($adm->student as  $std) {
                $student = $std;
            }
        }

        return view('admin.usersDetail.UserDetail', [
            'person' => $person,
            'contact' => $person->contact,
            'district' => $person->district,
            'role' => $person->role,
            'student' => $student,
            'modality' => $per->modality,
            'program' => $per->program
        ]);
    }

    public function update(Request $request, $id)
    {

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
