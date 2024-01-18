<?php

namespace App\Http\Controllers\v1\session\teacher;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectOfferResource;
use App\Http\Resources\SubjectResource;
use App\Models\Calendar;
use App\Models\OfferSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class ChairsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function getSubject($tea)
    {
        $cal = Calendar::latest('id')->first();
        $subject = OfferSubject::with('subject:id,description')
            ->where('teacher_id', $tea)
            ->where('calendar_id', $cal->id)
            ->get(['id', 'subject_id']);

        return SubjectOfferResource::collection($subject);
    }

    public function getSubjectTeacher($tea)
    {
        $cal = Calendar::latest('id')->first();
        $chairs = Subject::whereHas('offerSubject', function ($query) use ($cal, $tea) {
            $query->where('teacher_id', $tea)->where('calendar_id', $cal->id);
        })
        ->get(['id', 'description','semester_id']);

        return SubjectResource::collection($chairs);
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
