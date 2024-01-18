<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramOfferResource;
use App\Models\Calendar;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramOfferController extends Controller
{
    private $cal;
    public function __construct()
    {
        // $this ->middleware('auth.sanctum');
        $this->cal = Calendar::latest('id')->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $offer = Offer::with('program', 'modality')
            ->where('calendar_id',  $this->cal->id)->get();

        return ProgramOfferResource::collection($offer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $code = '678' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        while (Offer::where('code', $code)->exists()) {
            $code = '678' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        $offer = new Offer();
        $offer->code = $code;
        $offer->quotas = $request->input('quotas');
        $offer->state_offer_id = 1;
        $offer->modality_id = $request->input('modality');
        $offer->calendar_id = $this->cal->id;
        $offer->program_id = $request->input('program');

        $offer->save();

        return response()->json([
            'message' => 'Los datos de la oferta registrados',
            'data' => $offer
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = Offer::with('program:id,name')
            ->where('id', $id)
            ->get()
            ->first();

        return new ProgramOfferResource($offer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $offer = Offer::find($id);
        $offer->quotas = $request->input('quotas');
        $offer->modality_id = $request->input('modality');
        $offer->save();

        return response()->json([
            'message' => 'Los datos de la oferta modificados',
            'data' => $offer
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Offer::destroy($id);

        return response()->json([
            'message' => 'Los datos de la oferta eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
