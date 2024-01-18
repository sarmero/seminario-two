<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    private $program;
    private $semester;

    public function __construct()
    {

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/subject');
        $this->program = json_decode(json_encode($response->json("data")));

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/semester');
        $this->semester = json_decode(json_encode($response->json("data")));
    }

    public function index()
    {
        return view('admin.subject.AdminSubject', ['program' => $this->program]);
    }

    public function create()
    {
        return view('admin.subject.CreateSubject', ['program' => $this->program, 'semester' => $this->semester]);
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/subject/subject/'.$id);
        $subject = json_decode(json_encode($response->json("data")));

        return view('admin.subject.EditSubject', ['subject' => $subject, 'program' => $this->program, 'semester' => $this->semester]);
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/subject/'.$id);
        $subject = json_decode(json_encode($response->json("data")));

        return response()->json(['subject' => $subject]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'program' => 'required',
            'semester' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/subject' ,[
            'subject' => $request->subject,
            'program' => $request->program,
            'semester' => $request->semester,
        ]);

        $data = $response->json();

        return redirect()->route('subject.index');
    }

    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'program' => 'required',
            'semester' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/subject/' . $id,[
            'subject' => $request->subject,
            'program' => $request->program,
            'semester' => $request->semester,
        ]);

        $data = $response->json();


        return redirect()->route('subject.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/subject/' . $id);
        $data = $response->json();

        return redirect()->route('subject.index');
    }
}
