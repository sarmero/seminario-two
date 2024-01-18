<?php

namespace App\Http\Controllers\v1\session\student;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingsResource;
use App\Http\Resources\SemesterResource;
use App\Models\InscriptionSubject;
use App\Models\Semester;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semester = Semester::get();
        return SemesterResource::collection($semester);
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
    public function getRatings($id, $std)
    {
        $subject = InscriptionSubject::with([
            'offerSubject:id,subject_id,teacher_id' => [
                'subject:id,description,semester_id',
                'teacher:id,person_id' => [
                    'person:id,first_name,last_name'
                ]
            ]
        ])->whereHas('offerSubject.subject', function ($query) use ($id) {
            $query->where('semester_id', '=', $id);
        })->whereHas('student', function ($query) use ($std) {
            $query->where('id', '=', $std);
        })->get();

        return RatingsResource::collection($subject);
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
