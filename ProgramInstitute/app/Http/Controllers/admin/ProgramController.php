<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modality;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $modality = Modality::get();
        return view('admin.programRegister', ['modality' => $modality]);
    }

    public function show()
    {
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {
                $program = Program::select('program.id', 'program.name', 'program.description', DB::raw('COUNT(subject.id) as subject'))
                    ->leftJoin('subject', 'program.id', '=', 'subject.program_id')
                    ->groupBy('program.id', 'program.name', 'program.description')
                    ->get();

                return view('admin.program', ['program' => $program]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function offer(){
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {
                $program = Program::select('program.id', 'program.name', 'program.description', DB::raw('COUNT(subject.id) as subject'))
                    ->leftJoin('subject', 'program.id', '=', 'subject.program_id')
                    ->groupBy('program.id', 'program.name', 'program.description')
                    ->get();

                return view('admin.program', ['program' => $program]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        $program = new Program();
        $program->name = $request->input('program');
        $program->description = $request->input('description');
        $program->quotas = $request->input('quotas');
        $program->modality_id = $request->input('modality');

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
    }

    public function delete($id)
    {
    }
}
