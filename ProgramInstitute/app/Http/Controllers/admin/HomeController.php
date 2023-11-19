<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {
                return view('admin.home');
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }
}
