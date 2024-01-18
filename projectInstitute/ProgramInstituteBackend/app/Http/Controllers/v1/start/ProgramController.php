<?php

namespace App\Http\Controllers\v1\start;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Models\Calendar;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cal = Calendar::latest('id')->first();

        $program = Program::with(['offer:id,program_id,state_offer_id' => ['stateOffer']])
        ->whereHas('offer',function ($query) use ($cal) {
            $query->where('calendar_id', $cal->id);
        })
        ->orderBy('name', 'asc')->get();

            // return  $program;
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
        $program = Program::with('subject:id,program_id,description')
            ->where('id', $id)
            ->first();

        return new ProgramResource($program);
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
