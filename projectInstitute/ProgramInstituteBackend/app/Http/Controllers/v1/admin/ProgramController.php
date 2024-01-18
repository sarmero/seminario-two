<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    public function __construct()
    {
        // $this ->middleware('auth.sanctum')->only(['store','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = Program::get();
        return ProgramResource::collection($program);
    }

    public function getProgram()
    {
        $program =  Program::withCount('subject')->get(['id', 'name']);
        return $program;
    }

    public function getProgramId($id)
    {
        $program = Program::where('id', $id)->get()->first();
        return new ProgramResource($program);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $program = new Program();
        $program->name = $request->input('name');
        $program->description = $request->input('description');
        $program->image = $request->input('image');

        $program->save();

        return response()->json([
            'message' => 'Los datos de programa registrados',
            'data' => $program
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $program = Program::find($id);
        return new ProgramResource($program);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $program = Program::find($id);
        $program->name = $request->input('name');
        $program->description = $request->input('description');
        $program->image = $request->input('image');

        $program->update();

        return response()->json([
            'message' => 'Los datos de programa modificados',
            'data' => $program
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Program::destroy($id);

        return response()->json([
            'message' => 'Los datos de la program eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
