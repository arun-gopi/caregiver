@extends('layouts.app')

@section('title','COVID-19 SCREENING | Care Giver')

@section('style')

@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm order-2 order-sm-1">
                    <h5 class="modal-title" id="myLargeModalLabel">COVID-19 SCREENING</h5>
                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13 mb-3">
                        <div>{{ \Carbon\Carbon::parse($visitform->visitintime)->isoFormat('MM/DD/YYYY') }}</div>
                    </div>
                </div>
                <div class="col-sm order-1 order-sm-2">
                    <div class="d-flex align-items-start justify-content-end gap-2">
                        <div>
                            <a href="{{ route('visits.edit', $visitform->uuid) }}" class="my-4 align-middle">
                                <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                    <i data-feather="arrow-left" class=" icon-sm me-1 align-middle"></i> Back
                                </button>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('covidscreen.covidpreview', ['id' => $covid19->id]); }}" target="_blank" class="my-4 align-middle">
                                <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                    <i data-feather="printer" class=" icon-sm me-1 align-middle"></i> Print
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('covidscreen.updatedata', $covid19->id) }}" method="POST" id="covidform">
                @csrf
                @method('PUT')
                <div class="card">
                    <x-flash-message />
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">COVID-19 Screening - Self ({{ $covid19->emp_lname }}, {{ $covid19->emp_fname }} ({{ $covid19->emp_title }}))</h5>

                    <div class="card-body p-4 pb-3">
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Have you traveled to a COVID-19-affected area outside of the U.S. in the past 14 days?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="emp_istravelled" id="emp_istravelled" {{ (isset($covid19->emp_istravelled) && ($covid19->emp_istravelled =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="emp_istravelled" id="emp_istravelled" {{ (isset($covid19->emp_istravelled) && ($covid19->emp_istravelled =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Do you have signs or symptoms of COVID-19, such as fever, chills, repeated shaking with chills, cough, shortness of breath or difficulty breathing, fatigue, muscle or body aches, headache, new loss of tastes or smell, sore throat, congestion or runny nose, diarrhea, nausea or vomiting?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="emp_symptoms" id="emp_symptoms" {{ (isset($covid19->emp_symptoms) && ($covid19->emp_symptoms =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="emp_symptoms" id="emp_symptoms" {{ (isset($covid19->emp_symptoms) && ($covid19->emp_symptoms =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Have you had close contact (been within six feet for over 15 minutes or lived with) a person with COVID-19 in the past 14 days?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="emp_closecontact" id="emp_closecontact" {{ (isset($covid19->emp_closecontact) && ($covid19->emp_closecontact =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="emp_closecontact" id="emp_closecontact" {{ (isset($covid19->emp_closecontact) && ($covid19->emp_closecontact =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Have you been diagnosed with COVID-19 or told by a health care provider that you might have or have COVID-19?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="emp_diagnosedc19" id="emp_diagnosedc19" {{ (isset($covid19->emp_diagnosedc19) && ($covid19->emp_diagnosedc19 =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="emp_diagnosedc19" id="emp_diagnosedc19" {{ (isset($covid19->emp_diagnosedc19) && ($covid19->emp_diagnosedc19 =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Risk Level:</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="emp_risklevel" id="emp_risklevel" {{ (isset($covid19->emp_risklevel) && ($covid19->emp_risklevel =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="emp_risklevel" id="emp_risklevel" {{ (isset($covid19->emp_risklevel) && ($covid19->emp_risklevel =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <div class="d-block"> <label> Employee's Temperature (please write your temperature prior to arrival): </label> </div>
                            <div class="d-block"> <input id="emp_temperature" name="emp_temperature" type="text" class="form-control" value="{{ old('emp_temperature',isset($covid19) ? $covid19->emp_temperature : '') }}"> </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Comment:</label>
                            <textarea class="form-control" placeholder="Enter Comment" id='emp_comment' name='emp_comment' rows="3">{{ old('emp_comment',isset($covid19) ? $covid19->emp_comment : '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">COVID-19 Screening - Patient</h5>
                    <div class="card-body p-4 pb-3">
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Has the patient traveled to a COVID-19 affected area outside of the U.S. in the past 14 days?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="pt_istravelled" id="pt_istravelled" {{ (isset($covid19->pt_istravelled) && ($covid19->pt_istravelled =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="pt_istravelled" id="pt_istravelled" {{ (isset($covid19->pt_istravelled) && ($covid19->pt_istravelled =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Does the patient have signs or symptoms of COVID-19, such as fever, chills, repeated shaking with chills, cough, shortness of breath or difficulty breathing, fatigue, muscle or body aches, headache, new loss of tastes or smell, sore throat, congestion or runny nose, diarrhea, nausea or vomiting?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="pt_symptoms" id="pt_symptoms" {{ (isset($covid19->pt_symptoms) && ($covid19->pt_symptoms =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="pt_symptoms" id="pt_symptoms" {{ (isset($covid19->pt_symptoms) && ($covid19->pt_symptoms =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Has the patient been in close contact with (within six feet for over 15 minutes or has lived with) a person with COVID-19 in the past 14 days?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="pt_closecontact" id="pt_closecontact" {{ (isset($covid19->pt_closecontact) && ($covid19->pt_closecontact =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="pt_closecontact" id="pt_closecontact" {{ (isset($covid19->pt_closecontact) && ($covid19->pt_closecontact =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Has the patient been diagnosed with COVID-19 or been told by a health care provider that the patient might have COVID-19?</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="pt_diagnosedc19" id="pt_diagnosedc19" {{ (isset($covid19->pt_diagnosedc19) && ($covid19->pt_diagnosedc19 =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="pt_diagnosedc19" id="pt_diagnosedc19" {{ (isset($covid19->pt_diagnosedc19) && ($covid19->pt_diagnosedc19 =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-size-14 mb-3"></i>Risk Level:</h5>
                            <div class="form-check mb-3 hstack gap-5">
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='1' name="pt_risklevel" id="pt_risklevel" {{ (isset($covid19->pt_risklevel) && ($covid19->pt_risklevel =='1')) ? 'checked' : '' }}>Yes</label></div>
                                <div class="d-block"> <label><input class="form-check-input" type="radio" value='0' name="pt_risklevel" id="pt_risklevel" {{ (isset($covid19->pt_risklevel) && ($covid19->pt_risklevel =='0')) ? 'checked' : '' }}>No</label></div>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4">
                            <div class="d-block"> <label> Patient's Temperature (please write patient's temperature during the visit): </label> </div>
                            <div class="d-block"> <input id="pt_temperature" name="pt_temperature" type="text" class="form-control" value="{{ old('pt_temperature',isset($covid19->pt_temperature) ? $covid19->pt_temperature : '') }}"> </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Comment:</label>
                            <textarea class="form-control" placeholder="Enter Comment" id='pt_comment' name='pt_comment' rows="3">{{ old('emp_comment',isset($covid19) ? $covid19->pt_comment : '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="btn-float">
                    <button type="submit" class="btn btn-primary waves-effect waves-light align-middle icon-btn" form="covidform"> <i data-feather="save" class=" icon-xxl"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection