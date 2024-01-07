<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OfferSubject;
use App\Models\person;
use App\Models\Program;
use App\Models\Programming;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectOfferController extends Controller
{
    private $program;
    public function __construct()
    {
        $this->program = Program::orderBy('name', 'desc')
            ->get(['id', 'name']);
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
        $offer = OfferSubject::with('subject:id,description,program_id', 'programming:id,teacher_id,offer_subject_id')
            ->where('id', $id)
            ->get(['id', 'quotas', 'subject_id'])
            ->first();

        $id = $offer->subject->program_id;

        $teacher = person::with('teacher')->whereHas('teacher', function ($query) use ($id) {
            $query->where('program_id', $id);
        })
            ->orderBy('first_name', 'asc')
            ->get(['id', 'first_name', 'last_name']);

        return view('admin.offerSubject.EditOfferSubject', ['teacher' => $teacher, 'offer' => $offer]);
    }


    public function show($id)
    {
        $offer = OfferSubject::with([
            'subject:id,semester_id,description',
            'teacher' => [
                'person:id,first_name,last_name'
            ]
        ])->whereHas('subject', function ($query) use ($id) {
            $query->where('program_id', $id);
        })
            ->where('calendar_id', session('calendar'))
            ->get(['id', 'quotas', 'subject_id','teacher_id']);

        return response()->json(['offer' => $offer]);
    }

    public function getSubjectTeacher($id)
    {
        $teacher = person::with('teacher')
        ->whereHas('teacher', function ($query) use ($id) {
            $query->where('program_id', $id);
        })
            ->orderBy('first_name', 'asc')
            ->get(['id', 'first_name', 'last_name']);

        $subject = Subject::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('offer_subject')
                ->whereRaw('offer_subject.subject_id = subject.id');
        })
            ->where('subject.program_id', $id)
            ->orderBy('subject.description', 'asc')
            ->get(['id', 'description']);

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

        OfferSubject::create([
            'subject_id' => $request->subject,
            'quotas' => $request->quotas,
            'calendar_id' =>  session('calendar'),
            'teacher_id' => $request->teacher,
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
