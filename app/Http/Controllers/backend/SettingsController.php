<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UploadTrait;
use App\Http\Requests\backend\CompanyStoreRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\hha_forms;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function showcompany()
    {
        $patients = Patient::all();
        $companies= Auth::user()->companies;//Company::all();
        $company= Auth::user()->companies->first();//Company::all();
        $gender = config('enumtypes.gender');
        return view('admin.company.company',compact('companies','patients','gender','company'));
    }

    public function addcompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'     => ['required'],
            'address'     => ['required'],
            'city'     => ['required'],
            'state'     => ['required'],
            'zip'     => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $requestData = Company::create($request->validated());
        return redirect()->route('settings.companypreview', $requestData->uuid)->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function companypreview($uuid)
    {
        $patients = Patient::all();
        $company = Company::where('uuid', '=', $uuid)->get()->first();
        return view('admin.company.view', compact('company','patients'));
    }

    public function updatecompany(Request $request, $id)
    {
        
        $Company = Company::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'company_name'     => ['required'],
            'address'     => ['required'],
            'city'     => ['required'],
            'state'     => ['required'],
            'zip'     => ['required'],
            'NPI'     => ['required'],
            'TIN'     => ['required '],
            'MedicareID'     => ['nullable'],
            'MedicaidID'     => ['nullable'],
            'email'     => ['nullable'],
            'phone'     => ['required'],
            'fax'     => ['nullable'],
            'website'     => ['nullable'],
            'timezone'     => ['nullable'],
            'logo'     => ['nullable'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        // Retrieve the validated input...
        $validated = $validator->validated();

        if ($request->has('logo')) {
            // Get image file
            $image = $request->file('logo');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('company_name'),'_').'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filename = $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $validated['logo'] = $filename;
        }   
        //dd($validated);
        $Company->fill($validated)->save();
        return redirect()->route('settings.company')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'success'
        ]);
        // $patients = DB::table('patients')->get();
        // $employee = Employee::where('user_id', '=', Auth::user()->id)->get()->first();
        // $company = Company::where('uuid', '=', $uuid)->get()->first();
        // return view('admin.company.view', compact('company','patients','employee'));
    }
}
