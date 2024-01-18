<?php

namespace App\Http\Controllers\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\PersonController;
use App\Http\Resources\CalendarResource;
use App\Http\Resources\ProgramOfferResource;
use App\Http\Resources\StudentResource;
use App\Models\Calendar;
use App\Models\Offer;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class StudentController extends Controller
{
    private $per;

    public function __construct()
    {
        $this->per = new PersonController();
    }

    public function index()
    {
        $calendar = Calendar::get();
        return CalendarResource::collection($calendar);
    }

    public function getPrograms($id)
    {
        $program = Offer::with('program:id,name')
            ->whereHas('program', function ($query) use ($id) {
                $query->orderBy('name', 'desc');
            })
            ->where('calendar_id', $id)
            ->where('state_offer_id', '2')
            ->get(['id', 'program_id']);

        return ProgramOfferResource::collection($program);
    }

    public function show($id)
    {
        $student = Student::with('person:id,first_name,last_name')
            ->where('offer_id', $id)
            ->get(['id', 'person_id', 'code']);
        return StudentResource::collection($student);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function showStudent($id)
    {
        $student = Student::with([
            'offer' => [
                'modality',
                'program:id,name'
            ],
            'semester',
            'person' => [
                'district',
                'role'
            ],

        ])->where('id', $id)
            ->get()->first();

        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $person = $this->per->edit($request, $id);
        $person->update();


        return response()->json([
            'message' => 'Los datos de estudiante modificados',
            'data' => $person,

        ], Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Student::destroy($id);

        return response()->json([
            'message' => 'Los datos de estudiante eliminados'
        ], Response::HTTP_ACCEPTED);
    }
}
