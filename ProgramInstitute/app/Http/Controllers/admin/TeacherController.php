<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\district;
use App\Models\person;
use App\Models\Program;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    private $program;
    private  $district;

    public function __construct()
    {
        $this->program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')->get();

        $this->district = district::get();
    }


    public function index()
    {
        return view('admin.teacher.AdminTeacher', ['program' => $this->program]);
    }

    public function create()
    {
        return view('admin.teacher.CreateTeacher', ['program' => $this->program, 'district' => $this->district]);
    }

    public function edit($id)
    {
        $teacher = Teacher::select('person.*','teacher.id as idt','teacher.program_id','contact.email','contact.phone')
        ->join('person', 'person.id', '=', 'teacher.person_id')
        ->join('contact', 'person.contact_id', '=', 'contact.id')
        ->where('teacher.id', $id)
        ->get()
        ->first();

        return view('admin.teacher.EditTeacher', ['teacher' => $teacher,'program' => $this->program, 'district' => $this->district]);
    }

    public function show($id)
    {
        $teacher = Teacher::select('person.id as idp', 'person.first_name', 'person.last_name', 'teacher.id','teacher.code')
            ->join('person', 'person.id', '=', 'teacher.person_id')
            ->where('program_id', $id)
            ->orderBy('person.first_name', 'asc')
            ->get();

        $nameProgram = Program::where('id', $id)
            ->select('program.name')
            ->get()
            ->first();

        return response()->json(['teacher' => $teacher, 'name' => $nameProgram]);
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

        Teacher::create([
            'program_id' => $request->program,
            'person_id' => $person->id,
        ]);


        return  redirect()->route('teacher.index');
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

        $teacher = Teacher::find($id);
        $person = person::find($teacher->person_id);
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

        $teacher->update([
            'program_id' => $request->program,
        ]);


        return  redirect()->route('teacher.index');
    }


    public function showPerson($id)
    {
        $person = Teacher::select(
            'person.*',
            'role.description as role',
            'program.name',
            'district.description as district',
            'contact.*',
        )
            ->join('person', 'teacher.person_id', '=', 'person.id')
            ->join('contact', 'person.contact_id', '=', 'contact.id')
            ->join('role', 'person.role_id', '=', 'role.id')
            ->join('district', 'person.district_id', '=', 'district.id')
            ->join('program', 'teacher.program_id', '=', 'program.id')
            ->where('teacher.person_id', $id)
            ->get()
            ->first();

        return view('admin.usersDetail.UserDetail', ['person' => $person]);
    }

    public function destroy($id)
    {
        Teacher::destroy($id);
        return  redirect()->route('teacher.index');
    }
}

