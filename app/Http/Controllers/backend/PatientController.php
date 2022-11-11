<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\PatientStoreRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\hha_forms;
use App\Models\Company;
use App\Models\icd10;
use App\Models\message;
use App\Models\pt_diagnosis;
use App\Models\vitals;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isEmpty;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::get();
        return view('admin.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gender = config('enumtypes.gender');
        $payers = DB::table('payers')->orderBy('name')->get();
        $states = DB::table('states')->get();
        $physicians = Employee::where('level','physician')->get();
        return view('admin.patient.create', compact('payers', 'physicians', 'states',  'gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $requestData = $request->validated();
        $ptdata = $request->all();
        $fname = $ptdata['first_name'];
        $lname = $ptdata['last_name'];
        $MRN = $lname[0] . $fname[0] . random_int(10000, 99999);
        $request->merge(['MRN' => $MRN]);
        $Patient = Patient::create($request->all());
        // $request = $request->except(['_token', '_method','first_name',  'last_name', 'birthday']);
        // $Patient->createMeta($request);
        return redirect()->route('patients.show', $Patient->uuid)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function addnote(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'sender_id' => ['required'],
            'Patient_id' => ['required'],
            'message' => ['required', 'string'],
        ]);
        $message = message::create($validatedData);
        //$Patient->createMeta($request);
        return redirect()->back()->with([
            'message' => 'successfully Updated !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $patient = Patient::where('uuid', '=', $uuid)->get()->first();
        $payers = DB::table('payers')->orderBy('name')->get();
        $states = DB::table('states')->get();
        $visits = $patient->visits()->join('Employees', 'hha_forms.Employee_id', '=', 'Employees.id')->get(['hha_forms.*', 'Employees.first_name', 'Employees.last_name', 'Employees.Title']);
        $notes = $patient->messages()->join('Employees', 'messages.sender_id', '=', 'Employees.id')->orderBy('created_at', 'desc')->get(['messages.*', 'Employees.first_name', 'Employees.last_name', 'Employees.Title']);
        $company = Company::all()->first();
        $clinicians = Employee::where('level', '=', 'Clinician')->get();
        $physicians = Employee::where('level', '=', 'physician')->get();
        $diagnosis = pt_diagnosis::where('Patient_id', '=', $patient->id)->orderBy('primarydiag', 'desc')->get();
        $vital = $patient->vitals()->orderBy('created_at', 'desc')->get()->first();
        $visittypes = DB::table('visit_types')->orderBy('revenuecode')->get();
        $servicetypes = DB::table('hcpcs')->orderBy('hcpcscode')->get();
        $gender = config('enumtypes.gender');
        $visitlocations = config('enumtypes.visitlocations');
        //dd($vital);
        return view('admin.patient.view', compact('patient', 'payers', 'states',  'gender', 'visittypes', 'physicians', 'visitlocations', 'clinicians', 'servicetypes', 'diagnosis', 'visits', 'company', 'vital', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        /*
        $patient = DB::table('patients')->where('uuid', $uuid)->first();
        $states = DB::table('states')->get();
        //dd($patient);
        return view('admin.patient.edit', compact('patient','states'));
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $Patient = Patient::findOrFail($id);

        if (isEmpty($Patient->MRN)) {
            $ptdata = $request->all();
            $fname = $ptdata['first_name'];
            $lname = $ptdata['last_name'];
            $MRN = $lname[0] . $fname[0] . random_int(10000, 99999);
            $request->merge(['MRN' => $MRN]);
        }
        $input = $request->all();
        $Patient->fill($input)->save(); // = Patient::update($request->validated());
        return redirect()->back()->with([
            'message' => 'successfully Updated !',
            'alert-type' => 'success'
        ]);
    }
    /**{{ route('patients.show', $patient->uuid) }}
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function geticd10(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $icds = icd10::orderby('ICD10', 'asc')->select('ICD10', 'ICD10Description')->limit(10)->get();
        } else {
            $icds = icd10::orderby('ICD10', 'asc')->select('ICD10', 'ICD10Description')->where('ICD10', 'like', $search . '%')->orwhere('ICD10Description', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($icds as $icd) {
            $response[] = array("value" => $icd->ICD10, "label" => $icd->ICD10Description);
        }

        return response()->json($response);
    }
}
