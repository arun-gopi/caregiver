@extends('layouts.app')

@section('title')
Companies | Care Giver
@endsection

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
                <div class="">

                </div>
                <h5 class="card-header bg-transparent border-bottom text-uppercase"> {{$company->company_name}}</h5>
                <div class="card-body p-4 pb-3">
                    <form action="{{ route('settings.updatecompany',$company->id) }}" id="companyform" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Company Name</label>
                                    <input class="form-control  @error('company_name') is-invalid @enderror" type="text" id="company_name" placeholder="Company Name" name="company_name" value="{{ old('company_name',$company->company_name) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Address</label>
                                    <input class="form-control  @error('address') is-invalid @enderror" type="text" id="address" placeholder="Address" name="address" value="{{ old('address',$company->address) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">City</label>
                                    <input class="form-control  @error('city') is-invalid @enderror" type="text" id="city" placeholder="City" name="city" value="{{ old('city',$company->city) }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-email-input">State</label>
                                            <input class="form-control  @error('state') is-invalid @enderror" type="text" id="state" placeholder="State" name="state" value="{{ old('state',$company->state) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-password-input">Zip</label>
                                            <input class="form-control zip-mask  @error('zip') is-invalid @enderror" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip',$company->zip) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="example-date-input" class="form-label">Website</label>
                                            <input class="form-control" type="text" id="website" placeholder="Website" name="website" value="{{ old('website',$company->website) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="example-date-input" class="form-label">Timezone</label>
                                            <input class="form-control" type="text" id="timezone" placeholder="Timezone" name="timezone" value="{{ old('timezone',$company->timezon) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Email</label>
                                    <input class="form-control" type="text" id="email" placeholder="Email" name="email" value="{{ old('email',$company->email) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Phone</label>
                                    <input class="form-control mobile-mask" type="text" id="phone" placeholder="Phone" name="phone" value="{{ old('phone',$company->phone) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fax</label>
                                    <input class="form-control homephone-mask" type="text" id="fax" placeholder="Fax" name="fax" value="{{ old('fax',$company->fax) }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-email-input">NPI</label>
                                            <input class="form-control   @error('NPI') is-invalid @enderror" type="text" id="NPI" placeholder="NPI" name="NPI" value="{{ old('NPI',$company->NPI) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-password-input">TIN</label>
                                            <input class="form-control   @error('TIN') is-invalid @enderror" type="text" id="TIN" placeholder="TIN" name="TIN" value="{{ old('TIN',$company->TIN) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-email-input">Medicare ID</label>
                                            <input class="form-control" type="text" id="MedicareID" placeholder="Medicare ID" name="MedicareID" value="{{ old('MedicareID',$company->MedicareID) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-password-input">Medicaid ID</label>
                                            <input class="form-control" type="text" id="MedicaidID" placeholder="Medicaid ID" name="MedicaidID" value="{{ old('MedicaidID',$company->MedicaidID) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-md ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
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