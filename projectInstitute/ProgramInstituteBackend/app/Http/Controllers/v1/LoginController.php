<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Calendar;
use App\Models\InscriptionSubject;
use App\Models\News;
use App\Models\person;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'), true)) {
            $user = $request->user();
            $person = person::find($user->person_id);

            return response()->json([
                'token' => $user->createToken($request->username)->plainTextToken,
                'username' => $user->username,
                'role' => $person->role_id,
                'message' => 'success',
                'person' =>  $person

            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->currentAccessToken()->delete();
            $request->session()->invalidate();
            return response()->json([
                'message' => 'successfully logged out'
            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                'message' => 'User  not authenticated'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
   
}
