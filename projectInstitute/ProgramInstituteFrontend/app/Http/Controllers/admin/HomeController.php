<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $person = session('person');
        session(['image' => $person['image']]);

        return view('admin.WelcomeAdminView', ['person' => $person]);
    }
}
