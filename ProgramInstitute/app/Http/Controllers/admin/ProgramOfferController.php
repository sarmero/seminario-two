<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modality;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProgramOfferController extends Controller
{
    private $modality;

    public function __construct()
    {
        $this->modality = Modality::get();
    }

    public function index()
    {
        $offer = Offer::select('offer.id', 'offer.code', 'program.name', 'modality.description as modality', 'offer.quotas')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->join('modality', 'offer.modality_id', '=', 'modality.id')
            ->where('offer.calendar_id', session('calendar'))
            ->get();

        return view('admin.offerProgram.AdminOfferProgram', ['offer' => $offer]);
    }

    public function create()
    {
        $program = Program::select('program.id', 'program.name')
            ->orderBy('program.name', 'desc')
            ->get();

        return view(
            'admin.offerProgram.CreateOfferProgram',
            ['program' => $program, 'modality' => $this->modality]
        );
    }

    public function edit($id)
    {
        $offer = Offer::select('offer.id', 'offer.code', 'program.name', 'offer.quotas')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('offer.id', $id)
            ->get()
            ->first();

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

        $code = '678' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        while (Offer::where('code', $code)->exists()) {
            $code = '678' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        Offer::create([
            'code' => $code,
            'quotas' => $request->quotas,
            'calendar_id' => session('calendar'),
            'program_id' => $request->program,
            'modality_id' => $request->modality,
            'state_offer_id' => 1,
        ]);

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

        $offer = Offer::find($id);
        $offer->update([
            'modality_id' => $request->modality,
            'quotas' => $request->quotas,
        ]);

        return redirect()->route('offer-program.index');
    }

    public function destroy($id)
    {
        Offer::destroy($id);
        return redirect()->route('offer-program.index');
    }
}
