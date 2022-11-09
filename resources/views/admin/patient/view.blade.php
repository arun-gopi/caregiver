@extends('layouts.app')

@section('title','Profile | Care Giver')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('style')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<?php

$fullname = $patient->first_name." ".$patient->last_name;

?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <x-flash-message />
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xl me-3">
                                        <a href="#">
                                            @if (empty($patient->photo ))
                                            <img src="{{ Avatar::create($fullname)->toBase64() }}" alt="" class="img-fluid rounded-circle d-block">
                                            @else
                                            <img src="{{asset('images/users/'.$patient->photo)}}" alt="" class="img-fluid rounded-circle d-block">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1 text-uppercase">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }}</h5>
                                        <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13 mb-3">
                                            <div>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}, {{ ucfirst($patient->gender) }}</div>
                                            <div class="vr"></div>
                                            <div>{{ $patient->address }} <br>
                                                {{ $patient->city }} {{ $patient->state }} - {{ $patient->zip }}
                                            </div>
                                            <div class="vr"></div>
                                            <div>{{ $patient->pri_insurance }} <br>
                                                {{ $patient->pri_insurance_id }}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                            <div><i data-feather="phone" class=" icon-sm me-1 align-middle"></i>M: {{ $patient->mobile }}</div>
                                            <div><i data-feather="mail" class=" icon-sm me-1 align-middle"></i>Email: {{ $patient->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-auto order-1 order-sm-2">
                            <div class="d-flex align-items-start justify-content-end gap-2">
                                <div>
                                    <a href="{{ route('patients.index')}}" class="my-4 align-middle">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                            <i data-feather="arrow-left" class=" icon-sm me-1 align-middle"></i> Back to List
                                        </button>
                                    </a>
                                    <!--    <a href="{{ route('patients.create', $patient->id)}}">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                            <i data-feather="edit-2" class=" icon-sm me-1 align-middle"></i> Edit
                                        </button>
                                    </a> -->
                                </div>
                                <div>
                                    <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target=".bs-visit-modal-lg">Create Visit</button>
                                </div>
                                <div class="modal fade bs-visit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel">Create Visit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('visits.store')}}" method="POST" id="visitmodalform">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="pt-2">
                                                        <h5 class="font-size-16 mb-1 text-uppercase">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }}</h5>
                                                        <div>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}, {{ ucfirst($patient->gender) }}</div>

                                                        <div class="row pt-2">
                                                            <div class="col-lg-6">
                                                                <div>
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
                                                                    <div class="mb-3">
                                                                        <label for="example-datetime-local-input" class="form-label">Time In</label>
                                                                        <input class="form-control" name='visitintime' type="datetime-local" value="{{ now('America/Chicago') }}" id="visitintimepicker">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="example-datetime-local-input" class="form-label">Time Out</label>
                                                                        <input class="form-control" name='visitouttime' type="datetime-local" value="{{ now('America/Chicago') }}" id="visitouttimepicker">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="comment" class="form-label">Comments</label>
                                                            <textarea class="form-control" name='comment' rows="3"></textarea>
                                                            <input type="text" name='Patient_id' value="{{ $patient->id}}" hidden>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" form="visitmodalform">Save Visit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 pb-2 active" data-bs-toggle="tab" href="#chartsummary" role="tab">Chart Summary </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 pb-2 " data-bs-toggle="tab" href="#demographics" role="tab">Demographics </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 pb-2 " data-bs-toggle="tab" href="#medicationhistory" role="tab">Medications </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 pb-2" data-bs-toggle="tab" href="#visithistory" role="tab">Visit History <span class="badge bg-success rounded-pill">{{$visits->count()}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 pb-2" data-bs-toggle="tab" href="#editprofile" role="tab">Edit Profile </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content pt-3 mx-2">
                    <div class="tab-pane" id="demographics" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <h5 class="font-size-16">General</h5>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Contact Number:</th>
                                                            <td>{{ $patient->mobile }}<br>
                                                                {{ $patient->homephone }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email:</th>
                                                            <td> @if (empty($patient->email ))
                                                                -
                                                                @else
                                                                {{ $patient->email }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">SSN:</th>
                                                            <td> @if (empty($patient->ssn ))
                                                                -
                                                                @else
                                                                {{ $patient->ssn }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Date of Birth:</th>
                                                            <td>{{ $patient->birthday }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Age:</th>
                                                            <td>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Gender:</th>
                                                            <td>{{ ucfirst($patient->gender) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Address:</th>
                                                            <td>{{ $patient->address }} <br>
                                                                {{ $patient->city }} {{ $patient->state }} - {{ $patient->zip }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Insurance:</th>
                                                            <td>{{ $patient->pri_insurance }} <br>
                                                                @if (empty($patient->pri_insurance_id ))
                                                                -
                                                                @else
                                                                {{ $patient->pri_insurance_id }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-xl-8">

                                            <h5 class="font-size-16">Emergency Contact</h5>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">First Name:</th>
                                                                <td>{{ $patient->emg_first_name }}<br>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Name:</th>
                                                                <td>{{ $patient->emg_last_name }}<br>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Relationship:</th>
                                                                <td>{{ $patient->emg_relationship }}<br>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Phone:</th>
                                                                <td>{{ $patient->emg_mobile }}<br>
                                                                    {{ $patient->emg_homephone }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email:</th>
                                                                <td>{{ $patient->emg_email }}<br>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="col-xl-6">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Address:</th>
                                                                <td>{{ $patient->emg_address }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">City:</th>
                                                                <td>{{ $patient->emg_city }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">State:</th>
                                                                <td>{{ $patient->emg_state }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Zip:</th>
                                                                <td>{{ $patient->emg_zip }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <div class="tab-pane active" id="chartsummary" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Diagnoses&nbsp;</strong>
                                            <a href=# class="my-4 align-middle">
                                                <i data-feather="plus-circle" class="icon-sm icon-black me-1 align-middle" data-bs-toggle="modal" data-bs-target=".bs-diagnoses-modal-lg"></i>
                                            </a>
                                        </p>
                                        <div class="scroll-list-box p-3 px-2" data-simplebar="init">
                                            <div class="simplebar-wrapper" style="margin: -16px -8px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 16px 8px;">
                                                                @forelse($diagnosis as $diag)
                                                                <p class="font-size-14 mb-1 black">
                                                                    @if($diag->primarydiag ===1) <span class="badge rounded-pill bg-success">P</span> @endif [{{$diag->ICD10}}] {{($diag->ICD10Description) }}
                                                                </p>
                                                                @empty
                                                                <p>{{ __('No Problems Recorded') }}</p>
                                                                @endforelse

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: auto; height: 824px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 418px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Vitals&nbsp;</strong>
                                            <a href=# class="my-4 align-middle">
                                                <i data-feather="plus-circle" class="icon-sm icon-black me-1 align-middle" data-bs-toggle="modal" data-bs-target=".bs-vitals-modal-lg"></i>
                                            </a>
                                        </p>
                                        @if(!empty($vital) || !is_null($vital))
                                        <div class="mb-3">
                                            <label for=""><strong>Blood Pressure:&nbsp;</strong><strong>{{$vital->BPSide === "L" ? "Left":"Right"}} </strong> </label>
                                            <p>@if($vital->OutofRange ===1) <span class="badge rounded-pill bg-danger">Out of range</span> @endif </p>
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Vital Signs</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>BP Lying</td>
                                                        <td>{{$vital->BPLying}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>BP Sitting</td>
                                                        <td>{{$vital->BPSitting}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>BP Standing</td>
                                                        <td>{{$vital->BPStanding}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4</th>
                                                        <td>Temperature</td>
                                                        <td>{{$vital->Temperature}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">5</th>
                                                        <td>Respirations</td>
                                                        <td>{{$vital->Respirations}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">6</th>
                                                        <td>Apical Pulse</td>
                                                        <td>{{$vital->Apical_Pulse}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">7</th>
                                                        <td>Radial Pulse</td>
                                                        <td>{{$vital->Radial_Pulse}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">8</th>
                                                        <td>Weight (lbs)</td>
                                                        <td>{{$vital->Weight}}&nbsp;lbs</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p>{{ __('No Vital Signes Recorded') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <strong>Notes&nbsp;</strong>
                                        </p>
                                        <form action="{{ route('patients.addnote')}}" method="POST" id="notesform">
                                            @csrf
                                            @method('POST')
                                            <div class="hstack gap-3 mb-3">
                                                <input class="form-control" type="text" id="ptNotes" name="message">
                                                <input type="text" name='Patient_id' value="{{ $patient->id}}" hidden>
                                                <input type="text" name='sender_id' value="{{Auth::user()->employee->id}}" hidden>
                                                <button type="submit" class="btn btn-soft-light waves-effect waves-light"><i data-feather="send" class="icon-lg icon-black me-1 align-middle"></i></i></button>
                                            </div>
                                        </form>
                                        <div class="scroll-list-box p-3 px-2" data-simplebar="init">
                                            <div class="simplebar-wrapper" style="margin: -16px -8px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 16px 8px;">
                                                                @forelse($notes as $note)
                                                                <div class="mb-3">
                                                                    <p class="font-size-14 mb-1">{{$note->message}}</p>
                                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-12">
                                                                        <div><i data-feather="user" class=" icon-sm me-1 align-middle"></i>{{ucfirst(strtolower($note->last_name))}}, {{ucfirst(strtolower($note->first_name))}} ({{$note->Title}})</div>
                                                                        <div><i data-feather="clock" class=" icon-sm me-1 align-middle"></i>{{ Carbon\Carbon::parse($note->created_at)->format('m/d/Y h:i A') }}</div>
                                                                    </div>
                                                                </div>
                                                                @empty
                                                                <p>{{ __('No Notes') }}</p>
                                                                @endforelse

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: auto; height: 824px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 418px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="visithistory" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Visit Type</th>
                                            <th>Visit In Time</th>
                                            <th>Visit Out Time</th>
                                            <th>Units</th>
                                            <th>Clinician</th>
                                            <th>Status</th>
                                            <!--    <th>Action</th>  -->
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @forelse($visits as $visit)
                                        <tr data-entry-id="{{ $visit->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div> <a href="{{ route('visits.edit', $visit->uuid) }}" class="stretched-link">{{$visit->visit_type}} Visit</a>
                                                </div>
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($visit->visitintime)->format('m/d/Y h:i A') }}</td>
                                            <td>{{ Carbon\Carbon::parse($visit->visitouttime)->format('m/d/Y h:i A') }}</td>
                                            <td>{{($visit->unit)}} Units</td>
                                            <td>{{ ucfirst($visit->last_name) }}, {{ ucfirst($visit->first_name) }} ({{ ucfirst($visit->Title) }}) </td>
                                            <td>
                                                <div class="text-uppercase">
                                                    @if (empty($visit->signed_date ))
                                                    <span class="badge rounded-pill bg-danger">Unsigned</span>
                                                    @else
                                                    <span class="badge rounded-pill bg-success">Signed</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <!--    <td>
                                            <a href="#">
                                                <i data-feather="eye" class="icon-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i data-feather="edit" class="icon-lg"></i>
                                            </a>
                                            <a href=" javascript:void(0)">
                                                <i data-feather="trash" class="icon-lg"></i>
                                            </a>
                                        </td> -->
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">{{ __('No Visit History') }}</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="medicationhistory" role="tabpanel">

                    </div>
                    <div class="tab-pane" id="editprofile" role="tabpanel">
                        <div class="card">
                            <div class="card-body p-4">
                                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="pt-4">
                                        <blockquote>Basic Information</blockquote>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">First Name</label>
                                                        <input class="form-control" type="text" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name', $patient->first_name) }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="example-text-input" class="form-label">MRN</label>
                                                                <input class="form-control" type="text" id="MRN" placeholder="MRN" name="MRN" value="{{ old('MRN', is_null($patient->MRN)? '': $patient->MRN) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Gender</label>
                                                                <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Gender" name="gender" value="{{ old('gender', $patient->gender) }}">
                                                                    <option value="">Select Gender</option>
                                                                    @forelse($gender as $ge)
                                                                    <option value="{{ $ge }}" {{ ( $ge === $patient->gender) ? 'selected' : '' }}> {{ $ge}}</option>
                                                                    @empty
                                                                    <option value="">No matches found</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
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
                                                                <label for="pri_insurance" class="form-label">State</label>
                                                                <select class="form-control" data-trigger id="choices-single-default" placeholder="Select State" name="state" value="{{ old('state', $patient->state) }}">
                                                                    <option value="">Select State</option>
                                                                    @forelse($states as $state)
                                                                    <option value="{{ $state->state_code}}" {{ ( $state->state_code === $patient->state) ? 'selected' : '' }}> {{ $state->state_code}}-{{ $state->state}}</option>
                                                                    @empty
                                                                    <option value="">No states found</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="formrow-password-input">Zip</label>
                                                                <input class="form-control zip-mask" type="text" id="zip" placeholder="Zip" name="zip" value="{{ old('zip', $patient->zip) }}">
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
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Insurance" name="pri_insurance" value="{{ old('pri_insurance', $patient->pri_insurance) }}">
                                                        <option value="">Select Insurance</option>
                                                        @forelse($payers as $payer)
                                                        <option value="{{ $payer->name}}" {{ ( $payer->name === $patient->pri_insurance) ? 'selected' : '' }}> {{ $payer->name}}</option>
                                                        @empty
                                                        <option value="">No Payer found</option>
                                                        @endforelse
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
                                                    <select class="form-control" data-trigger id="choices-single-default" placeholder="Select Insurance" name="sec_insurance" value="{{ old('sec_insurance', $patient->sec_insurance) }}">
                                                        <option value="">Select Insurance</option>
                                                        @forelse($payers as $payer)
                                                        <option value='{{ $payer->name}}' {{ ( $payer->name === $patient->sec_insurance) ? 'selected' : '' }}>{{ $payer->name}}</option>
                                                        @empty
                                                        <option value="">No Payer found</option>
                                                        @endforelse
                                                    </select>
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
                                                        <label for="example-text-input" class="form-label ">First Name</label>
                                                        <input class="form-control" type="text" id="emg_first_name" placeholder="First Name" name="emg_first_name" value="{{ old('emg_first_name', $patient->emg_first_name) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Relationship</label>
                                                        <input class="form-control" type="text" id="emg_relationship" placeholder="Relationship" name="emg_relationship" value="{{ old('emg_relationship', $patient->emg_relationship) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Address</label>
                                                        <input class="form-control" type="text" id="emg_address" placeholder="Address" name="emg_address" value="{{ old('emg_address', $patient->emg_address) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-tel-input" class="form-label">City</label>
                                                        <input class="form-control" type="text" id="emg_city" placeholder="City" name="emg_city" value="{{ old('emg_city', $patient->emg_city) }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="pri_insurance" class="form-label">State</label>
                                                                <select class="form-control" data-trigger id="choices-single-default" placeholder="Select State" name="emg_state" value="{{ old('emg_state', $patient->emg_state) }}">
                                                                    <option value="">Select State</option>
                                                                    @forelse($states as $state)
                                                                    <option value="{{ $state->state_code}}" {{ ( $state->state_code === $patient->emg_state) ? 'selected' : '' }}> {{ $state->state_code}}-{{ $state->state}}</option>
                                                                    @empty
                                                                    <option value="">No states found</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="formrow-password-input">Zip</label>
                                                                <input class="form-control zip-mask" type="text" id="emg_zip" placeholder="Zip" name="emg_zip" value="{{ old('emg_zip', $patient->emg_zip) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mt-3 mt-lg-0">
                                                    <div class="mb-3">
                                                        <label for="emg_last_name" class="form-label">Last Name</label>
                                                        <input class="form-control" type="text" id="emg_last_name" placeholder="Last Name" name="emg_last_name" value="{{ old('emg_last_name', $patient->emg_last_name) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="emg_email" class="form-label">Email</label>
                                                        <input class="form-control" type="text" id="emg_email" placeholder="Email" name="emg_email" value="{{ old('emg_email', $patient->emg_email) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="emg_mobile" class="form-label">Mobile Phone</label>
                                                        <input class="form-control mobile-mask" type="text" id="emg_mobile" placeholder="Mobile Phone" name="emg_mobile" value="{{ old('emg_mobile', $patient->emg_mobile) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="emg_homephone" class="form-label">Home Phone</label>
                                                        <input class="form-control homephone-mask" type="text" id="emg_homephone" placeholder="Home Phone" name="emg_homephone" value="{{ old('emg_homephone', $patient->emg_homephone) }}">
                                                    </div>
                                                    <div class="mb-3 pt-4">
                                                        <x-forms.Checkbox name='isActive' label='Active Patient' checked='{{ isset($patient->isActive) ? $patient->isActive : "" }}' />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
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
                                        <h5 class="font-size-16 mb-1 text-uppercase">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }}</h5>
                                        <div>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}, {{ ucfirst($patient->gender) }}</div>
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
                                    <input type="text" name='Patient_id' value="{{ $patient->id}}" hidden>
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
                                        <h5 class="font-size-16 mb-1 text-uppercase">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }}</h5>
                                        <div>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}, {{ ucfirst($patient->gender) }}</div>
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
                                    <input type="text" name='Patient_id' value="{{ $patient->id}}" hidden>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" form="vitalsmodalform">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
            <!-- End Page-content -->
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