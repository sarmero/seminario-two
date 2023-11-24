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
            $this->dataStudent($person->id);
            return redirect()->route('session.home');
        } else if ($person->role_id == 3) {
            $this->dataTeacher($person->id);
            return redirect()->route('session.home');
        } else if ($person->role_id == 2) {
            $this->dataAdmin($person->id);
            session(['rol' => 'admin']);
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('login');
        }
    }


    private function dataStudent($id)
    {
        $student = Student::join('inscription', 'inscription.student_id', '=', 'student.id')
            ->join('offer', 'offer.id', '=', 'inscription.offer_id')
            ->join('program', 'program.id', '=', 'offer.program_id')
            ->join('admission', 'student.admission_id', '=', 'admission.id')
            ->join('semester', 'semester.id', '=', 'student.semester_id')
            ->select(
                'program.name as program',
                'inscription.id as inc',
                'inscription.offer_id as offer',
                'program.id as pro',
                'student.code',
                'semester.id as semester',
                'student.id as std'
            )
            ->where('admission.person_id', $id)
            ->get()
            ->first();

        $approved = InscriptionSubject::where('inscription_id', $student->inc)
            ->where('note', '>=', 3)
            ->get();

        $subject = Subject::where('program_id', $student->pro)->count();

        $average = InscriptionSubject::where('inscription_id', $student->inc)->avg('note');

        $position = InscriptionSubject::join('inscription', 'inscription.id', '=', 'inscription_subject.inscription_id')
            ->select(DB::raw('COUNT(*) as puesto'))
            ->where('note', '>', $average)
            ->where('inscription.offer_id', $student->offer)
            ->where('inscription_subject.inscription_id', '=!', $student->inc)
            ->count();

        $activity = Activity::join('offer_subject', 'offer_subject.id', '=', 'activity.offer_subject_id')
            ->join('inscription_subject', 'offer_subject.id', '=', 'inscription_subject.offer_subject_id')
            ->where('inscription_subject.inscription_id', $student->inc)
            ->select('activity.description', 'activity.deadline')
            ->orderBy("activity.deadline", "asc")
            ->get();

        $news = News::orderBy("date", "asc")->get();

        session(['program' => $student->program]);
        session(['inscription' => $student->inc]);
        session(['program_id' => $student->pro]);
        session(['code' => $student->code]);
        session(['semester' => $student->semester]);
        session(['subjects' => count($approved)]);
        session(['subject_tt' => $subject]);
        session(['average' => round($average, 2)]);
        session(['position' => $position]);
        session(['activity' => $activity]);
        session(['news' => $news]);
    }

    private function dataTeacher($id)
    {
        $teacher = Teacher::where('person_id', $id)->get()->first();
        session(['teacher' => $teacher->id]);

        $news = News::orderBy("date", "asc")->get();
        session(['news' => $news]);

        $activity = Activity::join('offer_subject', 'offer_subject.id', '=', 'activity.offer_subject_id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('programming.teacher_id', $teacher->id)
            ->select('activity.description', 'activity.deadline')
            ->orderBy("activity.deadline", "asc")
            ->get();

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
