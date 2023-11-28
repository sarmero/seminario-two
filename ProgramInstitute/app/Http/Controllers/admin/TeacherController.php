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

    public function __construct()
    {
        $this->program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')->get();
    }


    public function index()
    {
        $district = district::get();
        return view('admin.teacherRegister', ['program' => $this->program, 'district' => $district]);
    }

    public function teacher(Request $request)
    {
        $pro = $request->input('program');

        $teacher = Teacher::select('person.id', 'person.first_name', 'person.last_name', 'teacher.id as teacher')
            ->join('person', 'person.id', '=', 'teacher.person_id')
            ->where('program_id', $pro)
            ->orderBy('person.first_name', 'asc')
            ->get();

        $nameProgram = Program::where('id', $pro)
            ->select('program.name')
            ->get()
            ->first();

        return view('admin.teacher', ['program' => $this->program, 'teacher' => $teacher, 'name' => $nameProgram]);
    }

    public function show()
    {
        return view('admin.teacher', ['program' => $this->program]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'document' => 'required|unique:person,number_document|max:10',
            'firstName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'lastName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'phone' => 'required|max:10',
            'mail' => 'required|email|unique:contact,email|max:200',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/profile'), $url);

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


        return  redirect()->route('admin.teacher');
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

        return view('admin.userDetail', ['person' => $person]);
    }

    public function delete($id)
    {
        Teacher::destroy($id);
        return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    }
}


// $user->password = bcrypt($request->input('password'));
        //<img src="data:image/jpeg;base64,{{ base64_encode($persona->foto) }}" alt="Foto de la persona">

        // if ($request->hasFile('photo')) {
        //     $imageName = time() . '.' . $request->image->extension();
        //     $file = $request->file('photo');
        //     $path = $file->store('public/image/profile/users');
        //     $url = Storage::url($path);
        // }
