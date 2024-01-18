<?php

namespace App\Http\Controllers\v1\session\teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingsResource;
use App\Models\InscriptionSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $student = InscriptionSubject::with('student.person:id,first_name,last_name'
        )->whereHas('offerSubject', function($query) use($id){
            $query->where('id',$id);
        })
        ->get(['id','note','student_id']);

        return RatingsResource::collection($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ins = InscriptionSubject::find($id);
        $ins->note = $request->input('note');
        $ins->update();

        return response()->json([
            'message' => 'Los datos de calificacion modificados',
            'data' => $ins
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
