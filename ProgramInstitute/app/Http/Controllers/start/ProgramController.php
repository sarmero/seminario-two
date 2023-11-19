<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index() {
        $program = Program::get();
        return view('start.Program',['program'=>$program]);
    }

    public function content(int $id)
    {
        // $program = Program::find($id);
        $program = Program::join('modality','program.modality_id','=','modality.id')
        ->where('program.id',$id)
        ->select('program.*','modality.description as modality')
        ->get()
        ->first();

        $subject = Subject::where('program_id',$id)
        ->orderBy('description', 'asc')
        ->get();
        $duration = Subject::distinct('semester_id')->pluck('semester_id');

        return view('start.Content',['program'=>$program,'subject'=>$subject,'duration'=>$duration]);
    }


}


  // $program = Program::join('modality', function($join) use ($id) {
        //     $join->on('program.modality_id', '=', 'modality.id')
        //          ->where('program.id', '=', $id);
        // })
        // ->select('program.description','modality.description as descr')
        // ->get();
