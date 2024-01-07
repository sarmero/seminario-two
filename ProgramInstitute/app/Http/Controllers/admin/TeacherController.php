<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Contact;
use App\Models\district;
use App\Models\person;
use App\Models\Program;
use App\Models\Student;
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
        $this->program = Program::orderBy('name', 'desc')->get(['id', 'name']);
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
        $teacher = person::with('teacher', 'contact')
            ->whereHas('teacher', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get()
            ->first();

        return view('admin.teacher.EditTeacher', ['teacher' => $teacher, 'program' => $this->program, 'district' => $this->district]);
    }

    public function show($id)
    {
        $teacher = person::with('teacher')
            ->whereHas('teacher', function ($query) use ($id) {
                $query->where('program_id', $id);
            })
            ->get();


        $nameProgram = Program::where('id', $id)
            ->get(['name'])
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
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $url);

        $teacher = Teacher::find($id);
        $person = person::find($teacher->person_id);

        $person->update([
            'document' => $request->document,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'district_id' => $request->district,
            'image' => $url,
            'email' => $request->mail,
            'phone' => $request->phone,
        ]);

        $teacher->update([
            'program_id' => $request->program,
        ]);


        return  redirect()->route('teacher.index');
    }


    public function showPerson($id)
    {
        $person = Teacher::with([
            'person' => [
                'district',
                'role'
            ],
            'program:id,name'

        ])->where('person_id', $id)->get()->first();

        return view('admin.usersDetail.UserDetail', [
            'person' => $person->person,
            'district' => $person->person->district,
            'role' => $person->person->role,
            'program' => $person->program
        ]);
    }

    public function destroy($id)
    {
        Teacher::destroy($id);
        return  redirect()->route('teacher.index');
    }
}
