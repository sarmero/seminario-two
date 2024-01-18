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
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }



    public function startSession(Request $request)
    {
        $url = env('URL_SERVER_API');

        $request->validate(
            [
                'username' => 'required|string|max:255|min:4',
                'password' => 'required|string|min:4'
            ]
        );

        $response = Http::post($url . '/v1/login', [
            'username' => $request->username,
            'password' => $request->password,
            'name' => 'browser',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session(['person' => $data['person']]);
            session(['role' => $data['role']]);
            // dd($data);
            $request->session()->put('api_token', $data['token']);
            $request->session()->put('user_name', $data['username']);
            $request->session()->put('user_role', $data['role']);

            //Crear el archivo de la sesión
            //Almacenando datos mientras esta en la sesión
            $request->session()->regenerate();

            // dd($request->session());

            if ($data['role'] == 1) {
                return redirect()->route('session.home');
            } else if ($data['role'] == 3) {
                return redirect()->route('session.home');
            } else if ($data['role'] == 2) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('login');
            }

        } else {
            back()->withErrors([
                'message' => 'Credenciales invalidas'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $url = env('URL_SERVER_API');

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $request->session()->get('api_token')])->post($url . '/v1/logout');

        if ($response->successful()) {
            $request->session()->forget('api_token');
            //Destruir el archivo de sesión
            $request->session()->invalidate();
            //Obtener un nuevo token
            $request->session()->regenerateToken();

            Session::flush();
            return  response()->json(['message'=>'session cerrada']);
        } else {
            back()->withErrors([
                'message' => 'Error al cerrar sesión'
            ]);
        }
    }
}
