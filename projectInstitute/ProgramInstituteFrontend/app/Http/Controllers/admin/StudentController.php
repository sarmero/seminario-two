<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/calendar');
        $calendar = json_decode(json_encode($response->json("data")));

        return view('admin.student.AdminStudent', ['calendar' => $calendar]);
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/district');
        $district = json_decode(json_encode($response->json("data")));

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/student/person/' . $id);
        $student = json_decode(json_encode($response->json("data")));

        // echo $student;

        return view('admin.student.EditStudent', [
            'student' => $student->id,
            'person' => $student->person,
            'district' => $district
        ]);
    }

    public function getPrograms($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/student/program/' . $id);
        $program = json_decode(json_encode($response->json("data")));

        return response()->json(['program' => $program]);
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/student/' . $id);
        $student = json_decode(json_encode($response->json("data")));

        return response()->json([
            'student' => $student,
        ]);
    }

    public function showPerson($id)
    {

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/student/person/' . $id);
        $student = json_decode(json_encode($response->json("data")));

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
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $urlx = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('storage/profile'), $urlx);

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/student/' . $id,[
            'document' => $request->document,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'gender' => $request->gender,
            'district' => $request->district,
            'image' => $urlx,
            'mail' => $request->mail,
            'phone' => $request->phone,
        ]);

        $data = $response->json();

        // var_dump($data);

        return  redirect()->route('student.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/student/'.$id);
        $data = $response->json();

        return  redirect()->route('student.index');
    }
}
