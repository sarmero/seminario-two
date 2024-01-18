<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class SubjectOfferController extends Controller
{
    private $program;
    public function __construct()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/subject');
        $this->program = json_decode(json_encode($response->json("data")));
    }

    public function index()
    {
        return view('admin.offerSubject.AdminOfferSubject', ['program' => $this->program]);
    }

    public function create()
    {
        return view('admin.offerSubject.CreateOfferSubject', ['program' => $this->program]);
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/offer-subject/teacher/'.$id);
        $data = $response->json();

        $teacher = json_decode(json_encode($data['teacher']));
        $offer = json_decode(json_encode($data['offer']));

        return view('admin.offerSubject.EditOfferSubject', ['teacher' => $teacher, 'offer' => $offer]);
    }


    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/offer-subject/'.$id);
        $offer =json_decode(json_encode($response->json("data")));

        return response()->json(['offer' => $offer]);
    }

    public function getSubjectTeacher($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/offer-subject/subject/'.$id);
        $data = $response->json();

        $teacher = json_decode(json_encode($data['teacher']));
        $subject = json_decode(json_encode($data['subject']));

        return response()->json(['subject' => $subject, 'teacher' => $teacher]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required',
            'quotas' => 'required|integer|between:5,200',
            'teacher' => 'required',
        ]);


        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/offer-subject',[
            'subject' => $request->subject,
            'quotas' => $request->quotas,
            'teacher' => $request->teacher,
        ]);

        $data = $response->json();

        return redirect()->route('offer-subject.index');
    }

    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'quotas' => 'required|integer|between:5,200',
            'teacher' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/offer-subject/'.$id ,[
            'quotas' => $request->quotas,
            'teacher' => $request->teacher,
        ]);

        $data = $response->json();

        return redirect()->route('offer-subject.index');
    }


    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/offer-subject/'.$id);
        $data = $response->json();

        return redirect()->route('offer-subject.index');
    }
}
