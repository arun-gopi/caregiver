@extends('layouts.app')

@section('title','Patients | Care Giver')

@section('style')

@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Patients</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{$patients}}">0</span> Patients
                                    </h4>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">{{$patientsmonthcount}}</span>
                                <span class="ms-1 text-muted font-size-13">Patients this month</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Clinicians</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{$clinicianCount}}">0</span> Clinicians
                                    </h4>
                                </div>
                                <div class="col-6">
                                    
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">{{$clinicianmonthCount}}</span>
                                <span class="ms-1 text-muted font-size-13">Joined in this month</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col-->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Providers</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{$physicianCount}}">0</span> Physicians
                                    </h4>
                                </div>
                                <div class="col-6">
                                    
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">{{$physicianmonthCount}}</span>
                                <span class="ms-1 text-muted font-size-13">Joined in this month</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Visits</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{$visits}}">0</span> Visits
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                            <div class="text-nowrap">
                                <span class="badge bg-soft-success text-success">{{$visitsmonthcount}}</span>
                                <span class="ms-1 text-muted font-size-13">visits this month</span>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row-->

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/pages/dashboard.init.js') }}"></script>
@endsection