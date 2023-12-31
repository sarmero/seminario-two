<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Offer;
use App\Models\Program;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdmissionController extends Controller
{
    private $program;

    public function __construct()
    {
        $this->program = Offer::select('program.id', 'program.name')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('offer.state_offer_id', '1')
            ->orderBy('program.name', 'desc')
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

        $nameProgram = Offer::select('offer.quotas', 'program.name', 'offer.id as offer')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('program.id', $id)
            ->get()
            ->first();

        $requests = Admission::join('offer', 'admission.offer_id', '=', 'offer.id')
            ->where('offer.program_id', $id)
            ->count();

        return response()->json( [
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
        return Offer::select('admission.id', 'person.first_name', 'person.last_name', 'offer.program_id as pro')
            ->join('admission', 'admission.offer_id', '=', 'offer.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->where('offer.program_id', $pro)
            ->where('admission.state_id', $state)
            ->get();
    }

    public function update(Request $request, $id,)
    {
        $admission = Admission::find($id);
        $admission->update([
            'state_id' =>  $request->state,
        ]);

        return response()->json(['message'=>'Atualizado..!']);
    }

    public function showPerson($id)
    {
        $person = Offer::select(
            'person.*',
            'role.description as role',
            'modality.description as modality',
            'program.name',
            'offer.code',
            'state.description as state',
            'district.description as district',
            'contact.*'
        )
            ->join('admission', 'admission.offer_id', '=', 'offer.id')
            ->join('person', 'admission.person_id', '=', 'person.id')
            ->join('contact', 'person.contact_id', '=', 'contact.id')
            ->join('role', 'person.role_id', '=', 'role.id')
            ->join('district', 'person.district_id', '=', 'district.id')
            ->join('state', 'admission.state_id', '=', 'state.id')
            ->join('modality', 'offer.modality_id', '=', 'modality.id')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('admission.id', $id)
            ->get()
            ->first();

        return view('admin.usersDetail.UserDetail', ['person' => $person]);
    }

    public function closeOffer($id)
    {
        $offer = Offer::find($id);
        $offer->update([
            'state_offer_id' => 2,
        ]);

        return response()->json(['mensaje' => 'Elemento eliminado correctamente ']);
    }
}
