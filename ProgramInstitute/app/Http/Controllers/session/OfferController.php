<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\OfferSubject;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        session(['page' => 'Ofertas']);
        $inscription = session('inscription');

        $offer = OfferSubject::with(
            'subject:id,description'
        )->withCount(['inscriptionSubject as registered' => function ($query) use ($inscription) {
            $query->where('inscription_id', $inscription);
        }])->whereHas('subject', function ($query) {
            $query->where('program_id', '=', session('program_id'))
            ->where('semester_id', '<=', session('semester'));
        })
            ->has('inscriptionSubject', '<', 1)
            ->get();

        return view('session.student.OfferStudent', ['offer' => $offer]);
    }

    public function inscription(Request $request)
    {
        InscriptionSubject::create([
            'offer_subject_id' => $request->id,
            'inscription_id' => session('inscription'),
        ]);

        return response()->json(['mensaje' => 'Inscription realizada correctamente ']);
    }
}
