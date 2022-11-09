<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\VisitStoreRequest;
use App\Http\Requests\backend\VitalsStoreRequest;
use App\Models\covidscreening;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\hha_forms;
use App\Models\Employee;
use App\Models\pt_diagnosis;
use App\Models\vitals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use function GuzzleHttp\Promise\all;

class VisitController extends Controller
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

        $patients = DB::table('patients')->get();
        $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        $visits = hha_forms::join('Employees', 'hha_forms.Employee_id', '=', 'Employees.id')->join('patients', 'hha_forms.Patient_id', '=', 'patients.id')->get(['hha_forms.*', 'Employees.first_name as emp_fname', 'Employees.last_name  as emp_lname', 'Employees.Title  as emp_title', 'patients.first_name as pt_fname', 'patients.last_name as pt_lname', 'patients.birthday as pt_dob']);
        $gender = config('enumtypes.gender');
        //dd($visits);
        return view('admin.visit.index', compact('patients', 'employee', 'gender', 'visits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payers = DB::table('payers')->orderBy('name')->get();
        $patients = DB::table('patients')->get();
        $states = DB::table('states')->get();
        $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        $clinicians = Employee::where('level', '=', 'Clinician')->get();
        $visittypes = DB::table('visit_types')->orderBy('revenuecode')->get();
        $servicetypes = DB::table('hcpcs')->orderBy('hcpcscode')->get();
        $gender = config('enumtypes.gender');
        $visitlocations = config('enumtypes.visitlocations');
        return view('admin.visit.create', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'clinicians', 'servicetypes', 'patients'));
    }

    public function editcovid19($id)
    {
        $payers = DB::table('payers')->orderBy('name')->get();
        $patients = DB::table('patients')->get();
        $states = DB::table('states')->get();
        $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        $clinicians = Employee::where('level', '=', 'Clinician')->get();
        $visittypes = DB::table('visit_types')->orderBy('revenuecode')->get();
        $servicetypes = DB::table('hcpcs')->orderBy('hcpcscode')->get();
        $gender = config('enumtypes.gender');
        $visitlocations = config('enumtypes.visitlocations');
        $covid19 = covidscreening::join('Employees', 'covidscreenings.employee_id', '=', 'employees.id')->join('patients', 'covidscreenings.Patient_id', '=', 'patients.id')->where('covidscreenings.id', '=', $id)->orderBy('created_at', 'desc')->get(['covidscreenings.*', 'employees.first_name as emp_fname', 'employees.last_name  as emp_lname', 'employees.Title  as emp_title', 'patients.first_name as pt_fname', 'patients.last_name as pt_lname', 'patients.birthday as pt_dob'])->first();
        $visitform = hha_forms::where('id', '=', $covid19->form_id)->get()->first();
        //dd($covid19);
        return view('admin.visit.forms.C19Screening', compact('covid19','employee','visitform'));
    }


    public function createcovid19($id)
    {
        $covidform = covidscreening::where('form_id', '=', $id)->get()->first();
        if (!isset($covidform)) {
            $visitform = hha_forms::where('id', '=', $id)->get()->first();
            $covidform = covidscreening::create(['Patient_id' => $visitform->Patient_id, 'employee_id' => $visitform->Employee_id, 'form_id' => $visitform->id, 'evaldate' => $visitform->visitintime]);
            return redirect()->route('covidscreen.edit', $covidform->id)->with([
                'message' => 'successfully created !',
                'alert-type' => 'success'
            ]);
        }
        //dd($covidform);
        return redirect()->route('covidscreen.edit', $covidform->id);
    }

    public function updatecovid19(Request $request, $id)
    {
        $covidform = covidscreening::findOrFail($id);
        $input = $request->all();
        $covidform->fill($input)->save(); // = Patient::update($request->validated());
        return redirect()->back()->with([
            'message' => 'successfully Updated !',
            'alert-type' => 'success'
        ]);
    }


    public function covidprint($id)
    {
        $covid19 = covidscreening::join('Employees', 'covidscreenings.employee_id', '=', 'employees.id')->join('patients', 'covidscreenings.Patient_id', '=', 'patients.id')->where('covidscreenings.id', '=', $id)->orderBy('created_at', 'desc')->get(['covidscreenings.*', 'employees.first_name as emp_fname', 'employees.last_name  as emp_lname', 'employees.Title  as emp_title', 'patients.physician_id'])->first();
        $patient = DB::table('patients')->where('id', '=', $covid19->Patient_id)->get()->first();
        $visitform = hha_forms::where('id', '=', $covid19->form_id)->get()->first();
        $company = DB::table('companies')->get()->first();
        $physicians =Employee::where('id', '=', $covid19->physician_id)->get()->first();
        //dd($covid19);
        return view('admin.visit.prints.C19printing', compact('covid19','visitform','company','physicians','patient'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitStoreRequest $request)
    {
        $requestData = $request->validated();
        $admission = DB::table('pt_admissions')->where('Patient_id', '=', $request->Patient_id)->get()->first();
        $SOC = Carbon::parse($admission->admissiondate);
        
        $in = Carbon::parse($requestData['visitintime']);
        $out = Carbon::parse($requestData['visitouttime']);
        $diffindays = intdiv($SOC->diffInDays($in),60);
        $currperiodstart= $SOC->addDays($diffindays*60);
        $currperiodend= $currperiodstart->addDays(60);
        $diff_in_minutes =  $out->diffInMinutes($in);
        $unit = intdiv($diff_in_minutes, 15);
        $request->merge(['unit' => $unit,
        'certperiodstart' => $currperiodstart,
        'certperiodend' => $currperiodend]);
        $visitform = hha_forms::create($request->all());
        return redirect()->route('visits.edit', $visitform->uuid)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function storevitals(VitalsStoreRequest $request)
    {
        $vitals = vitals::create($request->validated());
        return redirect()->back()->with([
            'message' => 'successfully Updated !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $visitform = hha_forms::where('uuid', '=', $uuid)->get()->first();
        $payers = DB::table('payers')->orderBy('name')->get();
        $patients = DB::table('patients')->get();
        $pt = Patient::where('id', '=', $visitform->Patient_id)->get()->first();
        $pridiagnosis = pt_diagnosis::where('Patient_id', '=', $visitform->Patient_id)->where('primarydiag', '=', '1')->get();
        $othdiagnosis = pt_diagnosis::where('Patient_id', '=', $visitform->Patient_id)->whereNull('primarydiag')->get();
        $states = DB::table('states')->get();
        $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        $RNs = Employee::where('Title', '=', 'RN')->get();
        $HHAs = Employee::where('Title', '=', 'HHA')->get();
        $clinicians = Employee::where('level', '=', 'Clinician')->get();
        $visittypes = DB::table('visit_types')->orderBy('revenuecode')->get();
        $servicetypes = DB::table('hcpcs')->orderBy('hcpcscode')->get();
        $gender = config('enumtypes.gender');
        $visitlocations = config('enumtypes.visitlocations');
        $options = config('enumtypes.options');
        $yesno = config('enumtypes.yesno');
        $admissions = DB::table('pt_admissions')->where('Patient_id', '=', $visitform->Patient_id)->get();
        $vital = vitals::where('form_id', '=', $visitform->id)->get()->first();
        $covid19 = covidscreening::join('Employees', 'covidscreenings.Employee_id', '=', 'Employees.id')->join('patients', 'covidscreenings.Patient_id', '=', 'patients.id')->where('covidscreenings.form_id', '=', $visitform->id)->orderBy('created_at', 'desc')->get(['covidscreenings.*', 'Employees.first_name as emp_fname', 'Employees.last_name  as emp_lname', 'Employees.Title  as emp_title', 'patients.first_name as pt_fname', 'patients.last_name as pt_lname', 'patients.birthday as pt_dob'])->first();
        //$covid19 = covidscreening::where('form_id','=',$visitform->id)->get()->first();
        $meta = $visitform->getMetas();
        //dd($covid19);
        $formmeta = (object)$meta->all();
        switch ($visitform->visit_type) {
            case ('PSV'):
                return view('admin.visit.forms.PSvisit', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'clinicians', 'servicetypes', 'patients', 'visitform', 'formmeta', 'options', 'yesno'));
                break;
            case ('HHA'):
                return view('admin.visit.forms.HHAvisit', compact('payers','admissions','HHAs','RNs', 'states', 'employee', 'visittypes', 'visitlocations', 'clinicians', 'servicetypes', 'patients', 'visitform', 'formmeta', 'options', 'yesno', 'othdiagnosis', 'pridiagnosis', 'vital', 'pt', 'covid19'));
                break;
            case ('PTV'):
                return view('admin.visit.forms.PTvisit', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'clinicians', 'servicetypes', 'patients', 'visitform', 'formmeta', 'options', 'yesno'));
                break;
            case ('SNV'):
                return view('admin.visit.forms.SNvisit', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'clinicians', 'servicetypes', 'patients', 'visitform', 'formmeta', 'options', 'yesno'));
                break;
        }
        //dd($formmeta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $visitform = hha_forms::findOrFail($id);
        //$admission = DB::table('pt_admissions')->where('Patient_id', '=', $visitform->Patient_id)->get()->first();
        $admission=$requestData['admission'];
        $SOC = Carbon::parse($admission);
        $in = \Carbon\Carbon::parse($requestData['visitintime']);
        $out = \Carbon\Carbon::parse($requestData['visitouttime']);
        $diffindays = (intdiv($SOC->diffInDays($in),60)*60);
        $periodstart= Carbon::parse($admission)->addDays($diffindays);
        $periodsend =Carbon::parse($periodstart)->addDays('60');
       // $currperiodend= $currperiodstart->addDays(60);
        //dd(Carbon::parse($admission),$periodstart ,$periodsend);
        $diff_in_minutes =  $out->diffInMinutes($in);
        $unit = intdiv($diff_in_minutes, 15);
        $request->merge(['unit' => $unit,
        'admission_date'=>Carbon::parse($admission),
        'certperiodstart' => $periodstart,
        'certperiodend' => $periodsend]);
        $input = $request->all();
        $visitform->fill($input)->save(); // = Patient::update($request->validated());

        return redirect()->route('visits.edit', $visitform->uuid)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function updatedata(Request $request, $id)
    {

        $visitform = hha_forms::findOrFail($id);
        $requestdata = $request->except(['_token', '_method']);
        $visitform->setMeta($requestdata);

        return redirect()->route('visits.edit', $visitform->uuid)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function print($uuid)
    {
        $visitform = hha_forms::where('uuid', '=', $uuid)->get()->first();
        $payers = DB::table('payers')->orderBy('name')->get();
        $patient = Patient::where('id', '=', $visitform->Patient_id)->get()->first(); //DB::table('patients')->get();
        $company = DB::table('companies')->get()->first();
        $states = DB::table('states')->get();
        $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        $clinician = Employee::where('id', '=', $visitform->Employee_id)->get()->first();
        $supervisor = Employee::where('id', '=', $visitform->supervisor_id)->get()->first();
        $visittypes = DB::table('visit_types')->orderBy('revenuecode')->get();
        $servicetypes = DB::table('hcpcs')->orderBy('hcpcscode')->get();
        $gender = config('enumtypes.gender');
        $visitlocations = config('enumtypes.visitlocations');
        $options = config('enumtypes.options');
        $yesno = config('enumtypes.yesno');
        $vital = vitals::where('form_id', '=', $visitform->id)->orderBy('created_at', 'desc')->get()->first();
        $covid19 = covidscreening::join('Employees', 'covidscreenings.employee_id', '=', 'employees.id')->join('patients', 'covidscreenings.Patient_id', '=', 'patients.id')->where('covidscreenings.form_id', '=', $visitform->id)->orderBy('created_at', 'desc')->get(['covidscreenings.*', 'employees.first_name as emp_fname', 'employees.last_name  as emp_lname', 'employees.Title  as emp_title', 'patients.physician_id'])->first();
        
        $meta = $visitform->getMetas();
        $formmeta = (object)$meta->all();
        switch ($visitform->visit_type) {
            case ('PSV'):
                return view('admin.visit.prints.PSVprint', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'supervisor', 'clinician', 'servicetypes', 'patient', 'visitform', 'formmeta', 'options', 'yesno', 'company'));
                break;
            case ('HHA'):
                $physicians =Employee::where('id', '=', $covid19->physician_id)->get()->first();
                return view('admin.visit.prints.HHAVprint', compact('payers','covid19','physicians','vital', 'states', 'employee', 'visittypes', 'visitlocations', 'supervisor', 'clinician', 'servicetypes', 'patient', 'visitform', 'formmeta', 'options', 'yesno', 'company'));
                break;
            case ('PTV'):
                return view('admin.visit.prints.PTVprint', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'supervisor', 'clinician', 'servicetypes', 'patient', 'visitform', 'formmeta', 'options', 'yesno', 'company'));
                break;
            case ('SNV'):
                return view('admin.visit.prints.SNVprint', compact('payers', 'states', 'employee', 'visittypes', 'visitlocations', 'supervisor', 'clinician', 'servicetypes', 'patient', 'visitform', 'formmeta', 'options', 'yesno', 'company'));
                break;
        }
    }
}
