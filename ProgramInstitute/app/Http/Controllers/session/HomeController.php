<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Inscription;
use App\Models\InscriptionSubject;
use App\Models\News;
use App\Models\User;
use App\Models\Person;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        if (Session::has('session')) {
            if (session('session')) {
                session(['page' => 'Inicio']);
                return view('session.home');
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }
    
}
