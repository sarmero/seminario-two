<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Calendar;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\District;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PreinscriptionController extends Controller
{

    public function index()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/district');
        $district = json_decode(json_encode($response->json("data")));

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/preinscription');
        $program = json_decode(json_encode($response->json("data")));


        return view('start.Preinscription', ['district' => $district], ['program' => $program]);
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
        $response = Http::post($url . '/v1/preinscription', [
            'document' => $request->document,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'gender' => $request->gender,
            'district' => $request->district,
            'image' => $urlx,
            'email' => $request->mail,
            'phone' => $request->phone,
        ]);

        $person = $response->json();

        return  redirect()->route('home');
    }
}
