<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlanStudyController extends Controller
{
    public function index()
    {
        session(['page' => 'Plan de estudio']);

        $subject = Subject::all()
            ->where('program_id', session('program_id'))
            ->groupBy('semester_id');

        return view('session.planStudy', ['subject' => $subject]);
    }
}
