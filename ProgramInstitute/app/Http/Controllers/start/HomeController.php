<?php

namespace App\Http\Controllers\start;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session(['session'=> false]);
        return view('start.home');
    }

    public function about()
    {
        return view('start.about');
    }

}
