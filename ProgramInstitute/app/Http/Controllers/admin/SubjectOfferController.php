<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Modality;
use App\Models\Offer;
use App\Models\OfferSubject;
use App\Models\Program;
use App\Models\Programming;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubjectOfferController extends Controller
{
    private $program;
    public function __construct()
    {
        $this->program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();
    }

    public function index()
    {
        return view('admin.offerSubject.AdminOfferSubject', ['program' => $this->program]);
    }

    public function create()
    {
        return view('admin.offerSubject.CreateOfferSubject', ['program' => $this->program]);
    }

    public function edit($id)
    {
        $offer = OfferSubject::select(
            'offer_subject.id',
            'offer_subject.quotas',
            'subject.description as subject',
            'subject.program_id',
            'programming.teacher_id',
        )
            ->join('subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->join('programming', 'Programming.offer_subject_id', '=', 'offer_subject.id')
            ->where('offer_subject.id', $id)
            ->get()
            ->first();

        $teacher = Teacher::select('person.first_name', 'person.last_name', 'teacher.id')
            ->join('person', 'person.id', '=', 'teacher.person_id')
            ->where('program_id', $offer->program_id)
            ->orderBy('person.first_name', 'asc')
            ->get();


        return view('admin.offerSubject.EditOfferSubject', ['teacher' => $teacher, 'offer' => $offer]);
    }


    public function show($id)
    {
        $offer = OfferSubject::select(
            'offer_subject.id',
            'subject.semester_id as semester',
            'subject.description as subject',
            'offer_subject.quotas',
            'person.last_name',
            'person.first_name'
        )
            ->join('subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->join('programming', 'programming.offer_subject_id', '=', 'offer_subject.id')
            ->join('teacher', 'programming.teacher_id', '=', 'teacher.id')
            ->join('person', 'teacher.person_id', '=', 'person.id')
            ->where('offer_subject.calendar_id', session('calendar'))
            ->where('subject.program_id', $id)
            ->get();

        return response()->json(['offer' => $offer]);
    }

    public function getSubjectTeacher($id)
    {
        $teacher = Teacher::select('person.first_name', 'person.last_name', 'teacher.id')
            ->join('person', 'person.id', '=', 'teacher.person_id')
            ->where('teacher.program_id', $id)
            ->orderBy('person.first_name', 'asc')
            ->get();

        $subject = Subject::select('subject.id', 'subject.description')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('offer_subject')
                    ->whereRaw('offer_subject.subject_id = subject.id');
            })
            ->where('subject.program_id', $id)
            ->orderBy('subject.description', 'asc')
            ->get();

        return response()->json(['subject' => $subject, 'teacher' => $teacher]);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'subject' => 'required',
            'quotas' => 'required|integer|between:5,200',
            'teacher' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $offer = OfferSubject::create([
            'subject_id' => $request->subject,
            'quotas' => $request->quotas,
            'calendar_id' =>  session('calendar'),
        ]);

        Programming::create([
            'teacher_id' => $request->teacher,
            'offer_subject_id' => $offer->id,
        ]);

        return redirect()->route('offer-subject.index');
    }

    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'quotas' => 'required|integer|between:5,200',
            'teacher' => 'required',
        ]);

        if ($validador->fails()) {
            return redirect()->back()->withErrors($validador)->withInput();
        }

        $offer = OfferSubject::find($id);
        $offer->update([
            'quotas' => $request->quotas,
        ]);

        $idp = Programming::select('id')->where('offer_subject_id', $id)->get()->first();

        $programming = Programming::find($idp->id);
        $programming->update([
            'teacher_id' => $request->teacher,
        ]);

        return redirect()->route('offer-subject.index');
    }


    public function destroy($id)
    {
        OfferSubject::destroy($id);
        return redirect()->route('offer-subject.index');
    }

}


     // $program = Offer::select('program.id', 'program.name')
        //     ->join('program', 'offer.program_id', '=', 'program.id')
        //     // ->where('offer.state_offer_id', '1')
        //     // ->distinct()
        //     ->orderBy('program.name', 'desc')
        //     ->get();

        // public function offer(Request $request)
        // {
        //     $id = $request->input('id');
        //     $offer = OfferSubject::select('subject.description as subject')
        //         ->join('subject', 'offer_subject.subject_id', '=', 'subject.id')
        //         ->where('offer_subject.id', $id)
        //         ->get()
        //         ->first();
        //     return response()->json(['offer' => $offer]);
        // }
