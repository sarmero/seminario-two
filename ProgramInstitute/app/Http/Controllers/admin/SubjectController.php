<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        $program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();

        $semester = Semester::get();

        return view('admin.subjectRegister', ['program' => $program, 'semester' => $semester]);
    }

    public function show()
    {
        $semester = Semester::get();
        $program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();

        return view('admin.Subject', ['program' => $program, 'semester' => $semester]);
    }

    public function subject(Request $request)
    {
        $pro = $request->input('program');
        $semester = Semester::get();

        $subject = Subject::where('program_id', $pro)
            ->orderBy('semester_id', 'asc')
            ->orderBy('description', 'asc')
            ->get();

        $program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();

        $nameProgram = Program::where('id', $pro)
            ->select('program.name')
            ->get()
            ->first();

        return view('admin.Subject', ['program' => $program, 'subject' => $subject, 'name' => $nameProgram, 'semester' => $semester]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required|alpha|max:200',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $subject = new Subject();
        $subject->description = $request->input('subject');
        $subject->program_id = $request->input('program');
        $subject->semester_id = $request->input('semester');
        $subject->save();

        return redirect()->route('admin.subject');
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        $subject->description = $request->input('subject');
        $subject->semester_id = $request->input('semester');

        $subject->save();

        return redirect()->route('admin.subject');
    }

    public function delete($id)
    {
        Subject::destroy($id);
        return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    }
}
