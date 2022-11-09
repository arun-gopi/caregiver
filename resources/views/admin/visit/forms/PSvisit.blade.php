@extends('layouts.app')

@section('title','Create Visit | Care Giver')

@section('style')
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
                            <h5 class="modal-title" id="myLargeModalLabel">SUPERVISORY VISIT</h5>
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
                                                    <label class="form-label">Supervisor Name</label>
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Supervisor" name="supervisor_id" value="{{ old('supervisor_id',$visitform->supervisor_id) }}">
                                                        <option value="">Select Clinician</option>
                                                        @forelse($clinicians as $clinician)
                                                        <option value="{{ $clinician->id }}" {{ ( $clinician->id === $visitform->supervisor_id) ? 'selected' : '' }}> {{ $clinician->last_name}}, {{ $clinician->first_name}} ({{ $clinician->Title}})</option>
                                                        @empty
                                                        <option value="">No matches found</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Employee Name</label>
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Employee" name="Employee_id" value="{{ old('Employee_id',$visitform->Employee_id) }}">
                                                        <option value="">Select Clinician</option>
                                                        @forelse($clinicians as $clinician)
                                                        <option value="{{ $clinician->id}}" {{ ( $clinician->id === $visitform->Employee_id) ? 'selected' : '' }}> {{ $clinician->last_name}}, {{ $clinician->first_name}} ({{ $clinician->Title}})</option>
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
                                                <div class="mb-3">
                                                    <label for="example-datetime-local-input" class="form-label">Signed on </label>
                                                    <input class="form-control" name='signed_date' type="datetime-local" value="{{ $visitform->signed_date }}" id="signed_date">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
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
            </div>
            <form action="{{ route('visits.updatedata', $visitform->id) }}" method="POST" id="visitformmeta">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Employee Assessment</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Aide present at time of visit</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA001" value="{{ old('EA001',isset($formmeta->EA001) ? $formmeta->EA001 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($yesno as $yn)
                                        <option value="{{ $yn }}" {{ ( $yn === (isset($formmeta->EA001) ? $formmeta->EA001 : '')) ? 'selected' : '' }}> {{ $yn }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aide follow and complete assigned tasks on the Aide Care Plan</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA002" value="{{ old('EA002',isset($formmeta->EA002) ? $formmeta->EA002 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($options as $op)
                                        <option value="{{ $op }}" {{ ( $op === (isset($formmeta->EA002) ? $formmeta->EA002 : '')) ? 'selected' : '' }}> {{ $op }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aide maintain an open communication process with the patient, representative (if any), caregivers and family</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA003" value="{{ old('EA003', isset($formmeta->EA003) ? $formmeta->EA003 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($options as $op)
                                        <option value="{{ $op }}" {{ ( $op === (isset($formmeta->EA003) ? $formmeta->EA003 : '')) ? 'selected' : '' }}> {{ $op }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aide demonstrate competency with assigned tasks</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA004" value="{{ old('EA004',isset($formmeta->EA004) ? $formmeta->EA004 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($options as $op)
                                        <option value="{{ $op }}" {{ ( $op === (isset($formmeta->EA004) ? $formmeta->EA004 : '')) ? 'selected' : '' }}> {{ $op }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aide comply with infection prevention and control policies and procedures including proper hand hygiene and bag technique</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA005" value="{{ old('EA005',isset($formmeta->EA005) ? $formmeta->EA005 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($options as $op)
                                        <option value="{{ $op }}" {{ ( $op === (isset($formmeta->EA005) ? $formmeta->EA005 : '')) ? 'selected' : '' }}> {{ $op }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Aide honor the patient rights, respect the patient privacy and the patient's property</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA006" value="{{ old('EA006',isset($formmeta->EA006) ? $formmeta->EA006 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($options as $op)
                                        <option value="{{ $op }}" {{ ( $op === (isset($formmeta->EA006) ? $formmeta->EA006 : '')) ? 'selected' : '' }}> {{ $op }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aide report changes in the patient's condition to appropriate staff</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA007" value="{{ old('EA007', isset($formmeta->EA007) ? $formmeta->EA007 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($yesno as $yn)
                                        <option value="{{ $yn }}" {{ ( $yn === (isset($formmeta->EA007) ? $formmeta->EA007 : '')) ? 'selected' : '' }}> {{ $yn }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adheres to home health care agency policies and procedures</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA008" value="{{ old('EA008',isset($formmeta->EA008) ? $formmeta->EA008 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($options as $op)
                                        <option value="{{ $op }}" {{ ( $op === (isset($formmeta->EA008) ? $formmeta->EA008 : '')) ? 'selected' : '' }}> {{ $op }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Does the patient have continued need for Aide services?</label>
                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select a value" name="EA009" value="{{ old('EA009',isset($formmeta->EA009) ? $formmeta->EA009 : '') }}">
                                        <option value="">Select a value</option>
                                        @forelse($yesno as $yn)
                                        <option value="{{ $yn }}" {{ ( $yn === (isset($formmeta->EA009) ? $formmeta->EA009 : '')) ? 'selected' : '' }}> {{ $yn }}</option>
                                        @empty
                                        <option value="">No matches found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Comments</h5>
                        <div class="mb-3">
                            <label class="form-label">Comments from Patient</label>
                            <textarea class="form-control" placeholder="Enter Comment" id='EA010' name='EA010' rows="3">{{ old('EA010',isset($formmeta->EA010) ? $formmeta->EA010 : '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Comments/Recommendations/Instructions/Training Required</label>
                            <textarea class="form-control" name='EA011' id='EA011' rows="3" placeholder="Enter Comment">{{ old('EA011',isset($formmeta->EA011) ? $formmeta->EA011 : '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Changes to care plan</label>
                            <textarea class="form-control" placeholder="Enter Comment" id='EA012' name='EA012' rows="3">{{ old('EA012',isset($formmeta->EA012) ? $formmeta->EA012 : '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="btn-float">
                    <button type="submit" class="btn btn-primary waves-effect waves-light align-middle icon-btn" form="visitformmeta"> <i data-feather="save" class=" icon-xxl"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/pages/form-mask.init.js') }}"></script>
@endsection