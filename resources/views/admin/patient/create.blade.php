@extends('layouts.app')

@section('title','Create Patient | Care Giver')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('style')
<link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <x-flash-message />
                <div class="d-flex align-items-start justify-content-end gap-2 pt-4 px-4">
                    <div>
                        <a href="{{ route('patients.index')}}" class="my-4 align-middle">
                            <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                <i data-feather="arrow-left" class=" icon-sm me-1 align-middle"></i> Back to List
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('patients.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="pt-4">
                            <blockquote>Basic Information</blockquote>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">First Name</label>
                                            <input tabindex="1" class="form-control" type="text" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name' )}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gender</label>
                                            <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Gender" name="gender" value="{{ old('gender') }}">
                                                <option value="">Select Gender</option>
                                                @forelse($gender as $ge)
                                                <option value="{{ $ge }}" > {{ $ge}}</option>
                                                @empty
                                                <option value="">No matches found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Address</label>
                                            <input tabindex="5" class="form-control" type="text" id="address" placeholder="Address" name="address" value="{{ old('address') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-tel-input" class="form-label">City</label>
                                            <input tabindex="6" class="form-control" type="text" id="city" placeholder="City" name="city" value="{{ old('city') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="pri_insurance" class="form-label">State</label>
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select State" name="state" value="{{ old('state') }}">
                                                        <option value="">Select State</option>
                                                        @forelse($states as $state)
                                                        <option value="{{ $state->state_code}}"> {{ $state->state_code}}-{{ $state->state}}</option>
                                                        @empty
                                                        <option value="">No states found</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-password-input">Zip</label>
                                                    <input tabindex="8" class="form-control zip-mask" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Last Name</label>
                                            <input tabindex="2" class="form-control" type="text" id="last_name" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">Date of Birth</label>
                                                    <input tabindex="4" class="form-control" type="date" id="birthday" placeholder="Date of Birth" name="birthday" value="{{ old('birthday') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">SSN</label>
                                                    <input tabindex="9" class="form-control ssn-mask" type="text" id="ssn-mask" placeholder="SSN" name="ssn" value="{{ old('ssn') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Email</label>
                                            <input tabindex="10" class="form-control" type="text" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Mobile Phone</label>
                                                    <input tabindex="11" class="form-control mobile-mask" type="text" id="mobile" placeholder="Mobile Phone" name="mobile" value="{{ old('mobile') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Home Phone</label>
                                                    <input tabindex="12" class="form-control homephone-mask" type="text" id="homephone" placeholder="Home Phone" name="homephone" value="{{ old('homephone') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">SOC</label>
                                                    <input tabindex="4" class="form-control" type="date" id="SOC" placeholder="SOC" name="SOC" value="{{ old('SOC') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Date of Discharge</label>
                                                    <input tabindex="4" class="form-control" type="date" id="EOC" placeholder="Date of Discharge" name="EOC" value="{{ old('EOC') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pri_insurance" class="form-label">Physician</label>
                                            <select tabindex="13" class="form-control" data-trigger id="choices-single-default" placeholder="Select Insurance" name="physician_id" value="{{ old('physician_id') }}">
                                                <option value="">Select Physician</option>
                                                @forelse($physicians as $physician)
                                                <option value="{{ $physician->id}}"> {{ $physician->last_name}}, {{ $physician->first_name}} ({{ $physician->Title}})</option>
                                                @empty
                                                <option value="">No Physician found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <blockquote>Primary Insurance</blockquote>
                                    <div class="mb-3">
                                        <label for="pri_insurance" class="form-label">Insurance Payer</label>
                                        <select tabindex="13" class="form-control" data-trigger id="choices-single-default" placeholder="Select Insurance" name="pri_insurance" value="{{ old('pri_insurance') }}">
                                            <option value="">Select Insurance</option>
                                            @forelse($payers as $payer)
                                            <option value="{{ $payer->name}}"> {{ $payer->name}}</option>
                                            @empty
                                            <option value="">No Payer found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pri_insurance_id" class="form-label">Insurance ID</label>
                                        <input tabindex="14" class="form-control" type="text" id="pri_insurance_id" placeholder="Insurance ID" name="pri_insurance_id" value="{{ old('pri_insurance_id') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <blockquote>Secondary Insurance</blockquote>
                                    <div class="mb-3">
                                        <label for="sec_insurance" class="form-label">Insurance Payer</label>
                                        <select tabindex="15" class="form-control" data-trigger id="choices-single-default" placeholder="Select Insurance" name="sec_insurance" value="{{ old('sec_insurance') }}">
                                            <option value="">Select Insurance</option>
                                            @forelse($payers as $payer)
                                            <option value='{{ $payer->name}}'>{{ $payer->name}}</option>
                                            @empty
                                            <option value="">No Payer found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sec_insurance_id" class="form-label">Insurance ID</label>
                                        <input tabindex="16" class="form-control" type="text" id="sec_insurance_id" placeholder="Insurance ID" name="sec_insurance_id" value="{{ old('sec_insurance_id') }}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="pt-4">
                            <blockquote>Emergency Contact</blockquote>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label ">First Name</label>
                                            <input tabindex="17" class="form-control" type="text" id="emg_first_name" placeholder="First Name" name="emg_first_name" value="{{ old('emg_first_name') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Relationship</label>
                                            <input tabindex="19" class="form-control" type="text" id="emg_relationship" placeholder="Relationship" name="emg_relationship" value="{{ old('emg_relationship') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Address</label>
                                            <input tabindex="20" class="form-control" type="text" id="emg_address" placeholder="Address" name="emg_address" value="{{ old('emg_address') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-tel-input" class="form-label">City</label>
                                            <input tabindex="21" class="form-control" type="text" id="emg_city" placeholder="City" name="emg_city" value="{{ old('emg_city') }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="pri_insurance" class="form-label">State</label>
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select State" name="emg_state" value="{{ old('emg_state') }}">
                                                        <option value="">Select State</option>
                                                        @forelse($states as $state)
                                                        <option value="{{ $state->state_code}}"> {{ $state->state_code}}-{{ $state->state}}</option>
                                                        @empty
                                                        <option value="">No states found</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-password-input">Zip</label>
                                                    <input tabindex="23" class="form-control zip-mask" type="text" id="emg_zip" placeholder="Zip" name="emg_zip" value="{{ old('emg_zip') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Last Name</label>
                                            <input tabindex="18" class="form-control" type="text" id="emg_last_name" placeholder="Last Name" name="emg_last_name" value="{{ old('emg_last_name') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Email</label>
                                            <input tabindex="24" class="form-control" type="text" id="emg_email" placeholder="Email" name="emg_email" value="{{ old('emg_email') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Mobile Phone</label>
                                            <input tabindex="26" class="form-control mobile-mask" type="text" id="emg_mobile" placeholder="Mobile Phone" name="emg_mobile" value="{{ old('emg_mobile') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Home Phone</label>
                                            <input tabindex="27" class="form-control homephone-mask" type="text" id="emg_homephone" placeholder="Home Phone" name="emg_homephone" value="{{ old('emg_homephone') }}">
                                        </div>
                                        <div class="mb-3 pt-4">
                                            <input tabindex="28" class="form-check-input px-1" type="checkbox" id="isActive" name="isActive" value="1">
                                            <label class="form-check-label align-item-start " for="formCheck1">
                                                Active Patient
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end">
                            <button tabindex="29" type="submit" class="btn btn-primary w-md">Submit</button>
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