<?php

namespace App\Http\Controllers\v1\session;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\SubjectOfferResource;
use App\Models\Activity;
use App\Models\OfferSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivityController extends Controller
{

    /**
     * Display a listing of the resource.
     */

     public function index(){

     }

    public function getActivityStudent($id)
    {
        $activity = Activity::whereHas('offerSubject.inscriptionSubject', function ($query) use ($id) {
            $query->where('student_id', $id);
        })
            ->orderBy("deadline", "asc")
            ->get(['id', 'description', 'deadline']);

        return ActivityResource::collection($activity);
    }


    public function getActivityTeacher($id)
    {
        $activity = Activity::whereHas('offerSubject', function ($query) use ($id) {
            $query->where('teacher_id', $id);
        })
            ->orderBy("deadline", "asc")
            ->get(['id', 'description', 'deadline']);

        return ActivityResource::collection($activity);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $activity = new Activity();
        $activity->description = $request->input('description');
        $activity->offer_subject_id = $request->input('subject');
        $activity->deadline = $request->input('deadline');
        $activity->save();

        return response()->json([
            'message' => 'Los datos de actividad registrados',
            'data' => $activity
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activity::whereHas('offerSubject', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        return ActivityResource::collection($activity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $activity = Activity::find($id);
        $activity->description = $request->input('description');
        $activity->deadline = $request->input('deadline');
        $activity->update();

        return response()->json([
            'message' => 'Los datos de actividad modificados',
            'data' => $activity
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Activity::destroy($id);

        return response()->json([
            'message' => 'Los datos de la Actividad eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
