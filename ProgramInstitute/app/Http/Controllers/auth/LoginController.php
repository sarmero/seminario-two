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
            'password' => 'required|string'
        ]);

        // Incorrecto, genera exención y retorna al formulario de login
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
        session(['photo' => $person->photo]);
        session(['rol' => 'users']);
        session(['calendar' => $calendar->id]);
        session(['navStart' => false]);

        $request->session()->regenerate();

        if ($person->role_id == 1) {
            $this->dataStudent($user->person_id);
            return redirect()->route('session.home');
        } else if ($person->role_id == 3) {
            $this->dataTeacher($user->person_id);
            return redirect()->route('session.home');
        } else if ($person->role_id == 2) {
            $this->dataAdmin($user->person_id);
            session(['rol' => 'admin']);
            return redirect()->route('admin');
        } else {
            return redirect()->route('login');
        }
    }

    private function dataStudent($id)
    {
        $student = Student::with([
            'inscription' => [
                'offer:id,program_id' => [
                    'program:id,name'
                ]
            ]
        ])->whereHas('admission', function ($query) use ($id) {
            $query->where('person_id', $id);
        })
            ->get()
            ->first();

        $inc = $student->inscription[0];

        $approved = InscriptionSubject::where('inscription_id', $inc->id)
            ->where('note', '>=', 3)
            ->get();

        $subject = Subject::where('program_id', $inc->offer->program_id)->count();

        $average = InscriptionSubject::where('inscription_id', $inc->id)->avg('note');

        $position = InscriptionSubject::whereHas('inscription', function ($query) use ($average, $inc) {
            $query->where('note', '>', $average)->where('offer_id', $inc->offer_id)->where('id', '=!', $inc->id);
        })->count();

        $activity = Activity::whereHas('offerSubject.inscriptionSubject', function ($query) use ($inc) {
            $query->where('inscription_id', $inc->id);
        })
            ->orderBy("deadline", "asc")
            ->get(['id', 'description', 'deadline']);

        $news = News::orderBy("date", "asc")->get();

        session(['program' => $inc->offer->program->name]);
        session(['inscription' => $inc->id]);
        session(['program_id' => $inc->offer->program_id]);
        session(['code' => $student->code]);
        session(['semester' => $student->semester_id]);
        session(['subjects' => count($approved)]);
        session(['subject_tt' => $subject]);
        session(['average' => round($average, 2)]);
        session(['position' => $position]);
        session(['activity' => $activity]);
        session(['news' => $news]);
    }

    private function dataTeacher($id)
    {
        echo 'id: ' . $id;
        echo 'id: ' . $id;
        echo 'id: ' . $id;
        $teacher = Teacher::where('person_id', $id)->get()->first();
        session(['teacher' => $teacher->id]);

        $news = News::orderBy("date", "asc")->get();
        session(['news' => $news]);

        $activity = Activity::whereHas('offerSubject.programming', function ($query) use ($teacher) {
            $query->where('teacher_id', $teacher->id);
        })
            ->orderBy("deadline", "asc")
            ->get(['id', 'description', 'deadline']);

        session(['activity' => $activity]);
    }

    private function dataAdmin($id)
    {
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


// $position = InscriptionSubject::join('inscription', 'inscription.id', '=', 'inscription_subject.inscription_id')
// ->select(DB::raw('COUNT(*) as puesto'))
// ->where('note', '>', $average)
// ->where('inscription.offer_id', $student->offer)
// ->where('inscription_subject.inscription_id', '=!', $inc->id)
// ->count();
