@extends('layouts.app')

@section('title','Patients | Care Giver')
@section('style')

<!-- DataTables -->
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <x-flash-message />
                        <div class="card-body">
                            <!--    <div>{{count($patients)}} Patients</div> -->
                            <div class="d-flex justify-content-end ">
                                <a href="{{ route('patients.create')}}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light mb-4">
                                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> New Patient
                                    </button>
                                </a>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>DOB</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Insurance</th>
                                        <th>Status</th>
                                        <!--    <th>Action</th>  -->
                                    </tr>
                                </thead>


                                <tbody>
                                    @forelse($patients as $patient)
                                    <tr data-entry-id="{{ $patient->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <!--    <div><a href="/patients/{{ $patient->uuid }}">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }}</a></div>  -->
                                            <div class="text-uppercase"><a href="{{ route('patients.show', $patient->uuid) }}">{{ ucfirst($patient->last_name) }}, {{ ucfirst($patient->first_name) }}</a>
                                            </div>
                                            <div>
                                           {{ ($patient->MRN) }} | {{ ucfirst($patient->gender) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ Carbon\Carbon::parse($patient->birthday)->format('m/d/Y') }}
                                            </div>
                                            <div>
                                                {{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y years') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $patient->address }}
                                            </div>
                                            <div>
                                                {{ $patient->city }} {{ $patient->state }} - {{ $patient->zip }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                M: {{ $patient->mobile }}
                                            </div>
                                            <div>
                                                @if (empty($patient->email ))
                                                Email: No email recorded
                                                @else
                                                Email: {{ $patient->email}}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $patient->pri_insurance }}
                                            </div>
                                            <div>
                                                @if (empty($patient->pri_insurance_id ))

                                                @else
                                                ID# {{ $patient->pri_insurance_id}}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-uppercase">
                                                @if (empty($patient->isActive ) || ($patient->isActive ==='0'))
                                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                                @else
                                                <span class="badge rounded-pill bg-success">Active</span>
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
                                        <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>
@endsection