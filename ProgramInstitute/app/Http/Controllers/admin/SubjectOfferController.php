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

class SubjectOfferController extends Controller
{
    public function index()
    {

        // $program = Offer::select('program.id', 'program.name')
        //     ->join('program', 'offer.program_id', '=', 'program.id')
        //     // ->where('offer.state_offer_id', '1')
        //     // ->distinct()
        //     ->orderBy('program.name', 'desc')
        //     ->get();
        $program = Program::select('program.id', 'program.name')
            ->orderBy('name', 'desc')
            ->get();

        return view('admin.subjectOffer', ['program' => $program]);
    }

    public function programsSubject(Request $request)
    {
        $id = $request->input('id');

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

        $teacher = Teacher::select('person.id', 'person.first_name', 'person.last_name', 'teacher.id as teacher')
            ->join('person', 'person.id', '=', 'teacher.person_id')
            ->where('program_id', $id)
            ->orderBy('person.first_name', 'asc')
            ->get();

        $subject = Subject::select('subject.id', 'subject.description')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('offer_subject')
                    ->whereRaw('offer_subject.subject_id = subject.id');
            })
            ->where('subject.program_id', $id)
            ->get();

        $nameProgram = Program::where('id', $id)
            ->select('program.name')
            ->get()
            ->first();

        return response()->json(['offer' => $offer, 'subject' => $subject, 'teacher' => $teacher, 'name' => $nameProgram]);
    }

    public function store(Request $request)
    {
        $offer = new OfferSubject();
        $offer->subject_id = $request->input('subject');
        $offer->quotas = $request->input('quotas');
        $offer->calendar_id =  session('calendar');
        $offer->save();

        $programming = new Programming();
        $programming->teacher_id = $request->input('teacher');
        $programming->offer_subject_id = $offer->id;
        $programming->save();

        return redirect()->route('admin.subject.offer');
    }

    public function update(Request $request, $id)
    {
        $offer = OfferSubject::find($id);
        $offer->quotas = $request->input('quotas');
        $offer->save();

        $idp = Programming::select('id')->where('offer_subject_id', $id)->get()->first();

        $programming = Programming::find($idp->id);
        $programming->teacher_id = $request->input('teacher');
        $programming->save();

        return redirect()->route('admin.subject.offer')->with('success', 'Oferta actualizado correctamente');
    }


    public function delete($id)
    {
        OfferSubject::destroy($id);
        return response()->json(['mensaje' => 'Elemento eliminado correctamente ' . $id]);
    }

    public function offer(Request $request)
    {
        $id = $request->input('id');
        $offer = OfferSubject::select('subject.description as subject')
            ->join('subject', 'offer_subject.subject_id', '=', 'subject.id')
            ->where('offer_subject.id', $id)
            ->get()
            ->first();
        return response()->json(['offer' => $offer]);
    }
}
