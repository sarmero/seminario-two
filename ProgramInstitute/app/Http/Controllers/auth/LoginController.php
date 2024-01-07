<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Calendar;
use App\Models\InscriptionSubject;
use App\Models\News;
use App\Models\User;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function startSession(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|max:255|min:4',
            'password' => 'required|string|min:4'
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'password' => 'Autenticación incorrecta'
            ]);
        }

        $user = Auth::User();
        $person = Person::find($user->person_id);
        $calendar = Calendar::latest('id')->first();

        session(['first_name' => $person->first_name]);
        session(['last_name' => $person->last_name]);
        session(['role' => $person->role_id]);
        session(['image' => $person->image]);
        session(['calendar' => $calendar->id]);
        session(['person' => $person->role_id]);

        $request->session()->regenerate();

        if ($person->role_id == 1) {
            return redirect()->route('session.home');
        } else if ($person->role_id == 3) {
            return redirect()->route('session.home');
        } else if ($person->role_id == 2) {
            return redirect()->route('admin');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        // Destruir el archivo de sesión
        $request->session()->invalidate();

        // Obtener un nuevo token
        $request->session()->regenerateToken();

        Session::flush();
        return redirect()->route('home');
    }
}

