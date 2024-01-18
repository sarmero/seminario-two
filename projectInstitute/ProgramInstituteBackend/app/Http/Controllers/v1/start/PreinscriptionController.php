<?php

namespace App\Http\Controllers\v1\start;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\PersonController;
use App\Http\Resources\ProgramOfferResource;
use App\Models\Admission;
use App\Models\Calendar;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PreinscriptionController extends Controller
{

    private $person;

    public function __construct()
    {
        $this->person = new PersonController();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cal = Calendar::latest('id')->first();
        $program = Offer::with('program:id,name')
        ->where('calendar_id', $cal->id)->where('state_offer_id', '1')
        ->get(['program_id','id']);

        return  ProgramOfferResource::collection($program);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $per = $this->person->create($request);
        $per->role_id = 4;
        $per->save();

        $admission = new Admission();
        $admission->state_id = 1;
        $admission->person_id = $per->id;
        $admission->offer_id = $request->input('program');;
        $admission->save();

        return response()->json([
            'message' => 'Los datos de inscripcion registrados',
            'data' => $admission
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
