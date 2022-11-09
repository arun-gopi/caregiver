@extends('layouts.app')

@section('title','Edit Profile | Care Giver')
@section('style')
<link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

<!-- datepicker css -->
<link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">

@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-4">

                    <form action="{{ route('patients.update', $patient->uuid) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="pt-4">
                            <blockquote>Basic Information</blockquote>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">First Name</label>
                                            <input class="form-control" type="text" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name', $patient->first_name) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Gender</label>
                                            <input class="form-control" type="text" id="gender" placeholder="Gender" name="gender" value="{{ old('gender', $patient->gender) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Address</label>
                                            <input class="form-control" type="text" id="address" placeholder="Address" name="address" value="{{ old('address', $patient->address) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-tel-input" class="form-label">City</label>
                                            <input class="form-control" type="text" id="city" placeholder="City" name="city" value="{{ old('city', $patient->city) }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">State</label>
                                                    <input class="form-control" type="text" id="state" placeholder="State" name="state" value="{{ old('state', $patient->state) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-password-input">Zip</label>
                                                    <input class="form-control zip-mask" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip', $patient->zip) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Last Name</label>
                                            <input class="form-control" type="text" id="last_name" placeholder="Last Name" name="last_name" value="{{ old('last_name', $patient->last_name) }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">Date of Birth</label>
                                                    <input class="form-control" type="date" id="birthday" placeholder="Date of Birth" name="birthday" value="{{ old('birthday', $patient->birthday) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">SSN</label>
                                                    <input class="form-control ssn-mask" type="text" id="ssn-mask" placeholder="SSN" name="ssn" value="{{ old('ssn', $patient->ssn) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Email</label>
                                            <input class="form-control" type="text" id="email" placeholder="Email" name="email" value="{{ old('email', $patient->email) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Mobile Phone</label>
                                            <input class="form-control mobile-mask" type="text" id="mobile" placeholder="Mobile Phone" name="mobile" value="{{ old('mobile', $patient->mobile) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Home Phone</label>
                                            <input class="form-control homephone-mask" type="text" id="homephone" placeholder="Home Phone" name="homephone" value="{{ old('homephone', $patient->homephone) }}">
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
                                        <input class="form-control" type="text" id="pri_insurance" placeholder="Insurance Payer" name="pri_insurance" value="{{ old('pri_insurance', $patient->pri_insurance) }}">
                                    </div>


                                    <div class="mb-3">
                                        <label for="choices-single-default" class="form-label font-size-13 text-muted">Default</label>
                                        <select class="form-control" data-trigger name="choices-single-default" id="choices-single-default" placeholder="This is a search placeholder">
                                            <option value="">This is a placeholder</option>
                                            <option value="Choice 1">Choice 1</option>
                                            <option value="Choice 2">Choice 2</option>
                                            <option value="Choice 3">Choice 3</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="pri_insurance_id" class="form-label">Insurance ID</label>
                                        <input class="form-control" type="text" id="pri_insurance_id" placeholder="Insurance ID" name="pri_insurance_id" value="{{ old('pri_insurance_id', $patient->pri_insurance_id) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <blockquote>Secondary Insurance</blockquote>
                                    <div class="mb-3">
                                        <label for="sec_insurance" class="form-label">Insurance Payer</label>
                                        <input class="form-control" type="text" id="sec_insurance" placeholder="Insurance Payer" name="sec_insurance" value="{{ old('sec_insurance', $patient->sec_insurance) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sec_insurance_id" class="form-label">Insurance ID</label>
                                        <input class="form-control" type="text" id="sec_insurance_id" placeholder="Insurance ID" name="sec_insurance_id" value="{{ old('sec_insurance_id', $patient->sec_insurance_id) }}">
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
                                            <label for="example-text-input" class="form-label">First Name</label>
                                            <input class="form-control" type="text" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name', $patient->first_name) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Gender</label>
                                            <input class="form-control" type="text" id="gender" placeholder="Gender" name="gender" value="{{ old('gender', $patient->gender) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Address</label>
                                            <input class="form-control" type="text" id="address" placeholder="Address" name="address" value="{{ old('address', $patient->address) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-tel-input" class="form-label">City</label>
                                            <input class="form-control" type="text" id="city" placeholder="City" name="city" value="{{ old('city', $patient->city) }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">State</label>
                                                    <input class="form-control" type="text" id="state" placeholder="State" name="state" value="{{ old('state', $patient->state) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-password-input">Zip</label>
                                                    <input class="form-control zip-mask" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip', $patient->zip) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Last Name</label>
                                            <input class="form-control" type="text" id="last_name" placeholder="Last Name" name="last_name" value="{{ old('last_name', $patient->last_name) }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">Date of Birth</label>
                                                    <input class="form-control" type="date" id="birthday" placeholder="Date of Birth" name="birthday" value="{{ old('birthday', $patient->birthday) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">SSN</label>
                                                    <input class="form-control ssn-mask" type="text" id="ssn-mask" placeholder="SSN" name="ssn" value="{{ old('ssn', $patient->ssn) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Email</label>
                                            <input class="form-control" type="text" id="email" placeholder="Email" name="email" value="{{ old('email', $patient->email) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Mobile Phone</label>
                                            <input class="form-control mobile-mask" type="text" id="mobile" placeholder="Mobile Phone" name="mobile" value="{{ old('mobile', $patient->mobile) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Home Phone</label>
                                            <input class="form-control homephone-mask" type="text" id="homephone" placeholder="Home Phone" name="homephone" value="{{ old('homephone', $patient->homephone) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label for="choices-single-default" class="form-label font-size-13 text-muted">Default</label>
                        <select class="form-control choices" data-type="select-one" data-trigger name="choices-single-default" id="choices-single-default" placeholder="This is a search placeholder">
                            <option value="">This is a placeholder</option>
                            <option value="Choice 1">Choice 1</option>
                            <option value="Choice 2">Choice 2</option>
                            <option value="Choice 3">Choice 3</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label for="choices-single-groups" class="form-label font-size-13 text-muted">Option
                            groups</label>
                        <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups">
                            <option value="">Choose a city</option>
                            <optgroup label="UK">
                                <option value="London">London</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Liverpool">Liverpool</option>
                            </optgroup>
                            <optgroup label="FR">
                                <option value="Paris">Paris</option>
                                <option value="Lyon">Lyon</option>
                                <option value="Marseille">Marseille</option>
                            </optgroup>
                            <optgroup label="DE" disabled>
                                <option value="Hamburg">Hamburg</option>
                                <option value="Munich">Munich</option>
                                <option value="Berlin">Berlin</option>
                            </optgroup>
                            <optgroup label="US">
                                <option value="New York">New York</option>
                                <option value="Washington" disabled>Washington</option>
                                <option value="Michigan">Michigan</option>
                            </optgroup>
                            <optgroup label="SP">
                                <option value="Madrid">Madrid</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Malaga">Malaga</option>
                            </optgroup>
                            <optgroup label="CA">
                                <option value="Montreal">Montreal</option>
                                <option value="Toronto">Toronto</option>
                                <option value="Vancouver">Vancouver</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label for="choices-single-no-search" class="form-label font-size-13 text-muted">Options added
                            via config with no search</label>
                        <select class="form-control" name="choices-single-no-search" id="choices-single-no-search">
                            <option value="0">Zero</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Select</label>
                        <select class="form-control form-select">
                            <option>Select</option>
                            <option>Large select</option>
                            <option>Small select</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="input-datalist">Timezone</label>
                            <input type="text" class="form-control" placeholder="Timezone" list="list-timezone" id="input-datalist">
                            <datalist id="list-timezone">
                                <option>Asia/Aden</option>
                                <option>Asia/Aqtau</option>
                                <option>Asia/Baghdad</option>
                                <option>Asia/Barnaul</option>
                                <option>Asia/Chita</option>
                                <option>Asia/Dhaka</option>
                                <option>Asia/Famagusta</option>
                                <option>Asia/Hong_Kong</option>
                                <option>Asia/Jayapura</option>
                                <option>Asia/Kuala_Lumpur</option>
                                <option>Asia/Jakarta</option>
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
</div> <!-- container-fluid -->
@endsection

@section('script')
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<!-- color picker js -->
<script src="{{ asset('libs/@simonwep/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

<!-- datepicker js -->
<script src="{{ asset('libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
@endsection