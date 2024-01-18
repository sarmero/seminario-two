<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\SubjectOfferResource;
use App\Http\Resources\SubjectResource;
use App\Http\Resources\TeacherResource;
use App\Models\Calendar;
use App\Models\OfferSubject;
use App\Models\person;
use App\Models\Program;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SubjectOfferController extends Controller
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
        $program = Program::orderBy('name', 'desc')
            ->get(['id', 'name']);

        return ProgramResource::collection($program);
    }

    public function getOfferTeacher($id)
    {
        $offer = OfferSubject::with(['subject:id,description,program_id', 'teacher'])
            ->where('id', $id)
            ->get(['id', 'quotas', 'subject_id', 'teacher_id'])
            ->first();

        $id = $offer->subject->program_id;

        $teacher = Teacher::with('person:id,first_name,last_name')->whereHas('person', function ($query) {
            $query->orderBy('first_name', 'asc');
        })
            ->where('program_id', $id)
            ->get();

        return [
            'teacher' => TeacherResource::collection($teacher),
            'offer' => new SubjectOfferResource($offer)
        ];
    }

    public function getSubjectTeacher($id)
    {
        $teacher = Teacher::with('person:id,first_name,last_name')
            ->whereHas('person', function ($query) use ($id) {
                $query->orderBy('first_name', 'asc');
            })->where('program_id', $id)->get();

        $subject = Subject::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('offer_subject')
                ->whereRaw('offer_subject.subject_id = subject.id');
        })
            ->where('subject.program_id', $id)
            ->orderBy('subject.description', 'asc')
            ->get(['id', 'description']);

        return [
            'subject' => SubjectResource::collection($subject),
            'teacher' => TeacherResource::collection($teacher)
        ];
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer = new OfferSubject();
        $offer->subject_id = $request->input('subject');
        $offer->quotas = $request->input('quotas');
        $offer->calendar_id =  $this->cal->id;
        $offer->teacher_id =  $request->input('teacher');

        $offer->save();

        return response()->json([
            'message' => 'Los datos de oferta de asignatura registrados',
            'data' => $offer
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $offer = OfferSubject::with([
            'subject:id,semester_id,description' => ['semester'],
            'teacher' => [
                'person:id,first_name,last_name'
            ]
        ])->whereHas('subject', function ($query) use ($id) {
            $query->where('program_id', $id);
        })
            ->where('calendar_id', $this->cal->id)
            ->get(['id', 'quotas', 'subject_id', 'teacher_id']);

        return SubjectOfferResource::collection($offer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $offer = OfferSubject::find($id);
        $offer->quotas = $request->input('quotas');
        $offer->teacher_id =  $request->input('teacher');

        $offer->update();

        return response()->json([
            'message' => 'Los datos de oferta de asignatura modificados',
            'data' => $offer
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        OfferSubject::destroy($id);

        return response()->json([
            'message' => 'Los datos de la oferta asignatura eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
