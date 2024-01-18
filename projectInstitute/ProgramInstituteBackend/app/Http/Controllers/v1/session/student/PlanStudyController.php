<?php

namespace App\Http\Controllers\v1\session\student;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class PlanStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPlanStudy($id)
    {
        $subject = Subject::all()
            ->where('program_id',$id)
            ->groupBy('semester_id');

            return $subject;

        // return SubjectResource::collection($subject);
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
