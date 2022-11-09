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
                <h5 class="modal-title" id="myLargeModalLabel">Create Visit</h5>
                    <form action="{{ route('visits.store')}}" method="POST" id="visitmodalform">
                        @csrf
                        @method('POST')
                        <div class="pt-2">
                            <div class="row pt-2">
                                <div class="col-lg-6">
                                    <div>
                                    <div class="mb-3">
                                            <label class="form-label">Select Patient</label>
                                            <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Patient" name="Patient_id" value="{{ old('Patient_id') }}">
                                                <option value="">Select Patient</option>
                                                @forelse($patients as $patient)
                                                <option value="{{ $patient->id}}">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }} ({{ \Carbon\Carbon::parse($patient->birthday)->isoFormat('MM/DD/YYYY') }})</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Note Type</label>
                                            <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Note Type" name="visit_type" value="{{ old('visit_type') }}">
                                                <option value="">Select Note Type</option>
                                                @forelse($visittypes as $visittype)
                                                <option value="{{ $visittype->typecode}}"> {{ $visittype->typecode}}-{{ $visittype->typedescription}}</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Clinician</label>
                                            <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Clinician" name="Employee_id" value="{{ old('Employee_id') }}">
                                                <option value="">Select Clinician</option>
                                                @forelse($clinicians as $clinician)
                                                <option value="{{ $clinician->id}}"> {{ $clinician->last_name}}, {{ $clinician->first_name}} ({{ $clinician->Title}})</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                            <label class="form-label">Service Type</label>
                                            <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Service Type" name="HCPCS" value="{{ old('HCPCS') }}">
                                                <option value="">Select Service Type</option>
                                                @forelse($servicetypes as $st)
                                                <option value="{{ $st->hcpcscode}}"> {{ $st->hcpcscode}}-{{ $st->hcpcsdescription}}</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Visit Location</label>
                                            <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Visit Location" name="visit_location" value="{{ old('visit_location') }}">
                                                <option value="">Select Visit Location</option>
                                                @forelse($visitlocations as $vl)
                                                <option value="{{ $vl }}"> {{ $vl }}</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-datetime-local-input" class="form-label">Time In</label>
                                                    <input class="form-control" name='visitintime' type="datetime-local" value="{{ now('America/Chicago') }}" id="visitintimepicker">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-datetime-local-input" class="form-label">Time Out</label>
                                                    <input class="form-control" name='visitouttime' type="datetime-local" value="{{ now('America/Chicago') }}" id="visitouttimepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comments</label>
                                <textarea class="form-control" name='Comment' rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" form="visitmodalform">Save Visit</button>
                        </div>
                    </form>


                </div>
            </div>
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