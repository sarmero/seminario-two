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
        $modality = Modality::get();
        return view('admin.programRegister', ['modality' => $modality]);
    }

    public function show()
    {
        $program = Program::select('program.id', 'program.name', 'program.description', DB::raw('COUNT(subject.id) as subject'))
            ->leftJoin('subject', 'program.id', '=', 'subject.program_id')
            ->groupBy('program.id', 'program.name', 'program.description')
            ->get();

        return view('admin.program', ['program' => $program]);
    }

    public function store(Request $request)
    {
        $validador = FacadesValidator::make($request->all(), [
            'name' => 'required|unique:program,name|alpha|max:200',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $program = new Program();
        $program->name = $request->input('program');
        $program->description = $request->input('description');


        if ($request->hasFile('imag')) {
            $file = $request->file('imag');
            $path = $file->store('public/image/program');
            $url = Storage::url($path);
            $program->image = $url;
        }

        $program->save();

        return redirect()->route('admin.program');
    }

    public function update(Request $request, $id)
    {
        $program = Program::find($id);
        $program->name = $request->input('program');
        $program->description = $request->input('description');

        if ($request->hasFile('imag')) {
            $file = $request->file('imag');
            $path = $file->store('public/image/program');
            $url = Storage::url($path);

            if ($program->image != null) {
                Storage::delete($program->image);
            }

            $program->image = $url;
        }

        $program->save();
        return redirect()->route('admin.program');
    }

    public function delete(Request $request, $id)
    {
        var_dump($request);

        $program = Program::find($id);

        if ($program->image != null) {
            Storage::delete($program->image);
        }

        Program::destroy($id);

        return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    }
}
