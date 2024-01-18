<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    private $program;
    private  $district;

    public function __construct()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/teacher');
        $this->program = json_decode(json_encode($response->json("data")));

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/district');
        $this->district = json_decode(json_encode($response->json("data")));

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
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/teacher/tea/'.$id);
        $teacher = json_decode(json_encode($response->json("data")));

        return view('admin.teacher.EditTeacher', ['teacher' => $teacher, 'program' => $this->program, 'district' => $this->district]);
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/teacher/'.$id);
        $teacher = json_decode(json_encode($response->json("data")));

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/program/programs/'.$id);
        $nameProgram = json_decode(json_encode($response->json("data")));

        return response()->json(['teacher' => $teacher, 'name' => $nameProgram]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'document' => 'required|integer|unique:person,document|min:10',
            'firstName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'lastName' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:3,200',
            'phone' => 'required|integer|min:10',
            'mail' => 'required|email|unique:person,email|max:200',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $urlx = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $urlx);

        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/teacher',[
            'document' => $request->document,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'gender' => $request->gender,
            'district' => $request->district,
            'image' => $urlx,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'program' => $request->program,
        ]);

        $data = $response->json();

        // var_dump($data);

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

        $urlx = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $urlx);

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/teacher/'.$id,[
            'document' => $request->document,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'gender' => $request->gender,
            'district' => $request->district,
            'image' => $urlx,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'program' => $request->program,
        ]);

        $data = $response->json();
        // var_dump($data);

        return  redirect()->route('teacher.index');
    }


    public function showPerson($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/teacher/person/'.$id);
        $person = json_decode(json_encode($response->json("data")));

        return view('admin.usersDetail.UserDetail', [
            'person' => $person->person,
            'district' => $person->person->district,
            'role' => $person->person->role,
            'program' => $person->program
        ]);
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/teacher/'.$id);
        $data = $response->json();

        return  redirect()->route('teacher.index');
    }
}
