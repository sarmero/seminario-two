<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Offer;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdmissionController extends Controller
{

    public function index()
    {
        session(['session' => true]);
        if (Session::has('session')) {
            if (session('session')) {
                $program = $this->program();

                return view('admin.admission', ['program' => $program]);
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('home');
        }
    }


    public function admission(Request $request)
    {
        $pro = $request->input('program');
        return $this->admissionProgram($pro);
    }

    private function admissionProgram($pro)
    {
        $approved = $this->admissionData(1, $pro);
        $earrings = $this->admissionData(2, $pro);
        $rejected = $this->admissionData(3, $pro);

        $nameProgram = Offer::select('offer.quotas', 'program.name')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('program.id', $pro)
            ->get()
            ->first();

        $program = $this->program();

        $requests = Admission::join('offer', 'admission.offer_id', '=', 'offer.id')
            ->where('offer.program_id', $pro)
            ->count();

        return view('admin.admission', [
            'program' => $program,
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

    public function update($state, $id, $pro)
    {
        $admission = Admission::find($id);
        $admission->state_id = $state;
        $admission->save();
        return $this->admissionProgram($pro);
    }

    private function program()
    {
        $program = Offer::select('program.id', 'program.name')
            ->join('program', 'offer.program_id', '=', 'program.id')
            ->where('offer.state_offer_id', '1')
            ->orderBy('program.name', 'desc')
            ->get();

        return $program;
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

        return view('admin.userDetail', ['person' => $person]);
    }
}
