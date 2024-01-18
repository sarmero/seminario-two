<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\SubjectResource;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = Program::orderBy('name', 'desc')
            ->get(['id', 'name']);

        return ProgramResource::collection($program);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->description = $request->input('subject');
        $subject->program_id = $request->input('program');
        $subject->semester_id = $request->input('semester');
        $subject->save();

        return response()->json([
            'message' => 'Los datos de asignatura registrados',
            'data' => $subject
        ], Response::HTTP_ACCEPTED);
    }

    public function getSubject($id){
        $subject = Subject::with(['program:id,name','semester'])->where('id',$id)->first();
        return new  SubjectResource($subject);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::with('semester')->where('program_id', $id)
            ->orderBy('semester_id', 'asc')
            ->orderBy('description', 'asc')
            ->get();

        return SubjectResource::collection($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::find($id);
        $subject->description = $request->input('subject');
        $subject->program_id = $request->input('program');
        $subject->semester_id = $request->input('semester');
        $subject->save();

        return response()->json([
            'message' => 'Los datos de asignatura modificados',
            'data' => $subject
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::destroy($id);

        return response()->json([
            'message' => 'Los datos de la asignatura eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
