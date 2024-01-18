<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdmissionController extends Controller
{
    private $program;

    public function __construct()
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/admission');
        $this->program = json_decode(json_encode($response->json("data")));
    }

    public function index()
    {
        return view('admin.admission.AdminAdmission', ['program' => $this->program]);
    }


    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/admission/' . $id);
        $data = $response->json();

        return response()->json([
            'program' => $this->program,
            'name' => json_decode(json_encode($data['name'])),
            'approved' => json_decode(json_encode($data['approved'])),
            'rejected' => json_decode(json_encode($data['rejected'])),
            'earrings' => json_decode(json_encode($data['earrings'])),
            'requests' => json_decode(json_encode($data['requests'])),
        ]);
    }

    public function update(Request $request, $id,)
    {
        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/v1/admission/' . $id, $request);
        $data = $response->json();

        return response()->json(['message' => $data['message']]);
    }

    public function showPerson($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/admission/person/' . $id);
        $data = json_decode(json_encode($response->json("data")));

        return view('admin.usersDetail.UserDetail', [
            'person' => $data->person,
            'district' => $data->person->district,
            'role' => $data->person->role,
            'state' => $data->state,
            'modality' => $data->offer->modality,
            'program' => $data->offer->program
        ]);
    }

    public function closeOffer($id)
    {
        // $offer = Offer::find($id);
        // $offer->update([
        //     'state_offer_id' => 2,
        // ]);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/admission/close/' . $id);
        $data = $response->json();

        return response()->json(['mensaje' =>  $data['message']]);
    }
}
