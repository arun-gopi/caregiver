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
                <div class="card-header d-flex justify-content-between">
                    <h4>{{$company->company_name}}</h4>
                    <!-- <a href="#">
                        <button type="button" class="btn btn-light waves-effect waves-light">
                            <i class="bx bx-plus font-size-16 align-middle mr-2"></i> New Company
                        </button>
                    </a> -->
                </div>
                <!-- <h5 class="card-header bg-transparent border-bottom text-uppercase">Companies </h5> -->
                <div class="card-body p-4 pb-3">
                    <div class="mb-3">
                        <!-- <form action="{{ route('settings.addcompany') }}" id="companyform" method="POST">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Company Name</label>
                                        <input class="form-control @error('company_name') is-invalid @enderror" type="text" id="company_name" placeholder="Company Name" name="company_name" value="{{ old('company_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror" type="text" id="address" placeholder="Address" name="address" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="example-tel-input" class="form-label">City</label>
                                        <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" placeholder="City" name="city" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label class="form-label" for="formrow-email-input">State</label>
                                        <input class="form-control @error('state') is-invalid @enderror" type="text" id="state" placeholder="State" name="state" value="{{ old('state') }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label class="form-label" for="formrow-password-input">Zip</label>
                                        <input class="form-control zip-mask @error('zip') is-invalid @enderror" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip') }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <div class="mt-4 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary w-m " form="companyform">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> -->
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th style="width:25%;">Company Name</th>
                                    <th style="width:25%;">Company Address</th>
                                    <th style="width:20%;">Communication</th>
                                    <th style="width:20%;">Credentials</th>
                                    <th style="width:5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                <tr data-entry-id="{{ $company->id }}" class="table-tr">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-uppercase">
                                        <h6>{{$company->company_name}}</h6>
                                    </td>
                                    <td class="text-uppercase">
                                        <p>{{$company->address}}<br>{{$company->city}} {{$company->State}} {{$company->zip}}</p>
                                    </td>
                                    <td>(T) {{$company->phone}} <br>(F) {{$company->fax}}<br>{{$company->email}}</td>
                                    <td>NPI: {{$company->NPI}} <br>TIN: {{$company->TIN}}</td>

                                    <td>
                                        <a href="{{ route('settings.companypreview', $company->uuid) }}">
                                            <i data-feather="edit" class="icon-sm comedit"></i>
                                        </a>
                                        @if(Auth::user()->hasRole('Admin'))
                                        <a href=" javascript:void(0)">
                                            <i data-feather="trash" class="icon-sm comdelete"></i>
                                        </a>
                                        @endif
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">{{ __('No Visits') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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