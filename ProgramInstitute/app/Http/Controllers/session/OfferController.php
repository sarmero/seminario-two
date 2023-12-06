<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\InscriptionSubject;
use App\Models\OfferSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    public function index()
    {
        session(['page' => 'Ofertas']);
        $inscription = session('inscription');

        $offer = Subject::select('subject.description', 'offer_subject.quotas', 'offer_subject.id')
            ->join('offer_subject', 'subject.id', '=', 'offer_subject.subject_id')
            ->leftJoin('inscription_subject', function ($join) use ($inscription) {
                $join->on('offer_subject.id', '=', 'inscription_subject.offer_subject_id')
                    ->where('inscription_subject.inscription_id', '=', $inscription);
            })
            ->whereNull('inscription_subject.id')
            ->selectRaw('COUNT(inscription_subject.id) as registered')
            ->groupBy('subject.id', 'subject.description', 'offer_subject.quotas', 'offer_subject.id')
            ->get();

        return view('session.offer', ['offer' => $offer]);
    }

    public function inscrition(Request $request)
    {
        $id = $request->input('id');

        $ins = new InscriptionSubject();
        $ins->offer_subject_id = $id;
        $ins->inscription_id = session('inscription');

        $ins->save();

        return response()->json(['mensaje' => 'Inscription realizada correctamente ']);
    }
}
