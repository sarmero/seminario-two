<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\PersonController;
use App\Http\Resources\PersonResource;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\TeacherResource;
use App\Models\person;
use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeacherController extends Controller
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
        $program = Program::orderBy('name', 'asc')
            ->get(['id', 'name']);

        return ProgramResource::collection($program);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $per = $this->person->create($request);
        $per->role_id = 3;
        $per->save();

        $teacher = new Teacher();
        $teacher->person_id = $per->id;
        $teacher->program_id = $request->input('program');
        $teacher->save();

        return response()->json([
            'message' => 'Los datos de docente registrado',
            'data' => $teacher,
            'per' => $per
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::with('person:id,first_name,last_name')
            ->where('program_id', $id)
            ->get();

        return TeacherResource::collection($teacher);
    }

    public function getTeacherId($id)
    {
        $teacher = Teacher::with(['person'=>['district'],'program:id,name'])
            ->where('id', $id)
            ->get()->first();

        return new TeacherResource($teacher);
    }

    public function showPerson($id)
    {
        $person = Teacher::with([
            'person' => [
                'district',
                'role'
            ],
            'program:id,name'

        ])->where('person_id', $id)->get()->first();

        return new TeacherResource($person);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::find($id);
        $teacher->program_id = $request->input('program');
        $teacher->update();

        $per = $this->person->edit($request, $teacher->person_id);
        $per->update();

        return response()->json([
            'message' => 'Los datos de docente modificados',
            'data' => $teacher,
            'per' => $per
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teacher::destroy($id);

        return response()->json([
            'message' => 'Los datos de la docente eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
