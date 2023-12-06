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
    private $program;
    private $semester;

    public function __construct()
    {
        $this->program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();

        $this->semester = Semester::get();
    }

    public function index()
    {
        return view('admin.subject.AdminSubject', ['program' => $this->program]);
    }

    public function create()
    {
        return view('admin.subject.CreateSubject', ['program' => $this->program, 'semester' => $this->semester]);
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.EditSubject', ['subject'=>$subject,'program' => $this->program, 'semester' => $this->semester]);
    }

    public function show($id)
    {
        $semester = Semester::get();

        $subject = Subject::where('program_id', $id)
            ->orderBy('semester_id', 'asc')
            ->orderBy('description', 'asc')
            ->get();

        $nameProgram = Program::where('id', $id)
            ->select('program.name')
            ->get()
            ->first();

        return response()->json(['subject' => $subject, 'name' => $nameProgram, 'semester' => $semester]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'program' => 'required',
            'semester' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        Subject::create([
            'description' => $request->subject,
            'program_id' => $request->program,
            'semester_id' => $request->semester,
        ]);

        return redirect()->route('subject.index');
    }

    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required|regex:/^([A-Za-zÑñ\s]*)$/|between:5,200',
            'program' => 'required',
            'semester' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $subject = Subject::find($id);

        $subject->update([
            'subject' => $request->subject,
            'program' => $request->program,
            'semester' => $request->semester,
        ]);
        return redirect()->route('subject.index');
    }

    public function destroy($id)
    {
        Subject::destroy($id);
        return redirect()->route('subject.index');
    }
}
