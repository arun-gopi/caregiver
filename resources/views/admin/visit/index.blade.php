@extends('layouts.app')

@section('title','Visits | Care Giver')

@section('style')

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
                            <div class="d-flex justify-content-between">
                                <h4>Visits</h4>
                                <a href="{{ route('visits.create')}}">
                                    <button type="button" class="btn btn-light waves-effect waves-light mb-4">
                                        <i class="bx bx-plus font-size-16 align-middle mr-2"></i> New Visit
                                    </button>
                                </a>
                            </div>
                            <div class="mb-3">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Patient</th>
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
                                        <tr data-entry-id="{{ $visit->id }}" class="table-tr" data-url="{{ route('visits.edit', $visit->uuid) }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div> <a href="{{ route('visits.edit', $visit->uuid) }}">{{$visit->visit_type}} Visit</a>
                                                </div>
                                            </td>
                                            <td class="text-uppercase">{{ $visit->pt_lname }}, {{ $visit->pt_fname }} <br>{{ Carbon\Carbon::parse($visit->pt_dob)->format('m/d/Y') }} </td>
                                            <td>{{ Carbon\Carbon::parse($visit->visitintime)->format('m/d/Y h:i A') }}</td>
                                            <td>{{ Carbon\Carbon::parse($visit->visitouttime)->format('m/d/Y h:i A') }}</td>
                                            <td>{{($visit->unit)}} Units</td>
                                            <td class="text-uppercase">{{ $visit->emp_lname }}, {{ $visit->emp_fname }} ({{ $visit->emp_title }}) </td>
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
    </div>
    @endsection

    @section('script')
    <script type="text/javascript">
        $(function() {
            $("#datatable").on("click", "tr[data-url]", function() {
                window.location = $(this).data("url");
            });
        });
    </script>

    @endsection