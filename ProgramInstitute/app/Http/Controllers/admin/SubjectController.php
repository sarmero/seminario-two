<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    public function index()
    {
        $program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();
            
        return view('admin.subjectRegister', ['program' => $program]);
    }

    public function show()
    {
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {
                $program = Program::select('program.id', 'program.name')
                    ->orderBy('name', 'desc')
                    ->get();

                return view('admin.Subject', ['program' => $program]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function subject(Request $request)
    {
        $pro = $request->input('program');
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

        return view('admin.Subject', ['program' => $program, 'subject' => $subject, 'name' => $nameProgram]);
    }

    public function store(Request $request)
    {
        $subject = new Subject();
        $subject->description = $request->input('subject');
        $subject->program_id = $request->input('program');
        $subject->semester_id = $request->input('semester');
        $subject->save();

        return redirect()->route('admin.subject');
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }
}
