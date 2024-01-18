<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdmissionResource;
use App\Http\Resources\ProgramOfferResource;
use App\Http\Resources\ProgramResource;
use App\Models\Admission;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = Program::whereHas('offer', function ($query) {
            $query->where('state_offer_id', '1');
        })->orderBy('name', 'asc')->get(['id', 'name']);

        return ProgramResource::collection($program);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $approvedx = null;
        $rejectedx = null;
        $earringsx = null;

        $approved = $this->admissionData(1, $id);
        $earrings = $this->admissionData(2, $id);
        $rejected = $this->admissionData(3, $id);

        $nameProgram = Offer::with('program:id,name')
            ->where('program_id', $id)
            ->get(['id', 'quotas', 'program_id'])->first();

        $requests = Admission::whereHas('offer', function ($query) use ($id) {
            $query->where('program_id', $id);
        })->count();

        if ($approved != null) {
            $approvedx =  AdmissionResource::collection($approved);
        }

        if ($rejected != null) {
            $rejectedx =  AdmissionResource::collection($rejected);
        }

        if ($earrings != null) {
            $earringsx =  AdmissionResource::collection($earrings);
        }


        return [
            'name' => new ProgramOfferResource($nameProgram),
            'approved' =>  $approvedx,
            'rejected' => $rejectedx,
            'earrings' => $earringsx,
            'requests' => $requests
        ];
    }

    private function admissionData($state, $pro)
    {
        return  Admission::with([
            'person:id,first_name,last_name'
        ])->whereHas('offer',function ($query) use ($pro) {
                $query->where('program_id',$pro);
            }
        )->where('state_id', $state)
            ->get(['id','person_id','offer_id','state_id']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admission = Admission::find($id);
        $admission->state_id = $request->input('state');
        $admission->update();

        return response()->json([
            'message' => 'Los datos de admicion modificados',
            'data' => $admission
        ], Response::HTTP_ACCEPTED);
    }

    public function showPerson($id)
    {
        $per = Admission::with([
            'offer:id,code,modality_id,program_id' => [
                'modality',
                'program:id,name'
            ],
            'person' => [
                'district',
                'role'
            ],
            'state'
        ])->where('id', $id)->get()->first();

        return new AdmissionResource($per);
    }

    public function closeOffer($id)
    {
        $offer = Offer::find($id);
        $offer->update([
            'state_offer_id' => 2,
        ]);

        return response()->json([
            'message' => 'La oferta del programa sea cerrado',
            'data' => $offer
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admission::destroy($id);

        return response()->json([
            'message' => 'Los datos de la admicion eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
