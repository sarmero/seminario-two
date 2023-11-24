<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modality;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProgramOfferController extends Controller
{
    public function index()
    {
        $program = Program::select('program.id', 'program.name')
            ->orderBy('program.name', 'desc')
            ->get();

        $offer = Offer::select('offer.id', 'offer.code', 'program.name', 'modality.description as modality', 'offer.quotas')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->join('modality', 'offer.modality_id', '=', 'modality.id')
            ->where('offer.calendar_id', session('calendar'))
            ->get();

        $modality = Modality::get();

        return view('admin.programOffer', ['program' => $program, 'modality' => $modality, 'offer' => $offer]);
    }

    public function store(Request $request)
    {
        $offer = new Offer();
        $offer->program_id = $request->input('program');
        $offer->code = uniqid();
        $offer->quotas = $request->input('quotas');
        $offer->modality_id = $request->input('modality');
        $offer->calendar_id =  session('calendar');
        $offer->state_offer_id = 1;

        $offer->save();

        return redirect()->route('admin.program.offer');
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->quotas = $request->input('quotas');
        $offer->modality_id = $request->input('modality');
        $offer->save();

        return redirect()->route('admin.program.offer');
    }

    public function delete($id)
    {
        Offer::destroy($id);
        return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    }
}
