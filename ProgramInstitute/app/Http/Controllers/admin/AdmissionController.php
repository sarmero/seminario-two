<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Offer;
use App\Models\Program;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdmissionController extends Controller
{
    private $program;

    public function __construct()
    {
        $this->program = Program::whereHas('offer', function ($query) {
            $query->where('state_offer_id', '1');
        })
            ->orderBy('name', 'asc')
            ->get();
    }

    public function index()
    {
        return view('admin.admission.AdminAdmission', ['program' => $this->program]);
    }


    public function show($id)
    {
        $approved = $this->admissionData(1, $id);
        $earrings = $this->admissionData(2, $id);
        $rejected = $this->admissionData(3, $id);

        $nameProgram = Offer::with('program:id,name')
            ->whereHas('program', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get(['offer.id', 'offer.quotas', 'offer.program_id'])->first();

        $requests = Admission::whereHas('offer', function ($query) use ($id) {
            $query->where('program_id', $id);
        })->count();

        return response()->json([
            'program' => $this->program,
            'name' => $nameProgram,
            'approved' => $approved,
            'rejected' => $rejected,
            'earrings' => $earrings,
            'requests' => $requests
        ]);
    }

    private function admissionData($state, $pro)
    {
        return  Offer::with([
            'admission:id,person_id,offer_id' => [
                'person:id,first_name,last_name'
            ]
        ])->whereHas(
            'admission',
            function ($query) use ($state) {
                $query->where('state_id', $state);
            }
        )
            ->where('program_id', $pro)
            ->get(['id', 'program_id as pro'])->first();
    }

    public function update(Request $request, $id,)
    {
        $admission = Admission::find($id);
        $admission->update([
            'state_id' =>  $request->state,
        ]);

        return response()->json(['message' => 'Atualizado..!']);
    }

    public function showPerson($id)
    {
        $per = Offer::with([
            'admission' => [
                'person' => [
                    'district',
                    'role'
                ],
                'state'
            ],
            'modality',
            'program'

        ])->whereHas(
                'admission',
                function ($query) use ($id) {
                    $query->where('id', $id);
                }
            )
            ->get()
            ->first();

        foreach ($per->admission as  $adm) {
            $person = $adm->person;
            $state = $adm->state;

        }

        return view('admin.usersDetail.UserDetail', [
            'person' => $person,
            'district' => $person->district,
            'role' => $person->role,
            'state' => $state,
            'modality' => $per->modality,
            'program'=> $per->program
        ]);
    }

    public function closeOffer($id)
    {
        $offer = Offer::find($id);
        $offer->update([
            'state_offer_id' => 2,
        ]);

        return response()->json(['mensaje' => 'Elemento atualizado correctamente ']);
    }
}
