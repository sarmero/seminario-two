<?php

namespace App\Http\Controllers\v1\session\student;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectOfferResource;
use App\Http\Resources\SubjectResource;
use App\Models\InscriptionSubject;
use App\Models\OfferSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OfferController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function getOfferSubject($pro, $sem,$std)
    {
        $offer = OfferSubject::with(
            'subject:id,description'
        )->withCount(['inscriptionSubject as registered' => function ($query) use ($std) {
            $query->where('student_id', $std);
        }])->whereHas('subject', function ($query) use($pro, $sem) {
            $query->where('program_id', '=', $pro)
            ->where('semester_id', '<=',$sem);
        })
            ->has('inscriptionSubject', '<', 1)
            ->get();

       return SubjectOfferResource::collection($offer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ins = new InscriptionSubject();
        $ins->offer_subject_id = $request->input('id');
        $ins->student_id = session('student');

        $ins->save();

        return response()->json([
            'message' => 'Los datos de inscripcion registrados',
            'data' => $ins
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
