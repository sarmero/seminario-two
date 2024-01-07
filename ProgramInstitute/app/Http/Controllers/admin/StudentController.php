<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\district;
use App\Models\Offer;
use App\Models\person;
use App\Models\Student;
use Illuminate\Http\Request;
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

        $student = Student::with('person')
            ->where('id', $id)
            ->get()
            ->first();

        // echo $student;

        return view('admin.student.EditStudent', [
            'student' => $student->id,
            'person' => $student->person,
            'district' => $district
        ]);
    }

    public function getPrograms($id)
    {
        $program = Offer::with('program:id,name')
            ->whereHas('program', function ($query) use ($id) {
                $query->orderBy('name', 'desc');
            })
            ->where('calendar_id', $id)
            ->where('state_offer_id', '2')
            ->get(['id', 'program_id']);

        return response()->json(['program' => $program]);
    }

    public function show($id)
    {
        $student = Student::with('person:id,first_name,last_name')
            ->where('offer_id', $id)
            ->get(['id', 'person_id', 'code']);

        return response()->json([
            'student' => $student,
        ]);
    }

    public function showPerson($id)
    {
        $student = Student::with([
            'offer' => [
                'modality',
                'program:id,name'
            ],
            'semester',
            'person' => [
                'district',
                'role'
            ],

        ])->where('id', $id)
        ->get()->first();

        return view('admin.usersDetail.UserDetail', [
            'person' => $student->person,
            'district' => $student->person->district,
            'role' => $student->person->role,
            'student' => $student,
            'modality' => $student->offer->modality,
            'program' => $student->offer->program
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
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $url);


        $person = person::find($id);

        $person->update([
            'number_document' => $request->document,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'district_id' => $request->district,
            'image' => $url,
            'email' => $request->mail,
            'phone' => $request->phone,
        ]);

        return  redirect()->route('student.index');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return  redirect()->route('student.index');
    }
}
