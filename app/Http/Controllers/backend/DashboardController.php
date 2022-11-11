<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\hha_forms;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\NodeVisitor\FirstFindingVisitor;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $start = Carbon::now()->startOfMonth();

        $visits = hha_forms::all()->count();
        $visitsmonthcount = hha_forms::all()->where('created_at', '>=', $start)->count();
        $employees = Employee::all();
        $patients = Patient::all()->count();
        $patientsmonthcount = Patient::all()->where('created_at', '>=', $start)->count();
        $employeesCount = $employees->count();
        $clinicianCount = $employees->where('level', 'Clinician')->count();
        $clinicianmonthCount = $employees->where('level', 'Clinician')->where('created_at', '>=', $start)->count();
        $physicianCount = $employees->where('level','physician')->count();
        $physicianmonthCount = $employees->where('level','physician')->where('created_at', '>=', $start)->count();
        //dd($clinicianmonthCount);
        $company=Company::get()->first();
        $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        return view('admin.dashboard', compact('employee', 'employeesCount','company', 'physicianCount', 'clinicianCount', 'visits', 'patients','clinicianmonthCount','physicianmonthCount','visitsmonthcount','patientsmonthcount'));
        /* return view('home');
        /* return view('home');
        dd($patientCount);        
        $pdf = Pdf::loadView('home');
        return $pdf->stream("", array("Attachment" => false));
        /*yourViewPage.blade.php
        <a href="{{route("pdfStream")}}" target="_blank" > click me to pdf </a>*/
        
    }
}
