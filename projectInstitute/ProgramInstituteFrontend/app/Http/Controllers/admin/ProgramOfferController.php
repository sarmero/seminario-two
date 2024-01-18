<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modality;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProgramOfferController extends Controller
{
    private $modality;

    public function __construct()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/modality');
        $this->modality = json_decode(json_encode($response->json("data")));
    }

    public function index()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/offer-program');
        $offer = json_decode(json_encode($response->json("data")));

        return view('admin.offerProgram.AdminOfferProgram', ['offer' => $offer]);
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/program');
        $program = json_decode(json_encode($response->json("data")));

        return view(
            'admin.offerProgram.CreateOfferProgram',
            ['program' => $program, 'modality' => $this->modality]
        );
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/offer-program/'.$id);
        $offer = json_decode(json_encode($response->json("data")));

        return view(
            'admin.offerProgram.EditOfferProgram',
            ['modality' => $this->modality, 'offer' => $offer]
        );
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'program' => 'required',
            'quotas' => 'required|integer|between:5,200',
            'modality' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/offer-program', [
            'quotas' => $request->quotas,
            'program' => $request->program,
            'modality' => $request->modality,
        ]);
        $data = $response->json();

        return redirect()->route('offer-program.index');
    }

    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'quotas' => 'required|integer|between:1,200',
            'modality' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/offer-program/'.$id, [
            'modality' => $request->modality,
            'quotas' => $request->quotas,
        ]);
        $data = $response->json();

        return redirect()->route('offer-program.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/v1/offer-program/'.$id);
        $data = $response->json();

        return redirect()->route('offer-program.index');
    }
}
