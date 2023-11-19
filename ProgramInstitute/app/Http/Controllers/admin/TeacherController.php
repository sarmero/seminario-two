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

class TeacherController extends Controller
{
    public function index()
    {
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {

                $program = Program::select('program.id', 'program.name')
                ->orderBy('name', 'desc')->get();
                $district = district::get();

                return view('admin.teacherRegister',['program' => $program,'district' => $district]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function teacher(Request $request)
    {
        $pro = $request->input('program');

        $teacher = Teacher::select('person.id', 'person.first_name', 'person.last_name', 'teacher.id as teacher')
            ->join('person', 'person.id', '=', 'teacher.person_id')
            ->where('program_id', $pro)
            ->orderBy('person.first_name', 'asc')
            ->get();

        $program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();

        $nameProgram = Program::where('id', $pro)
            ->select('program.name')
            ->get()
            ->first();

        return view('admin.teacher', ['program' => $program, 'teacher' => $teacher, 'name' => $nameProgram]);
    }

    public function show()
    {
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {
                $program = Program::select('program.id', 'program.name')
                ->orderBy('name', 'desc')
                ->get();
                return view('admin.teacher',['program' => $program]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
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
        $person->role_id = 3;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('public/image/profile/users');
            $url = Storage::url($path);
            $person->photo = $url;
        }

        $user = new User();
        $user->

        // $user->password = bcrypt($request->input('password'));
        //<img src="data:image/jpeg;base64,{{ base64_encode($persona->foto) }}" alt="Foto de la persona">

        $person->save();

        $teacher = new Teacher();
        $teacher ->person_id = $person->id;
        $teacher ->program_id = $request->input('program');
        $teacher ->save();


        return  redirect()->route('admin.teacher');
    }


    private function contact($phone, $mail)
    {
        $contact = new Contact();
        $contact->email = $mail;
        $contact->phone = $phone;
        $contact->save();
        return $contact->id;
    }

    public function showPerson($id)
    {
        $person =Teacher::select(
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

    public function delete(Request $request)
    {
    }
}
