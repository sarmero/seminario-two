<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modality;
use App\Models\Offer;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;
use Validator;

class ProgramController extends Controller
{
    public function index()
    {
        $program = Program::select('program.id', 'program.name', 'program.description', DB::raw('COUNT(subject.id) as subject'))
            ->leftJoin('subject', 'program.id', '=', 'subject.program_id')
            ->groupBy('program.id', 'program.name', 'program.description')
            ->get();

        return view('admin.program.AdminProgram', ['program' => $program]);
    }

    public function create()
    {
        return view('admin.program.CreateProgram');
    }

    public function edit(Program $program)
    {
        return view('admin.program.EditProgram', ['program' => $program]);
    }

    public function store(Request $request)
    {
        $validador = FacadesValidator::make($request->all(), [
            'program' => 'required|unique:program,name|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'description' => 'required|regex:/^(\s*\S.*\s*)*$/|min:10',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/program'), $url);


        Program::create([
            'name' => $request->program,
            'description' => $request->description,
            'image' => $url,
        ]);

        return redirect()->route('admin/program.index');
    }

    public function update(Request $request, Program $program)
    {
        $validador = FacadesValidator::make($request->all(), [
            'program' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'description' => 'required|regex:/^(\s*\S.*\s*)*$/|min:10',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2040',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $url = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/program'), $url);

        $program->update([
            'name' => $request->program,
            'description' => $request->description,
            'image' => $url,
        ]);

        return redirect()->route('program.index');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index');
    }


}

// if ($program->image != null) {
//     Storage::delete($program->image);
// }

// public function delete(Request $request, $id)
    // {

    //     $program = Program::find($id);

    //     if ($program->image != null) {
    //         Storage::delete($program->image);
    //     }

    //     Program::destroy($id);

    //     return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    // }
