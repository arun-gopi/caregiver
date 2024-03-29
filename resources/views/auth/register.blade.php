@extends('layouts.blank')


@section('style')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/twitter-bootstrap-wizard/prettify.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/preloader.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <span class="logo-lg d-flex justify-content-center mb-3">
                    <img src="http://caregiver.test/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Care Giver</span>
                </span>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class=" d-flex justify-content-center">{{ __('Sign Up') }}</h5>
                    <p>If you are joining an organization that already has a Careswitch account, please use their signup link instead of this form. Proceeding will create a new Careswitch organization.</p>
                </div>


                <div class="card-body">

                    <div id="basic-pills-wizard" class="twitter-bs-wizard">
                        <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                            <li class="nav-item">
                                <a href="#user-details" class="nav-link active" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="User Details">
                                        <i class="bx bx-list-ul"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#company-details" class="nav-link" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Company Details">
                                        <i class="bx bx-book-bookmark"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- wizard-nav -->
                        <form method="POST" id="usercompanyform" action="{{ route('register') }}">
                            @csrf
                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <!-- <form method="POST" action="{{ route('register') }}"> -->
                                <!-- @csrf -->
                                <div class="tab-pane active" id="user-details">
                                    <div class="text-center mb-4">
                                        <h5>User Details</h5>
                                        <p class="card-title-desc">Fill all information below</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input" class="form-label">First name</label>
                                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="basicpill-firstname-input" placeholder="Enter Your First Name" value="{{ old('first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="basicpill-lastname-input" class="form-label">Last name</label>
                                                <input type="text" name="last_name" class="form-control  @error('last_name') is-invalid @enderror" id="basicpill-lastname-input" placeholder="Enter Your Last Name" value="{{ old('last_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emg_mobile" class="form-label">Phone</label>
                                                <input class="form-control form-control @error('phone') is-invalid @enderror mobile-mask" type="text" id="emg_mobile" placeholder="Enter your Phone No." name="phone" value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="email-input" class="form-label">Email</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email-input" class="form-label">Password</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" name="password" autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email-input" class="form-label">Confirm Password</label>
                                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="pager wizard twitter-bs-wizard-pager-link d-flex justify-content-between">
                                        <li></li>
                                        <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                    </ul>
                                </div>
                                <!-- tab pane -->
                                <div class="tab-pane" id="company-details">
                                    <div>
                                        <form id="usercompanyform">
                                            <div class="text-center mb-4">
                                                <h5>Business Details</h5>
                                                <p class="card-title-desc">Fill all information below</p>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="company-name" class="form-label">Company Name</label>
                                                    <input type="text" name="company_name" class="form-control  @error('company_name') is-invalid @enderror" id="company-name" placeholder="Enter Company Name" value="{{ old('company_name') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Address</label>
                                                    <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" placeholder="Address" name="address" value="{{ old('address') }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-tel-input" class="form-label">City</label>
                                                        <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" placeholder="City" name="city" value="{{ old('city') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="pri_insurance" class="form-label">State</label>
                                                        <select class="form-control  @error('state') is-invalid @enderror" data-trigger id="choices-single-default" placeholder="Select State" name="state" value="{{ old('state') }}">
                                                            <option value="">Select State</option>
                                                            @forelse($states as $state)
                                                            <option value="{{ $state->state_code}}"> {{ $state->state_code}}-{{ $state->state}}</option>
                                                            @empty
                                                            <option value="">No states found</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow-password-input">Zip</label>
                                                        <input class="form-control @error('zip') is-invalid @enderror zip-mask" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="comp_phone" class="form-label">Phone</label>
                                                        <input class="form-control @error('comp_phone') is-invalid @enderror mobile-mask" type="text" id="comp_phone" placeholder="Phone" name="comp_phone" value="{{ old('comp_phone') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="company_type" class="form-label">Select compnay type</label>
                                                        <select class="form-control  @error('company_type') is-invalid @enderror" data-trigger id="company_type" placeholder="Select company type" name="company_type" value="{{ old('company_type') }}">
                                                            <option value="">Select Company type</option>
                                                            <option value="0">Home Health</option>
                                                            <option value="1">Hospice</option>
                                                        </select>
                                                        @error('company_type')
                                                        <p class="pristine-error text-help"> {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="choices-single-default">Position</label>
                                                        <select class="form-control @error('title') is-invalid @enderror" data-trigger id="choices-single-default" placeholder="Select Position" name="title" value="{{ old('title') }}">
                                                            <option value="">Select Position</option>
                                                            @forelse($titles as $title)
                                                            <option value="{{ $title->name}}"> {{ $title->name}}</option>
                                                            @empty
                                                            <option value="">No Position found</option>
                                                            @endforelse
                                                        </select>
                                                        @error('title')
                                                        <p class="pristine-error text-help"> {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="choices-single-default">Timezone</label>
                                                        <select class="form-control  @error('timezone') is-invalid @enderror" data-trigger id="choices-single-default" placeholder="Select Timezone" name="timezone" value="{{ old('timezone') }}">
                                                            <option value="">Select Timezone</option>
                                                            @forelse($timezones as $timezone)
                                                            <option value="{{ $timezone->Time_Zone}}"> {{ $timezone->Time_Zone}}</option>
                                                            @empty
                                                            <option value="">No Timezone found</option>
                                                            @endforelse
                                                        </select>
                                                        @error('timezone')
                                                        <p class="pristine-error text-help"> {{ $message }} </p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="previous disabled"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                <button type="submit" class="btn btn-primary w-md float-end" form="usercompanyform">Submit</button>
                                                <!-- <li class="float-end"><a href="javascript: void(0);" type="submit" class="btn btn-primary" >Save Changes</a></li> -->
                                            </ul>

                                    </div>
                                </div>
                                <!-- </form> -->
                            </div>
                        </form>
                        <!-- end tab content -->
                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">
                <p class="text-muted mb-0">Do have an account ? <a href="{{route('login')}}" class="text-primary fw-semibold"> Signin now </a> </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('js/pages/form-mask.init.js') }}"></script>
<script src="{{ asset('js/pages/form-wizard.init.js') }}"></script>
@endsection