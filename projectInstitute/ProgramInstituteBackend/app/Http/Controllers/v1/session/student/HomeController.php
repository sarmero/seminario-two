<?php

namespace App\Http\Controllers\v1\session\student;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\InscriptionSubject;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getPosition($id, $offer)
    {

        $average = InscriptionSubject::where('student_id', $id)->avg('note');
        if ($average == '') {
            $average = 0;
        }

        $position = Student::with(['inscriptionSubject' => function ($query) {
            $query->select('student_id', DB::raw('AVG(note)'))
                ->groupBy('student_id');
        }])->whereHas('inscriptionSubject', function ($query) use ($average) {
            $query->havingRaw('AVG(note) > ?', [$average]);
        })
            ->where('offer_id', $offer)
            ->where('id', '!=', $id)
            ->count();

        return ['position' => $position + 1];
    }

    public function getAverage($id)
    {
        $average = InscriptionSubject::where('student_id', $id)->avg('note');
        if ($average == '') {
            $average = 0;
        }
        return ['average' => round($average, 2)];
    }

    public function getApproved($id)
    {
        $approved = InscriptionSubject::where('student_id', $id)
            ->where('note', '>=', 3)
            ->get();

        return ['subjects' => count($approved)];
    }

    public function getSubjectCount($id)
    {
        $subject = Subject::where('program_id', $id)->count();
        return ['subject_tt' => $subject];
    }

    public function getStudent($id)
    {
        $student = Student::with([
            'offer:id,program_id' => [
                'program:id,name'
            ],'semester'
        ])
            ->where('person_id', $id)
            ->get()
            ->first();

        return new StudentResource($student);
    }
}
