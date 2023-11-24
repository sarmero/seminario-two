<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index()
    {
        $calendar = Calendar::get();
        return view('admin.student', ['calendar' => $calendar]);
    }

    public function programs(Request $request)
    {
        $cal = $request->input('id');

        $program = Offer::select('offer.id', 'program.name')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('offer.calendar_id', $cal)
            ->orderBy('program.name', 'desc')
            ->get();

        return response()->json(['program' => $program]);
    }

    public function programsStudent(Request $request)
    {
        $id = $request->input('id');

        $student = Offer::select('admission.id', 'student.code', 'person.first_name', 'person.last_name')
            ->join('admission', 'admission.offer_id', '=', 'offer.id')
            ->join('student', 'student.admission_id', '=', 'admission.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->where('offer.id', $id)
            ->orderBy('person.first_name', 'desc')
            ->get();

        return response()->json(['student' => $student]);
    }

    public function showPerson($id)
    {
        $person = Offer::select(
            'person.*',
            'role.description as role',
            'program.name',
            'offer.code',
            'modality.description as modality',
            'district.description as district',
            'contact.*',
            'semester.description as semester'
        )
            ->join('admission', 'admission.offer_id', '=', 'offer.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->join('student', 'student.admission_id', '=', 'admission.id')
            ->join('semester', 'student.semester_id', '=', 'semester.id')
            ->join('contact', 'person.contact_id', '=', 'contact.id')
            ->join('role', 'person.role_id', '=', 'role.id')
            ->join('district', 'person.district_id', '=', 'district.id')
            ->join('modality', 'offer.modality_id', '=', 'modality.id')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('admission.id', $id)
            ->get()
            ->first();

        return view('admin.userDetail', ['person' => $person]);
    }
}
