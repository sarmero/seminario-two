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

        $code = '678' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        while (Offer::where('code', $code)->exists()) {
            $code = '678' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        Offer::create([
            'code' => $code,
            'quotas' => $request->quotas,
            'calendar_id' => $request->calendar,
            'program_id' => $request->program,
            'modality_id' => $request->modality,
            'state_offer_id' => 1,
        ]);

        return redirect()->route('admin.program.offer');
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::find($id);
        $offer->update([
            'modality_id' => $request->modality,
            'quotas' => $request->quotas,
        ]);

        return redirect()->route('admin.program.offer');
    }

    public function delete($id)
    {
        Offer::destroy($id);
        return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    }
}
