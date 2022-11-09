@extends('layouts.app')

@section('title','Create Visit | Care Giver')

@section('style')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <x-flash-message />
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <h5 class="modal-title" id="myLargeModalLabel">HHA VISIT</h5>
                            <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13 mb-3">
                                <div>{{ \Carbon\Carbon::parse($visitform->visitintime)->isoFormat('MM/DD/YYYY H:m A') }}-{{$visitform->unit}} Units</div>
                            </div>
                        </div>
                        <div class="col-sm order-1 order-sm-2">
                            <div class="d-flex align-items-start justify-content-end gap-2">
                                <div>
                                    <a href="{{ route('visits.prevew', ['uuid' => $visitform->uuid]); }}" target="_blank" class="my-4 align-middle">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                            <i data-feather="printer" class=" icon-sm me-1 align-middle"></i> Print
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('visits.update', $visitform->id) }}" method="POST" id="visitform">
                        @csrf
                        @method('PUT')
                        <div class="pt-2">
                            <div class="row pt-2">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label">Patient Name</label>
                                            <select class="form-control" data-trigger id="choices-single-default" disabled placeholder="Select Patient" name="Patient_id" value="{{ old('Patient_id',$visitform->Patient_id) }}">
                                                <option value="">Select Patient</option>
                                                @forelse($patients as $patient)
                                                <option value="{{ $patient->id}}" {{ ( $patient->id === $visitform->Patient_id) ? 'selected' : '' }}>{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }} ({{ \Carbon\Carbon::parse($patient->birthday)->isoFormat('MM/DD/YYYY') }})</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Case Manager</label>
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Supervisor" name="supervisor_id" value="{{ old('supervisor_id',$visitform->supervisor_id) }}">
                                                        <option value="">Select Clinician</option>
                                                        @forelse($RNs as $RN)
                                                        <option value="{{ $RN->id }}" {{ ( $RN->id === $visitform->supervisor_id) ? 'selected' : '' }}> {{ $RN->last_name}}, {{ $RN->first_name}} ({{ $RN->Title}})</option>
                                                        @empty
                                                        <option value="">No matches found</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">HHA Name</label>
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Employee" name="Employee_id" value="{{ old('Employee_id',$visitform->Employee_id) }}">
                                                        <option value="">Select Clinician</option>
                                                        @forelse($HHAs as $HHA)
                                                        <option value="{{ $HHA->id}}" {{ ( $HHA->id === $visitform->Employee_id) ? 'selected' : '' }}> {{ $HHA->last_name}}, {{ $HHA->first_name}} ({{ $HHA->Title}})</option>
                                                        @empty
                                                        <option value="">No matches found</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mt-3 mt-lg-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="example-datetime-local-input" class="form-label">Time In</label>
                                                        <input class="form-control" name='visitintime' type="datetime-local" value="{{ $visitform->visitintime }}" id="visitintimepicker">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="example-datetime-local-input" class="form-label">Time Out</label>
                                                        <input class="form-control" name='visitouttime' type="datetime-local" value="{{ $visitform->visitouttime }}" id="visitouttimepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Admission Date</label>
                                                        <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Admission Date" name="admission">
                                                            <option value="">Select Admission Date</option>
                                                            @forelse($admissions as $admission)
                                                            <option value="{{ \Carbon\Carbon::parse($admission->admissiondate)->isoFormat('MM/DD/YYYY') }} " {{ ( \Carbon\Carbon::parse($admission->admissiondate)->isoFormat('MM/DD/YYYY') === \Carbon\Carbon::parse($visitform->admission_date)->isoFormat('MM/DD/YYYY')) ? 'selected' : '' }}> {{ \Carbon\Carbon::parse($admission->admissiondate)->isoFormat('MM/DD/YYYY') }}</option>
                                                            @empty
                                                            <option value="">No matches found</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="example-datetime-local-input" class="form-label">Signed on </label>
                                                        <input class="form-control" name='signed_date' type="datetime-local" value="{{ $visitform->signed_date }}" id="signed_date">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="text-decoration-underline" href="{{ route('covidscreen.store', $visitform->id) }}">Covid 19 Screening</a>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comments</label>
                                <textarea class="form-control" name='comment' id='comment' rows="3">{{ old('comment',$visitform->comment) }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" form="visitform">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- General Form Ends -->
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            <h5>
                                <strong>Diagnosis&nbsp;</strong>
                                <a href="#" class="my-4 align-middle">
                                    <i data-feather="plus-circle" class="icon-sm icon-black me-1 align-middle" data-bs-toggle="modal" data-bs-target=".bs-diagnoses-modal-lg"></i>
                                </a>
                            </h5>
                            <table class="table mb-0">

                                <thead>
                                    <tr>
                                        <th colspan="2"><strong>Primary Diagnosis</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pridiagnosis as $prdiag)
                                    <tr>
                                        <th scope="row">{{$prdiag->ICD10}}</th>
                                        <td>{{$prdiag->ICD10Description}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">{{ __('-') }}</td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <th colspan="2"><strong>Other Diagnosis</strong></th>
                                    </tr>
                                    @forelse($othdiagnosis as $othdiag)
                                    <tr>
                                        <th scope="row">{{$othdiag->ICD10}}</th>
                                        <td>{{$othdiag->ICD10Description}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">{{ __('-') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h5>
                                <strong>Vitals&nbsp;</strong>
                                <a href="#" class="my-4 align-middle">
                                    <i data-feather="plus-circle" class="icon-sm icon-black me-1 align-middle" data-bs-toggle="modal" data-bs-target=".bs-vitals-modal-lg"></i>
                                </a>
                            </h5>
                            @if(!empty($vital) || !is_null($vital))
                            <div class="mb-3">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><strong>Blood Pressure:&nbsp;</strong><strong>{{$vital->BPSide === "L" ? "Left":"Right"}} @if($vital->OutofRange ===1) <span class="badge rounded-pill bg-danger">Out of range</span> @endif</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">BP Lying</th>
                                            <td>{{$vital->BPLying}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">BP Sitting</th>
                                            <td>{{$vital->BPSitting}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">BP Standing</th>
                                            <td>{{$vital->BPStanding}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Temperature</th>
                                            <td>{{$vital->Temperature}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Respirations</th>
                                            <td>{{$vital->Respirations}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Apical Pulse</th>
                                            <td>{{$vital->Apical_Pulse}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Radial Pulse</th>
                                            <td>{{$vital->Radial_Pulse}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight (lbs)</th>
                                            <td>{{$vital->Weight}}&nbsp;lbs</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p>{{ __('No Vital Signes Recorded') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('visits.updatedata', $visitform->id) }}" method="POST" id="visitformmeta">
                @csrf
                @method('PUT')
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Notify Nurse/Case Manager for the following:</h5>
                    <div class="card-body p-4 pb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Frequecy"> <strong>Frequency/Duration of Aides Visits</strong></label>
                                    <input class="form-control" type="text" id="HHANote01" name="HHANote01" value="{{ old('HHANote01',isset($formmeta->HHANote01) ? $formmeta->HHANote01 : '') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="Frequecy"><strong> Special Instructions</strong></label><br>
                                    <x-forms.Checkbox name='HHAop001' label='Wounds/Integumentary Issues' checked='{{ isset($formmeta->HHAop001) ? $formmeta->HHAop001 : "" }}' />
                                    <input class="form-control" type="text" id="HHANote02" name="HHANote02" value="{{ old('HHANote02',isset($formmeta->HHANote02) ? $formmeta->HHANote02 : '') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <x-forms.Checkbox name='HHAop002' label='Bleeding Precautions' checked='{{ isset($formmeta->HHAop002) ? $formmeta->HHAop002 : "" }}' />
                                    <input class="form-control" type="text" id="HHANote03" name="HHANote03" value="{{ old('HHANote03',isset($formmeta->HHANote03) ? $formmeta->HHANote03 : '') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-check-label" for="HHAop001">Other</label><br>
                                    <input class="form-control" type="text" id="HHANote04" name="HHANote04" value="{{ old('HHANote04',isset($formmeta->HHANote04) ? $formmeta->HHANote04 : '') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label><strong>Report to Nurse/Case Manager</strong></label>
                                    <!-- <div class="d-block"> <label> <input type='hidden' name='HHAop003' value='0'> <input id="HHAop003" name="HHAop003" type="checkbox" value='1' {{ (isset($formmeta->HHAop003) && ($formmeta->HHAop003 =='1')) ? 'checked' : '' }}> Care is Refused </label> </div> -->
                                    <x-forms.Checkbox name='HHAop003' label='Care is Refused' checked='{{ isset($formmeta->HHAop003) ? $formmeta->HHAop003 : "" }}' />
                                    <x-forms.Checkbox name='HHAop004' label='Change in Skin Condition' checked='{{ isset($formmeta->HHAop004) ? $formmeta->HHAop004 : "" }}' />
                                    <x-forms.Checkbox name='HHAop005' label='Integumentary Issues' checked='{{ isset($formmeta->HHAop005) ? $formmeta->HHAop005 : "" }}' />
                                    <x-forms.Checkbox name='HHAop006' label='Unusual Bruising/Bleeding' checked='{{ isset($formmeta->HHAop006) ? $formmeta->HHAop006 : "" }}' />
                                    <x-forms.Checkbox name='HHAop007' label='Weight Gain or Loss' checked='{{ isset($formmeta->HHAop007) ? $formmeta->HHAop007 : "" }}' />
                                    <x-forms.Checkbox name='HHAop008' label='Vital Signs Out of Parameter' checked='{{ isset($formmeta->HHAop008) ? $formmeta->HHAop008 : "" }}' />
                                    <x-forms.Checkbox name='HHAop009' label='Change in mentation' checked='{{ isset($formmeta->HHAop009) ? $formmeta->HHAop009 : "" }}' />
                                    <x-forms.Checkbox name='HHAop010' label='Patient Complaint or Request' checked='{{ isset($formmeta->HHAop010) ? $formmeta->HHAop010 : "" }}' />
                                    <x-forms.Checkbox name='HHAop011' label='Falls' checked='{{ isset($formmeta->HHAop011) ? $formmeta->HHAop011 : "" }}' />
                                    <div class="form-group">
                                        <x-forms.Checkbox name='HHAop012' label='Other' checked='{{ isset($formmeta->HHAop012) ? $formmeta->HHAop012 : "" }}' />
                                        <div class="d-block"> <input id="HHANote05" name="HHANote05" type="text" class="form-control" value="{{ old('HHANote05',isset($formmeta->HHANote05) ? $formmeta->HHANote05 : '') }}"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"> <label><strong>Goals of Care</strong></label>
                                    <x-forms.Checkbox name='HHAop013' label='Effective and safe personal care' checked='{{ isset($formmeta->HHAop013) ? $formmeta->HHAop013 : "" }}' />
                                    <x-forms.Checkbox name='HHAop014' label='Patient clean, comfortable' checked='{{ isset($formmeta->HHAop014) ? $formmeta->HHAop014 : "" }}' />
                                    <x-forms.Checkbox name='HHAop015' label='Patient/Caregiver independent with personal cares by end of episode' checked='{{ isset($formmeta->HHAop015) ? $formmeta->HHAop015 : "" }}' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Precautionary And Other Pertinent Information</h5>
                    <div class="card-body p-4 pb-3">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group"> <label><strong>Living condition:</strong></label>
                                    <x-forms.Checkbox name='HHAop016' label='Lives alone' checked='{{ isset($formmeta->HHAop016) ? $formmeta->HHAop016 : "" }}' />
                                    <x-forms.Checkbox name='HHAop017' label='Lives with other' checked='{{ isset($formmeta->HHAop017) ? $formmeta->HHAop017 : "" }}' />
                                    <x-forms.Checkbox name='HHAop018' label='Bed bound' checked='{{ isset($formmeta->HHAop018) ? $formmeta->HHAop018 : "" }}' />
                                    <x-forms.Checkbox name='HHAop019' label='Bed rest/BRPs' checked='{{ isset($formmeta->HHAop019) ? $formmeta->HHAop019 : "" }}' />
                                    <x-forms.Checkbox name='HHAop020' label='Up as tolerated' checked='{{ isset($formmeta->HHAop020) ? $formmeta->HHAop020 : "" }}' />
                                    <x-forms.Checkbox name='HHAop021' label='Chairbound' checked='{{ isset($formmeta->HHAop021) ? $formmeta->HHAop021 : "" }}' />
                                    <div class="mb-2">
                                        <x-forms.Checkbox name='HHAop022' label='Amputee (specify)' checked='{{ isset($formmeta->HHAop022) ? $formmeta->HHAop022 : "" }}' />
                                        <div class="d-block"> <input id="HHANote06" name="HHANote06" type="text" class="form-control" value="{{ old('HHANote06',isset($formmeta->HHANote06) ? $formmeta->HHANote06 : '') }}"> </div>
                                    </div>
                                    <div class="mb-2">
                                        <x-forms.Checkbox name='HHAop023' label='Artificial Limb (specify)' checked='{{ isset($formmeta->HHAop023) ? $formmeta->HHAop023 : "" }}' />
                                        <div class="d-block"> <input id="HHANote07" name="HHANote07" type="text" class="form-control" value="{{ old('HHANote07',isset($formmeta->HHANote07) ? $formmeta->HHANote07 : '') }}"> </div>
                                    </div>
                                    <x-forms.Checkbox name='HHAop024' label='Fall precautions' checked='{{ isset($formmeta->HHAop024) ? $formmeta->HHAop024 : "" }}' />
                                    <div class="mb-2">
                                        <x-forms.Checkbox name='HHAop025' label='Special equipment' checked='{{ isset($formmeta->HHAop025) ? $formmeta->HHAop025 : "" }}' />
                                        <div class="d-block"> <input id="HHANote08" name="HHANote08" type="text" class="form-control" value="{{ old('HHANote08',isset($formmeta->HHANote08) ? $formmeta->HHANote08 : '') }}"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label><strong>Vision deficit:</strong></label>
                                    <x-forms.Checkbox name='HHAop026' label='Glasses' checked='{{ isset($formmeta->HHAop026) ? $formmeta->HHAop026 : "" }}' />
                                    <x-forms.Checkbox name='HHAop027' label='Contacts' checked='{{ isset($formmeta->HHAop027) ? $formmeta->HHAop027 : "" }}' />
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Hearing deficit:</strong></label>
                                    <x-forms.Checkbox name='HHAop028' label='Hearing aid' checked='{{ isset($formmeta->HHAop028) ? $formmeta->HHAop028 : "" }}' />
                                    <x-forms.Checkbox name='HHAop029' label='Other' checked='{{ isset($formmeta->HHAop029) ? $formmeta->HHAop029 : "" }}' />
                                    <div class="d-block"> <input id="HHANote09" name="HHANote09" type="text" class="form-control" value="{{ old('HHANote09',isset($formmeta->HHANote09) ? $formmeta->HHANote09 : '') }}"> </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>Dentures:</strong></label>
                                    <x-forms.Checkbox name='HHAop030' label='Upper' checked='{{ isset($formmeta->HHAop030) ? $formmeta->HHAop030 : "" }}' />
                                    <x-forms.Checkbox name='HHAop031' label='Lower' checked='{{ isset($formmeta->HHAop031) ? $formmeta->HHAop031 : "" }}' />
                                    <x-forms.Checkbox name='HHAop032' label='Partial' checked='{{ isset($formmeta->HHAop032) ? $formmeta->HHAop032 : "" }}' />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label><strong>Oriented:</strong></label>
                                    <x-forms.Checkbox name='HHAop033' label='Alert' checked='{{ isset($formmeta->HHAop033) ? $formmeta->HHAop033 : "" }}' />
                                    <x-forms.Checkbox name='HHAop034' label='Forgetful' checked='{{ isset($formmeta->HHAop034) ? $formmeta->HHAop034 : "" }}' />
                                    <x-forms.Checkbox name='HHAop035' label='Confused' checked='{{ isset($formmeta->HHAop035) ? $formmeta->HHAop035 : "" }}' />
                                </div>
                                <div class="form-group ">
                                    <label><strong>Diabetic:</strong></label>
                                    <x-forms.Checkbox name='HHAop036' label='Do not cut nails' checked='{{ isset($formmeta->HHAop036) ? $formmeta->HHAop036 : "" }}' />
                                    <x-forms.Checkbox name='HHAop037' label='Diet' checked='{{ isset($formmeta->HHAop037) ? $formmeta->HHAop037 : "" }}' />
                                    <div class="d-block mb-2"> <input id="HHANote18" name="HHANote18" type="text" class="form-control" value="{{ old('HHANote18',isset($formmeta->HHANote18) ? $formmeta->HHANote18 : '') }}"> </div>
                                    <x-forms.Checkbox name='HHAop038' label='Seizure precaution' checked='{{ isset($formmeta->HHAop038) ? $formmeta->HHAop038 : "" }}' />
                                    <x-forms.Checkbox name='HHAop039' label='Urinary Catheter' checked='{{ isset($formmeta->HHAop039) ? $formmeta->HHAop039 : "" }}' />
                                    <x-forms.Checkbox name='HHAop040' label='Ostomy' checked='{{ isset($formmeta->HHAop040) ? $formmeta->HHAop040 : "" }}' />
                                    <x-forms.Checkbox name='HHAop041' label='Other' checked='{{ isset($formmeta->HHAop041) ? $formmeta->HHAop041 : "" }}' />
                                    <div class="d-block"> <input id="HHANote10" name="HHANote10" type="text" class="form-control" value="{{ old('HHANote10',isset($formmeta->HHANote10) ? $formmeta->HHANote10 : '') }}"> </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label><strong>Environment problems:</strong></label>
                                    <x-forms.Checkbox name='HHAop042' label='Inadequate plumbing' checked='{{ isset($formmeta->HHAop042) ? $formmeta->HHAop042 : "" }}' />
                                    <x-forms.Checkbox name='HHAop043' label='Inadequate heat/cooling' checked='{{ isset($formmeta->HHAop043) ? $formmeta->HHAop043 : "" }}' />
                                    <x-forms.Checkbox name='HHAop044' label='Inadequate refrigeration' checked='{{ isset($formmeta->HHAop044) ? $formmeta->HHAop044 : "" }}' />
                                    <x-forms.Checkbox name='HHAop045' label='Pest/rodent infested' checked='{{ isset($formmeta->HHAop045) ? $formmeta->HHAop045 : "" }}' />
                                    <x-forms.Checkbox name='HHAop046' label='Presence of animals' checked='{{ isset($formmeta->HHAop046) ? $formmeta->HHAop046 : "" }}' />
                                    <x-forms.Checkbox name='HHAop047' label='Other' checked='{{ isset($formmeta->HHAop047) ? $formmeta->HHAop047 : "" }}' />
                                    <div class="d-block"> <input id="HHANote11" name="HHANote11" type="text" class="form-control" value="{{ old('HHANote11',isset($formmeta->HHANote11) ? $formmeta->HHANote11 : '') }}"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-transparent border-bottom d-flex justify-content-between">
                        <h5 class="text-uppercase">Tasks</h5>
                        <x-forms.Checkbox name='HHAop048' label='Respite Care' checked='{{ isset($formmeta->HHAop048) ? $formmeta->HHAop048 : "" }}' />
                    </div>
                    <div class="card-body p-4 pb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">VITAL SIGNS</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">A</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Blood Pressure</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop049' label='' checked='{{ isset($formmeta->HHAop049) ? $formmeta->HHAop049 : "" }}' />
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop050' label='' checked='{{ isset($formmeta->HHAop050) ? $formmeta->HHAop050 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop051' label='' checked='{{ isset($formmeta->HHAop051) ? $formmeta->HHAop051 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop052' label='' checked='{{ isset($formmeta->HHAop052) ? $formmeta->HHAop052 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Temperature</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop053' label='' checked='{{ isset($formmeta->HHAop053) ? $formmeta->HHAop053 : "" }}' />
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop054' label='' checked='{{ isset($formmeta->HHAop054) ? $formmeta->HHAop054 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop055' label='' checked='{{ isset($formmeta->HHAop055) ? $formmeta->HHAop055 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop056' label='' checked='{{ isset($formmeta->HHAop056) ? $formmeta->HHAop056 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Heart Rate</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop057' label='' checked='{{ isset($formmeta->HHAop057) ? $formmeta->HHAop057 : "" }}' />
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop058' label='' checked='{{ isset($formmeta->HHAop058) ? $formmeta->HHAop058 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop059' label='' checked='{{ isset($formmeta->HHAop059) ? $formmeta->HHAop059 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop060' label='' checked='{{ isset($formmeta->HHAop060) ? $formmeta->HHAop060 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Resp</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop061' label='' checked='{{ isset($formmeta->HHAop061) ? $formmeta->HHAop061 : "" }}' />
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop062' label='' checked='{{ isset($formmeta->HHAop062) ? $formmeta->HHAop062 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop063' label='' checked='{{ isset($formmeta->HHAop063) ? $formmeta->HHAop063 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop064' label='' checked='{{ isset($formmeta->HHAop064) ? $formmeta->HHAop064 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Weight</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop065' label='' checked='{{ isset($formmeta->HHAop065) ? $formmeta->HHAop065 : "" }}' />
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop066' label='' checked='{{ isset($formmeta->HHAop066) ? $formmeta->HHAop066 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop067' label='' checked='{{ isset($formmeta->HHAop067) ? $formmeta->HHAop067 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop068' label='' checked='{{ isset($formmeta->HHAop068) ? $formmeta->HHAop068 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">BATH</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">A</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Bed</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop069' label='' checked='{{ isset($formmeta->HHAop069) ? $formmeta->HHAop069 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop070' label='' checked='{{ isset($formmeta->HHAop070) ? $formmeta->HHAop070 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop071' label='' checked='{{ isset($formmeta->HHAop071) ? $formmeta->HHAop071 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop072' label='' checked='{{ isset($formmeta->HHAop072) ? $formmeta->HHAop072 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop073' label='' checked='{{ isset($formmeta->HHAop073) ? $formmeta->HHAop073 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop074' label='' checked='{{ isset($formmeta->HHAop074) ? $formmeta->HHAop074 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Chair</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop075' label='' checked='{{ isset($formmeta->HHAop075) ? $formmeta->HHAop075 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop076' label='' checked='{{ isset($formmeta->HHAop076) ? $formmeta->HHAop076 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop077' label='' checked='{{ isset($formmeta->HHAop077) ? $formmeta->HHAop077 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop078' label='' checked='{{ isset($formmeta->HHAop078) ? $formmeta->HHAop078 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop079' label='' checked='{{ isset($formmeta->HHAop079) ? $formmeta->HHAop079 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop080' label='' checked='{{ isset($formmeta->HHAop080) ? $formmeta->HHAop080 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tub</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop081' label='' checked='{{ isset($formmeta->HHAop081) ? $formmeta->HHAop081 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop082' label='' checked='{{ isset($formmeta->HHAop082) ? $formmeta->HHAop082 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop083' label='' checked='{{ isset($formmeta->HHAop083) ? $formmeta->HHAop083 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop084' label='' checked='{{ isset($formmeta->HHAop084) ? $formmeta->HHAop084 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop085' label='' checked='{{ isset($formmeta->HHAop085) ? $formmeta->HHAop085 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop086' label='' checked='{{ isset($formmeta->HHAop086) ? $formmeta->HHAop086 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Shower</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop087' label='' checked='{{ isset($formmeta->HHAop087) ? $formmeta->HHAop087 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop088' label='' checked='{{ isset($formmeta->HHAop088) ? $formmeta->HHAop088 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop089' label='' checked='{{ isset($formmeta->HHAop089) ? $formmeta->HHAop089 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop090' label='' checked='{{ isset($formmeta->HHAop090) ? $formmeta->HHAop090 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop091' label='' checked='{{ isset($formmeta->HHAop091) ? $formmeta->HHAop091 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop092' label='' checked='{{ isset($formmeta->HHAop092) ? $formmeta->HHAop092 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input id="HHANote12" name="HHANote12" type="text" class="form-control" value="{{ old('HHANote12',isset($formmeta->HHANote12) ? $formmeta->HHANote12 : '') }}"></th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop093' label='' checked='{{ isset($formmeta->HHAop093) ? $formmeta->HHAop093 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop094' label='' checked='{{ isset($formmeta->HHAop094) ? $formmeta->HHAop094 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop095' label='' checked='{{ isset($formmeta->HHAop095) ? $formmeta->HHAop095 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop096' label='' checked='{{ isset($formmeta->HHAop096) ? $formmeta->HHAop096 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop097' label='' checked='{{ isset($formmeta->HHAop097) ? $formmeta->HHAop097 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop098' label='' checked='{{ isset($formmeta->HHAop098) ? $formmeta->HHAop098 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">HOUSEHOLD TASKS</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">A</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Wash Clothes/Bed Linens</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop099' label='' checked='{{ isset($formmeta->HHAop099) ? $formmeta->HHAop099 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop100' label='' checked='{{ isset($formmeta->HHAop100) ? $formmeta->HHAop100 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop101' label='' checked='{{ isset($formmeta->HHAop101) ? $formmeta->HHAop101 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop102' label='' checked='{{ isset($formmeta->HHAop102) ? $formmeta->HHAop102 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop103' label='' checked='{{ isset($formmeta->HHAop103) ? $formmeta->HHAop103 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop104' label='' checked='{{ isset($formmeta->HHAop104) ? $formmeta->HHAop104 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Make Bed</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop105' label='' checked='{{ isset($formmeta->HHAop105) ? $formmeta->HHAop105 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop106' label='' checked='{{ isset($formmeta->HHAop106) ? $formmeta->HHAop106 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop107' label='' checked='{{ isset($formmeta->HHAop107) ? $formmeta->HHAop107 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop108' label='' checked='{{ isset($formmeta->HHAop108) ? $formmeta->HHAop108 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop109' label='' checked='{{ isset($formmeta->HHAop109) ? $formmeta->HHAop109 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop110' label='' checked='{{ isset($formmeta->HHAop110) ? $formmeta->HHAop110 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Change Bed Linens</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop111' label='' checked='{{ isset($formmeta->HHAop111) ? $formmeta->HHAop111 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop112' label='' checked='{{ isset($formmeta->HHAop112) ? $formmeta->HHAop112 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop113' label='' checked='{{ isset($formmeta->HHAop113) ? $formmeta->HHAop113 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop114' label='' checked='{{ isset($formmeta->HHAop114) ? $formmeta->HHAop114 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop115' label='' checked='{{ isset($formmeta->HHAop115) ? $formmeta->HHAop115 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop116' label='' checked='{{ isset($formmeta->HHAop116) ? $formmeta->HHAop116 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tidy Room</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop117' label='' checked='{{ isset($formmeta->HHAop117) ? $formmeta->HHAop117 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop118' label='' checked='{{ isset($formmeta->HHAop118) ? $formmeta->HHAop118 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop119' label='' checked='{{ isset($formmeta->HHAop119) ? $formmeta->HHAop119 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop120' label='' checked='{{ isset($formmeta->HHAop120) ? $formmeta->HHAop120 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop121' label='' checked='{{ isset($formmeta->HHAop121) ? $formmeta->HHAop121 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop122' label='' checked='{{ isset($formmeta->HHAop122) ? $formmeta->HHAop122 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Equipment Care</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop123' label='' checked='{{ isset($formmeta->HHAop123) ? $formmeta->HHAop123 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop124' label='' checked='{{ isset($formmeta->HHAop124) ? $formmeta->HHAop124 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop125' label='' checked='{{ isset($formmeta->HHAop125) ? $formmeta->HHAop125 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop126' label='' checked='{{ isset($formmeta->HHAop126) ? $formmeta->HHAop126 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop127' label='' checked='{{ isset($formmeta->HHAop127) ? $formmeta->HHAop127 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop128' label='' checked='{{ isset($formmeta->HHAop128) ? $formmeta->HHAop128 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Clean Bathroom</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop129' label='' checked='{{ isset($formmeta->HHAop129) ? $formmeta->HHAop129 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop130' label='' checked='{{ isset($formmeta->HHAop130) ? $formmeta->HHAop130 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop131' label='' checked='{{ isset($formmeta->HHAop131) ? $formmeta->HHAop131 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop132' label='' checked='{{ isset($formmeta->HHAop132) ? $formmeta->HHAop132 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop133' label='' checked='{{ isset($formmeta->HHAop133) ? $formmeta->HHAop133 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop134' label='' checked='{{ isset($formmeta->HHAop134) ? $formmeta->HHAop134 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Clean Kitchen</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop135' label='' checked='{{ isset($formmeta->HHAop135) ? $formmeta->HHAop135 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop136' label='' checked='{{ isset($formmeta->HHAop136) ? $formmeta->HHAop136 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop137' label='' checked='{{ isset($formmeta->HHAop137) ? $formmeta->HHAop137 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop138' label='' checked='{{ isset($formmeta->HHAop138) ? $formmeta->HHAop138 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop139' label='' checked='{{ isset($formmeta->HHAop139) ? $formmeta->HHAop139 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop140' label='' checked='{{ isset($formmeta->HHAop140) ? $formmeta->HHAop140 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input id="HHANote13" name="HHANote13" type="text" class="form-control" value="{{ old('HHANote13',isset($formmeta->HHANote13) ? $formmeta->HHANote13 : '') }}"></th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop141' label='' checked='{{ isset($formmeta->HHAop141) ? $formmeta->HHAop141 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop142' label='' checked='{{ isset($formmeta->HHAop142) ? $formmeta->HHAop142 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop143' label='' checked='{{ isset($formmeta->HHAop143) ? $formmeta->HHAop143 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop144' label='' checked='{{ isset($formmeta->HHAop144) ? $formmeta->HHAop144 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop145' label='' checked='{{ isset($formmeta->HHAop145) ? $formmeta->HHAop145 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop146' label='' checked='{{ isset($formmeta->HHAop146) ? $formmeta->HHAop146 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">NUTRITION</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">A</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Meal Preparation</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop147' label='' checked='{{ isset($formmeta->HHAop147) ? $formmeta->HHAop147 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop148' label='' checked='{{ isset($formmeta->HHAop148) ? $formmeta->HHAop148 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop149' label='' checked='{{ isset($formmeta->HHAop149) ? $formmeta->HHAop149 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop150' label='' checked='{{ isset($formmeta->HHAop150) ? $formmeta->HHAop150 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop151' label='' checked='{{ isset($formmeta->HHAop151) ? $formmeta->HHAop151 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop152' label='' checked='{{ isset($formmeta->HHAop152) ? $formmeta->HHAop152 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Assist with Feeding</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop153' label='' checked='{{ isset($formmeta->HHAop153) ? $formmeta->HHAop153 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop154' label='' checked='{{ isset($formmeta->HHAop154) ? $formmeta->HHAop154 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop155' label='' checked='{{ isset($formmeta->HHAop155) ? $formmeta->HHAop155 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop156' label='' checked='{{ isset($formmeta->HHAop156) ? $formmeta->HHAop156 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop157' label='' checked='{{ isset($formmeta->HHAop157) ? $formmeta->HHAop157 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop158' label='' checked='{{ isset($formmeta->HHAop158) ? $formmeta->HHAop158 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Encourage Fluids</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop159' label='' checked='{{ isset($formmeta->HHAop159) ? $formmeta->HHAop159 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop160' label='' checked='{{ isset($formmeta->HHAop160) ? $formmeta->HHAop160 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop161' label='' checked='{{ isset($formmeta->HHAop161) ? $formmeta->HHAop161 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop162' label='' checked='{{ isset($formmeta->HHAop162) ? $formmeta->HHAop162 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop163' label='' checked='{{ isset($formmeta->HHAop163) ? $formmeta->HHAop163 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop164' label='' checked='{{ isset($formmeta->HHAop164) ? $formmeta->HHAop164 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Limit Fluids</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop165' label='' checked='{{ isset($formmeta->HHAop165) ? $formmeta->HHAop165 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop166' label='' checked='{{ isset($formmeta->HHAop166) ? $formmeta->HHAop166 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop167' label='' checked='{{ isset($formmeta->HHAop167) ? $formmeta->HHAop167 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop168' label='' checked='{{ isset($formmeta->HHAop168) ? $formmeta->HHAop168 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop169' label='' checked='{{ isset($formmeta->HHAop169) ? $formmeta->HHAop169 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop170' label='' checked='{{ isset($formmeta->HHAop170) ? $formmeta->HHAop170 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input id="HHANote14" name="HHANote14" type="text" class="form-control" value="{{ old('HHANote14',isset($formmeta->HHANote14) ? $formmeta->HHANote14 : '') }}"></th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop171' label='' checked='{{ isset($formmeta->HHAop171) ? $formmeta->HHAop171 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop172' label='' checked='{{ isset($formmeta->HHAop172) ? $formmeta->HHAop172 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop173' label='' checked='{{ isset($formmeta->HHAop173) ? $formmeta->HHAop173 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop174' label='' checked='{{ isset($formmeta->HHAop174) ? $formmeta->HHAop174 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop175' label='' checked='{{ isset($formmeta->HHAop175) ? $formmeta->HHAop175 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop176' label='' checked='{{ isset($formmeta->HHAop176) ? $formmeta->HHAop176 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">ACTIVITIES</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">A</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Ambulation Assit: W/C, Walker, Cane</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop177' label='' checked='{{ isset($formmeta->HHAop177) ? $formmeta->HHAop177 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop178' label='' checked='{{ isset($formmeta->HHAop178) ? $formmeta->HHAop178 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop179' label='' checked='{{ isset($formmeta->HHAop179) ? $formmeta->HHAop179 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop180' label='' checked='{{ isset($formmeta->HHAop180) ? $formmeta->HHAop180 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop181' label='' checked='{{ isset($formmeta->HHAop181) ? $formmeta->HHAop181 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop182' label='' checked='{{ isset($formmeta->HHAop182) ? $formmeta->HHAop182 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mobility/Transfer Assist: Chair, Bed, Dangle, Commode, Shower/Tub</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop183' label='' checked='{{ isset($formmeta->HHAop183) ? $formmeta->HHAop183 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop184' label='' checked='{{ isset($formmeta->HHAop184) ? $formmeta->HHAop184 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop185' label='' checked='{{ isset($formmeta->HHAop185) ? $formmeta->HHAop185 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop186' label='' checked='{{ isset($formmeta->HHAop186) ? $formmeta->HHAop186 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop187' label='' checked='{{ isset($formmeta->HHAop187) ? $formmeta->HHAop187 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop188' label='' checked='{{ isset($formmeta->HHAop188) ? $formmeta->HHAop188 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Turn and Position</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop189' label='' checked='{{ isset($formmeta->HHAop189) ? $formmeta->HHAop189 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop190' label='' checked='{{ isset($formmeta->HHAop190) ? $formmeta->HHAop190 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop191' label='' checked='{{ isset($formmeta->HHAop191) ? $formmeta->HHAop191 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop192' label='' checked='{{ isset($formmeta->HHAop192) ? $formmeta->HHAop192 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop193' label='' checked='{{ isset($formmeta->HHAop193) ? $formmeta->HHAop193 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop194' label='' checked='{{ isset($formmeta->HHAop194) ? $formmeta->HHAop194 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Safety Check</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop195' label='' checked='{{ isset($formmeta->HHAop195) ? $formmeta->HHAop195 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop196' label='' checked='{{ isset($formmeta->HHAop196) ? $formmeta->HHAop196 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop197' label='' checked='{{ isset($formmeta->HHAop197) ? $formmeta->HHAop197 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop198' label='' checked='{{ isset($formmeta->HHAop198) ? $formmeta->HHAop198 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop199' label='' checked='{{ isset($formmeta->HHAop199) ? $formmeta->HHAop199 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop200' label='' checked='{{ isset($formmeta->HHAop200) ? $formmeta->HHAop200 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Universal Precautions</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop201' label='' checked='{{ isset($formmeta->HHAop201) ? $formmeta->HHAop201 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop202' label='' checked='{{ isset($formmeta->HHAop202) ? $formmeta->HHAop202 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop203' label='' checked='{{ isset($formmeta->HHAop203) ? $formmeta->HHAop203 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop204' label='' checked='{{ isset($formmeta->HHAop204) ? $formmeta->HHAop204 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop205' label='' checked='{{ isset($formmeta->HHAop205) ? $formmeta->HHAop205 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop206' label='' checked='{{ isset($formmeta->HHAop206) ? $formmeta->HHAop206 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Assist with Exercises</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop207' label='' checked='{{ isset($formmeta->HHAop207) ? $formmeta->HHAop207 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop208' label='' checked='{{ isset($formmeta->HHAop208) ? $formmeta->HHAop208 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop209' label='' checked='{{ isset($formmeta->HHAop209) ? $formmeta->HHAop209 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop210' label='' checked='{{ isset($formmeta->HHAop210) ? $formmeta->HHAop210 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop211' label='' checked='{{ isset($formmeta->HHAop211) ? $formmeta->HHAop211 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop212' label='' checked='{{ isset($formmeta->HHAop212) ? $formmeta->HHAop212 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input id="HHANote15" name="HHANote15" type="text" class="form-control" value="{{ old('HHANote15',isset($formmeta->HHANote15) ? $formmeta->HHANote15 : '') }}"></th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop213' label='' checked='{{ isset($formmeta->HHAop213) ? $formmeta->HHAop213 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop214' label='' checked='{{ isset($formmeta->HHAop214) ? $formmeta->HHAop214 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop215' label='' checked='{{ isset($formmeta->HHAop215) ? $formmeta->HHAop215 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop216' label='' checked='{{ isset($formmeta->HHAop216) ? $formmeta->HHAop216 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop217' label='' checked='{{ isset($formmeta->HHAop217) ? $formmeta->HHAop217 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop218' label='' checked='{{ isset($formmeta->HHAop218) ? $formmeta->HHAop218 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table mb-2">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">PROCEDURES</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">A</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Record Bowel Movement</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop219' label='' checked='{{ isset($formmeta->HHAop219) ? $formmeta->HHAop219 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop220' label='' checked='{{ isset($formmeta->HHAop220) ? $formmeta->HHAop220 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop221' label='' checked='{{ isset($formmeta->HHAop221) ? $formmeta->HHAop221 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop222' label='' checked='{{ isset($formmeta->HHAop222) ? $formmeta->HHAop222 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop223' label='' checked='{{ isset($formmeta->HHAop223) ? $formmeta->HHAop223 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop224' label='' checked='{{ isset($formmeta->HHAop224) ? $formmeta->HHAop224 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label for="example-datetime-local-input" class="form-label">Date of Last BM</label>
                                                    <input class="form-control" type="date" value="{{ now('America/Chicago') }}" name="HHADate001" id="HHADate001">
                                                </td>
                                                <td colspan="6">

                                                </td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Assist with Elimination</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop225' label='' checked='{{ isset($formmeta->HHAop225) ? $formmeta->HHAop225 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop226' label='' checked='{{ isset($formmeta->HHAop226) ? $formmeta->HHAop226 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop227' label='' checked='{{ isset($formmeta->HHAop227) ? $formmeta->HHAop227 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop228' label='' checked='{{ isset($formmeta->HHAop228) ? $formmeta->HHAop228 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop229' label='' checked='{{ isset($formmeta->HHAop229) ? $formmeta->HHAop229 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop230' label='' checked='{{ isset($formmeta->HHAop230) ? $formmeta->HHAop230 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Catheter Care</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop231' label='' checked='{{ isset($formmeta->HHAop231) ? $formmeta->HHAop231 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop232' label='' checked='{{ isset($formmeta->HHAop232) ? $formmeta->HHAop232 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop233' label='' checked='{{ isset($formmeta->HHAop233) ? $formmeta->HHAop233 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop234' label='' checked='{{ isset($formmeta->HHAop234) ? $formmeta->HHAop234 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop235' label='' checked='{{ isset($formmeta->HHAop235) ? $formmeta->HHAop235 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop236' label='' checked='{{ isset($formmeta->HHAop236) ? $formmeta->HHAop236 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Empty Catheter Bag</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop237' label='' checked='{{ isset($formmeta->HHAop237) ? $formmeta->HHAop237 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop238' label='' checked='{{ isset($formmeta->HHAop238) ? $formmeta->HHAop238 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop239' label='' checked='{{ isset($formmeta->HHAop239) ? $formmeta->HHAop239 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop240' label='' checked='{{ isset($formmeta->HHAop240) ? $formmeta->HHAop240 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop241' label='' checked='{{ isset($formmeta->HHAop241) ? $formmeta->HHAop241 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop242' label='' checked='{{ isset($formmeta->HHAop242) ? $formmeta->HHAop242 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Inspect/Reinforce Dressing</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop243' label='' checked='{{ isset($formmeta->HHAop243) ? $formmeta->HHAop243 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop244' label='' checked='{{ isset($formmeta->HHAop244) ? $formmeta->HHAop244 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop245' label='' checked='{{ isset($formmeta->HHAop245) ? $formmeta->HHAop245 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop246' label='' checked='{{ isset($formmeta->HHAop246) ? $formmeta->HHAop246 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop247' label='' checked='{{ isset($formmeta->HHAop247) ? $formmeta->HHAop247 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop248' label='' checked='{{ isset($formmeta->HHAop248) ? $formmeta->HHAop248 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Medication Reminder </th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop249' label='' checked='{{ isset($formmeta->HHAop249) ? $formmeta->HHAop249 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop250' label='' checked='{{ isset($formmeta->HHAop250) ? $formmeta->HHAop250 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop251' label='' checked='{{ isset($formmeta->HHAop251) ? $formmeta->HHAop251 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop252' label='' checked='{{ isset($formmeta->HHAop252) ? $formmeta->HHAop252 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop253' label='' checked='{{ isset($formmeta->HHAop253) ? $formmeta->HHAop253 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop254' label='' checked='{{ isset($formmeta->HHAop254) ? $formmeta->HHAop254 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input id="HHANote16" name="HHANote16" type="text" class="form-control" value="{{ old('HHANote16',isset($formmeta->HHANote16) ? $formmeta->HHANote16 : '') }}"></th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop255' label='' checked='{{ isset($formmeta->HHAop255) ? $formmeta->HHAop255 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop256' label='' checked='{{ isset($formmeta->HHAop256) ? $formmeta->HHAop256 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop257' label='' checked='{{ isset($formmeta->HHAop257) ? $formmeta->HHAop257 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop258' label='' checked='{{ isset($formmeta->HHAop258) ? $formmeta->HHAop258 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop259' label='' checked='{{ isset($formmeta->HHAop259) ? $formmeta->HHAop259 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop260' label='' checked='{{ isset($formmeta->HHAop260) ? $formmeta->HHAop260 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-3">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%">HYGIENE/GROOMING/SKIN</th>
                                                <th style="width: 10%">QV</th>
                                                <th style="width: 10%">QW</th>
                                                <th style="width: 10%">DONE</th>
                                                <th style="width: 10%">REFUSE</th>
                                                <th style="width: 10%">N/A</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Personal Care</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop261' label='' checked='{{ isset($formmeta->HHAop261) ? $formmeta->HHAop261 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop262' label='' checked='{{ isset($formmeta->HHAop262) ? $formmeta->HHAop262 : "" }}' />
                                                </td>

                                                <td>
                                                    <x-forms.Checkbox name='HHAop264' label='' checked='{{ isset($formmeta->HHAop264) ? $formmeta->HHAop264 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop265' label='' checked='{{ isset($formmeta->HHAop265) ? $formmeta->HHAop265 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop266' label='' checked='{{ isset($formmeta->HHAop266) ? $formmeta->HHAop266 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Assist with Dressing</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop267' label='' checked='{{ isset($formmeta->HHAop267) ? $formmeta->HHAop267 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop268' label='' checked='{{ isset($formmeta->HHAop268) ? $formmeta->HHAop268 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop270' label='' checked='{{ isset($formmeta->HHAop270) ? $formmeta->HHAop270 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop271' label='' checked='{{ isset($formmeta->HHAop271) ? $formmeta->HHAop271 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop272' label='' checked='{{ isset($formmeta->HHAop272) ? $formmeta->HHAop272 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Hair Care: Comb/Brush</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop273' label='' checked='{{ isset($formmeta->HHAop273) ? $formmeta->HHAop273 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop274' label='' checked='{{ isset($formmeta->HHAop274) ? $formmeta->HHAop274 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop276' label='' checked='{{ isset($formmeta->HHAop276) ? $formmeta->HHAop276 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop277' label='' checked='{{ isset($formmeta->HHAop277) ? $formmeta->HHAop277 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop278' label='' checked='{{ isset($formmeta->HHAop278) ? $formmeta->HHAop278 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Shampoo Hair</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop279' label='' checked='{{ isset($formmeta->HHAop279) ? $formmeta->HHAop279 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop280' label='' checked='{{ isset($formmeta->HHAop280) ? $formmeta->HHAop280 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop282' label='' checked='{{ isset($formmeta->HHAop282) ? $formmeta->HHAop282 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop283' label='' checked='{{ isset($formmeta->HHAop283) ? $formmeta->HHAop283 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop284' label='' checked='{{ isset($formmeta->HHAop284) ? $formmeta->HHAop284 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Skin Care</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop285' label='' checked='{{ isset($formmeta->HHAop285) ? $formmeta->HHAop285 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop286' label='' checked='{{ isset($formmeta->HHAop286) ? $formmeta->HHAop286 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop288' label='' checked='{{ isset($formmeta->HHAop288) ? $formmeta->HHAop288 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop289' label='' checked='{{ isset($formmeta->HHAop289) ? $formmeta->HHAop289 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop290' label='' checked='{{ isset($formmeta->HHAop290) ? $formmeta->HHAop290 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Oral Hygiene </th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop291' label='' checked='{{ isset($formmeta->HHAop291) ? $formmeta->HHAop291 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop292' label='' checked='{{ isset($formmeta->HHAop292) ? $formmeta->HHAop292 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop294' label='' checked='{{ isset($formmeta->HHAop294) ? $formmeta->HHAop294 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop295' label='' checked='{{ isset($formmeta->HHAop295) ? $formmeta->HHAop295 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop296' label='' checked='{{ isset($formmeta->HHAop296) ? $formmeta->HHAop296 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Foot Care</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop297' label='' checked='{{ isset($formmeta->HHAop297) ? $formmeta->HHAop297 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop298' label='' checked='{{ isset($formmeta->HHAop298) ? $formmeta->HHAop298 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop300' label='' checked='{{ isset($formmeta->HHAop300) ? $formmeta->HHAop300 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop301' label='' checked='{{ isset($formmeta->HHAop301) ? $formmeta->HHAop301 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop302' label='' checked='{{ isset($formmeta->HHAop302) ? $formmeta->HHAop302 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nails: Clean/File</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop303' label='' checked='{{ isset($formmeta->HHAop303) ? $formmeta->HHAop303 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop304' label='' checked='{{ isset($formmeta->HHAop304) ? $formmeta->HHAop304 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop306' label='' checked='{{ isset($formmeta->HHAop306) ? $formmeta->HHAop306 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop307' label='' checked='{{ isset($formmeta->HHAop307) ? $formmeta->HHAop307 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop308' label='' checked='{{ isset($formmeta->HHAop308) ? $formmeta->HHAop308 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Pericare</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop309' label='' checked='{{ isset($formmeta->HHAop309) ? $formmeta->HHAop309 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop310' label='' checked='{{ isset($formmeta->HHAop310) ? $formmeta->HHAop310 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop312' label='' checked='{{ isset($formmeta->HHAop312) ? $formmeta->HHAop312 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop313' label='' checked='{{ isset($formmeta->HHAop313) ? $formmeta->HHAop313 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop314' label='' checked='{{ isset($formmeta->HHAop314) ? $formmeta->HHAop314 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Shave</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop315' label='' checked='{{ isset($formmeta->HHAop315) ? $formmeta->HHAop315 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop316' label='' checked='{{ isset($formmeta->HHAop316) ? $formmeta->HHAop316 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop318' label='' checked='{{ isset($formmeta->HHAop318) ? $formmeta->HHAop318 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop319' label='' checked='{{ isset($formmeta->HHAop319) ? $formmeta->HHAop319 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop320' label='' checked='{{ isset($formmeta->HHAop320) ? $formmeta->HHAop320 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Deodorant</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop321' label='' checked='{{ isset($formmeta->HHAop321) ? $formmeta->HHAop321 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop322' label='' checked='{{ isset($formmeta->HHAop322) ? $formmeta->HHAop322 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop324' label='' checked='{{ isset($formmeta->HHAop324) ? $formmeta->HHAop324 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop325' label='' checked='{{ isset($formmeta->HHAop325) ? $formmeta->HHAop325 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop326' label='' checked='{{ isset($formmeta->HHAop326) ? $formmeta->HHAop326 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Check Pressure Areas</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop327' label='' checked='{{ isset($formmeta->HHAop327) ? $formmeta->HHAop327 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop328' label='' checked='{{ isset($formmeta->HHAop328) ? $formmeta->HHAop328 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop330' label='' checked='{{ isset($formmeta->HHAop330) ? $formmeta->HHAop330 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop331' label='' checked='{{ isset($formmeta->HHAop331) ? $formmeta->HHAop331 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop332' label='' checked='{{ isset($formmeta->HHAop332) ? $formmeta->HHAop332 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Back Rub</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop333' label='' checked='{{ isset($formmeta->HHAop333) ? $formmeta->HHAop333 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop334' label='' checked='{{ isset($formmeta->HHAop334) ? $formmeta->HHAop334 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop336' label='' checked='{{ isset($formmeta->HHAop336) ? $formmeta->HHAop336 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop337' label='' checked='{{ isset($formmeta->HHAop337) ? $formmeta->HHAop337 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop338' label='' checked='{{ isset($formmeta->HHAop338) ? $formmeta->HHAop338 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Swab</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop339' label='' checked='{{ isset($formmeta->HHAop339) ? $formmeta->HHAop339 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop340' label='' checked='{{ isset($formmeta->HHAop340) ? $formmeta->HHAop340 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop342' label='' checked='{{ isset($formmeta->HHAop342) ? $formmeta->HHAop342 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop343' label='' checked='{{ isset($formmeta->HHAop343) ? $formmeta->HHAop343 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop344' label='' checked='{{ isset($formmeta->HHAop344) ? $formmeta->HHAop344 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Dentures</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop345' label='' checked='{{ isset($formmeta->HHAop345) ? $formmeta->HHAop345 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop346' label='' checked='{{ isset($formmeta->HHAop346) ? $formmeta->HHAop346 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop348' label='' checked='{{ isset($formmeta->HHAop348) ? $formmeta->HHAop348 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop349' label='' checked='{{ isset($formmeta->HHAop349) ? $formmeta->HHAop349 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop350' label='' checked='{{ isset($formmeta->HHAop350) ? $formmeta->HHAop350 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Assess Skin Condition</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop351' label='' checked='{{ isset($formmeta->HHAop351) ? $formmeta->HHAop351 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop352' label='' checked='{{ isset($formmeta->HHAop352) ? $formmeta->HHAop352 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop354' label='' checked='{{ isset($formmeta->HHAop354) ? $formmeta->HHAop354 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop355' label='' checked='{{ isset($formmeta->HHAop355) ? $formmeta->HHAop355 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop356' label='' checked='{{ isset($formmeta->HHAop356) ? $formmeta->HHAop356 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Assess for Reddened Areas</th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop357' label='' checked='{{ isset($formmeta->HHAop357) ? $formmeta->HHAop357 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop358' label='' checked='{{ isset($formmeta->HHAop358) ? $formmeta->HHAop358 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop360' label='' checked='{{ isset($formmeta->HHAop360) ? $formmeta->HHAop360 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop361' label='' checked='{{ isset($formmeta->HHAop361) ? $formmeta->HHAop361 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop362' label='' checked='{{ isset($formmeta->HHAop362) ? $formmeta->HHAop362 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input id="HHANote19" name="HHANote19" type="text" class="form-control" value="{{ old('HHANote19',isset($formmeta->HHANote19) ? $formmeta->HHANote19 : '') }}"></th>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop363' label='' checked='{{ isset($formmeta->HHAop357) ? $formmeta->HHAop357 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop364' label='' checked='{{ isset($formmeta->HHAop358) ? $formmeta->HHAop358 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop366' label='' checked='{{ isset($formmeta->HHAop360) ? $formmeta->HHAop360 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop367' label='' checked='{{ isset($formmeta->HHAop361) ? $formmeta->HHAop361 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkbox name='HHAop368' label='' checked='{{ isset($formmeta->HHAop362) ? $formmeta->HHAop362 : "" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Aide Reports/Comments</h5>
                    <div class="card-body p-4 pb-3">
                        <textarea class="form-control" name='HHANote17' id='HHANote17' rows="3">{{ old('HHANote17',isset($formmeta->HHANote17) ? $formmeta->HHANote17 : '') }}</textarea>
                    </div>
                </div>
                <div class="btn-float">
                    <button type="submit" class="btn btn-primary waves-effect waves-light align-middle icon-btn" form="visitformmeta"> <i data-feather="save" class=" icon-xxl"></i></button>
                </div>
            </form>
            <div class="modal fade bs-diagnoses-modal-lg" tabindex="-1" role="dialog" aria-labelledby="diagnosesLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="diagnosesLabel">Add Diagnosis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('diagnosis.store')}}" method="POST" id="diagmodalform">
                                @csrf
                                @method('POST')
                                <div class="pt-2">
                                    <h5 class="font-size-16 mb-1 text-uppercase">{{ ucfirst($pt->last_name) }}, {{ ucfirst($pt->first_name) }}</h5>
                                    <div>{{ \Carbon\Carbon::parse($pt->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}, {{ ucfirst($pt->gender) }}</div>
                                    <div class="row pt-2">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Search</label>
                                            <input class="form-control" type="text" id="icd10_search" name="icd10_search">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Selected icd10 code</label>
                                            <input class="form-control" readonly type="text" id="ICD10" name="ICD10">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Description</label>
                                            <input class="form-control" readonly type="text" id="ICD10Description" name="ICD10Description">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-check-input px-1" type="checkbox" id="primarydiag" name="primarydiag" value="1">
                                            <label class="form-check-label" for="primarydiag">
                                                Primary Diagnosis
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name='Patient_id' value="{{ $pt->id}}" hidden>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" form="diagmodalform">Save</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade bs-vitals-modal-lg" tabindex="-1" role="dialog" aria-labelledby="vitalsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="vitalsLabel">Add Vitals</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('visits.storevitals')}}" method="POST" id="vitalsmodalform">
                                @csrf
                                @method('POST')
                                <div class="pt-2">
                                    <h5 class="font-size-16 mb-1 text-uppercase">{{ ucfirst($pt->last_name) }}, {{ ucfirst($pt->first_name) }}</h5>
                                    <div>{{ \Carbon\Carbon::parse($pt->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}, {{ ucfirst($pt->gender) }}</div>
                                    <div class="row pt-2">
                                        <div class="mb-3">
                                            <label for=""><strong>Blood Pressure</strong></label>
                                            <div class=" form-group">
                                                <input class="form-check-input px-1" type="radio" id="BPSide" name="BPSide" value="L">
                                                <label class="form-check-label m-r-15" for="primarydiag">Left</label>
                                                <input class="form-check-input px-1" type="radio" id="BPSide" name="BPSide" value="R">
                                                <label class="form-check-label m-r-15" for="primarydiag">Right</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Lying</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="BPLying">
                                                </div>
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Sitting</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="BPSitting">
                                                </div>
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Standing</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="BPStanding">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Temperature</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="Temperature">
                                                </div>
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Respirations</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="Respirations">
                                                </div>
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Weight (lbs)</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="Weight">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Apical Pulse</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="Apical_Pulse">
                                                </div>
                                                <div class="mb-1">
                                                    <label for="example-text-input" class="form-label">Radial Pulse</label>
                                                    <input class="form-control" type="text" id="icd10_search" name="Radial_Pulse">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-check-input px-1" type="checkbox" id="OutofRange" name="OutofRange" value="1">
                                            <label class="form-check-label m-r-15" for="primarydiag">Vital parameters out of range.</label>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name='form_id' value="{{ $visitform->id}}" hidden>
                                <input type="text" name='Patient_id' value="{{ $pt->id}}" hidden>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" form="vitalsmodalform">Save</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/pages/form-mask.init.js') }}"></script>
<script src="{{ asset('js/pages/profile.init.js') }}"></script>
@endsection