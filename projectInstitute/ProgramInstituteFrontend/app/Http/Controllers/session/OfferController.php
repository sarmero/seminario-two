<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\OfferSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OfferController extends Controller
{
    public function index()
    {
        session(['page' => 'Ofertas']);

        $url = env('URL_SERVER_API');
        $response = Http::get($url . '/v1/offer/pro/'.session('program_id').'/sem/'.session('semester').'/std/'.session('student_id'));
        $offer = json_decode(json_encode($response->json("data")));

        return view('session.student.OfferStudent', ['offer' => $offer]);
    }

    public function inscription(Request $request)
    {
        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/v1/offer', [
            'offer_subject_id' => $request->id,
            'student_id' => session('student_id'),
        ]);
        $inscription = $response->json();

        return response()->json(['mensaje' => 'Inscription realizada correctamente ']);
    }
}
