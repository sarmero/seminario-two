<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Offer;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    public function index()
    {
        $cal = Calendar::latest('id')->first();

        $program = Program::with(['offer' => function ($query) use ($cal) {
            $query->where('calendar_id', $cal->id);
        }])
        ->orderBy('name', 'asc')
        ->get();

        return view('start.Program', ['program' => $program]);
    }

    public function content(int $id)
    {
        $program = Program::find($id);

        $subject = Subject::where('program_id', $id)
            ->orderBy('description', 'asc')
            ->get();

        return view('start.Content', ['program' => $program, 'subject' => $subject]);
    }
}
