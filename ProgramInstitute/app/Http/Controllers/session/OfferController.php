<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\OfferSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{
    public function index()
    {
        if (Session::has('session')) {
            if (session('session')) {

                session(['page' => 'Ofertas']);
                $inscription = session('inscription');

                $offer = Subject::select('subject.description', 'offer_subject.quotas')
                    ->join('offer_subject', 'subject.id', '=', 'offer_subject.subject_id')
                    ->leftJoin('inscription_subject', function ($join) use ($inscription) {
                        $join->on('offer_subject.id', '=', 'inscription_subject.offer_subject_id')
                            ->where('inscription_subject.inscription_id', '=', $inscription);
                    })
                    ->whereNull('inscription_subject.id')
                    ->selectRaw('COUNT(inscription_subject.id) as registered')
                    ->groupBy('subject.id', 'subject.description', 'offer_subject.quotas')
                    ->get();

                return view('session.offer', ['offer' => $offer]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }
}
