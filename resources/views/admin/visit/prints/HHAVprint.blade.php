@extends('layouts.print')

@section('title')
HHA Visit-{{ $patient->MRN }} | Care Giver
@endsection

@section('style')
@include('partials.portrait')
@endsection

@section('content')
<?php $folder = '/uploads/images/'; ?>
<div class="container portrait">
    <table class="portrait last-chapter page-break-before@">
        <thead>
            <tr>
                <td class="pl10 h20 border-bottom">
                    <table class="inner">
                        <tr>
                            <td class="h20 vamiddle">
                                @if (!empty($company->logo ))
                                <img src={{$folder.$company->logo}} style="width:204px;height:50px;border:0;">
                                @endif
                            </td>
                            <td class="c70 border-left">
                                <table class="inner semipad divider">
                                    <tr>
                                        <td colspan="2">
                                            <h5><span class="blue">{{$company->company_name}}</span></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="blue">{{$company->address}} </span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="blue">{{$company->city}}, {{$company->state}}-{{$company->zip}}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Phone: <span class="blue">{{$company->phone}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fax: <span class="blue">{{$company->fax}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NPI: <span class="blue">{{$company->NPI}}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="lightgrey-bg border-bottom aligncenter"><b>
                        <h3 class="pl10">HHA Visit Note</h3>
                    </b>
                </td>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td class="border-bottom h20">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td class="span4">
                                    <strong>Patient Name: </strong><span class="blue text-uppercase">{{ $patient->last_name }}, {{ $patient->first_name }} ({{ $patient->MRN }})&nbsp;</span>
                                </td>
                                <td class="span4">
                                    <strong>Visit In Date & Time: </strong> <span class="blue">@if(isset($visitform->visitintime)) {{ \Carbon\Carbon::parse($visitform->visitintime)->isoFormat('MM/DD/YYYY hh:mm A') }} @endif&nbsp;</span>
                                </td>
                                <td class="span4">
                                    <strong>Visit Out Date & Time: </strong> <span class="blue">@if(isset($visitform->visitouttime)) {{ \Carbon\Carbon::parse($visitform->visitouttime)->isoFormat('MM/DD/YYYY hh:mm A') }} @endif&nbsp;</span>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td class="span4">
                                <strong>Certification Period: </strong> <span class="blue">@if(isset($visitform->certperiodstart)) {{ \Carbon\Carbon::parse($visitform->certperiodstart)->isoFormat('MM/DD/YYYY')}} - {{\Carbon\Carbon::parse($visitform->certperiodend)->isoFormat('MM/DD/YYYY') }} @endif&nbsp;</span>
                                </td>
                                <td class="span4">
                                    
                                </td>
                                <td class="span4">
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="border-bottom">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td class="span5">
                                    <table class="inner semi divider">
                                        <tbody>
                                            <tr>
                                                <td class="span4">
                                                    <strong>Case Manager:</strong> <span class="blue">{{ $supervisor->last_name }}, {{ $supervisor->first_name }} ({{ $supervisor->Title }})&nbsp;</span>
                                                    <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Phone No:</strong> ClinicianPhoneNo@-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="span4"><strong>HHA Frequency:</strong> <span class="blue">&nbsp;</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Other Special Instructions:&nbsp;&nbsp;</strong><span class="blue">&nbsp;</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="span7">
                                    <table class="inner semipad devider">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="itemaligncenter">
                                                        <strong class="inline">Report to Case Manager:</strong>
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Care is Refused' checked='{{ isset($formmeta->HHAop003) ? $formmeta->HHAop003 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Change in Skin Condition' checked='{{ isset($formmeta->HHAop004) ? $formmeta->HHAop004 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Integumentary Issues' checked='{{ isset($formmeta->HHAop005) ? $formmeta->HHAop005 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Unusual Bruising/Bleeding' checked='{{ isset($formmeta->HHAop006) ? $formmeta->HHAop006 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Weight Gain or Loss' checked='{{ isset($formmeta->HHAop007) ? $formmeta->HHAop007 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Vital Signs Out of Parameter' checked='{{ isset($formmeta->HHAop008) ? $formmeta->HHAop008 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Change in mentation' checked='{{ isset($formmeta->HHAop009) ? $formmeta->HHAop009 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Patient Complaint or Request' checked='{{ isset($formmeta->HHAop010) ? $formmeta->HHAop010 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Falls' checked='{{ isset($formmeta->HHAop011) ? $formmeta->HHAop011 : "" }}' />
                                                    </div>
                                                    <div class="checkbox inline">
                                                        <x-forms.Checkboxprint label='Other: {{ isset($formmeta->HHANote05) ? $formmeta->HHANote05 : "" }}' checked='{{ isset($formmeta->HHAop012) ? $formmeta->HHAop012 : "" }}' />
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="h10 border-bottom align-center">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td colspan="4"><b>Notify Physician of vital sign parameters out of range:</b></td>
                            </tr>
                            <tr>
                                <td class="span3 border-bottom">
                                    <b>Systolic B/P: </b> <span class="blue">&lt;90&nbsp;</span> OR <span class="blue">&gt;160&nbsp;</span>
                                    <br>
                                    <b>Diastolic B/P: </b> <span class="blue">&lt;50&nbsp;</span> OR <span class="blue">&gt;100&nbsp;</span>
                                </td>
                                <td class="span3 border-bottom">
                                    <b>Temperature: </b> <span class="blue">&lt;95&nbsp;</span> OR <span class="blue">&gt;100.5&nbsp;</span>
                                    <br>
                                    <b>Respirations: </b> <span class="blue">&lt;12&nbsp;</span> OR <span class="blue">&gt;30&nbsp;</span>
                                </td>
                                <td class="span3 border-bottom">
                                    <b>Pulse: </b> <span class="blue">&lt;60&nbsp;</span> OR <span class="blue">&gt;110&nbsp;</span>
                                    <br>
                                    <b>O2 Sat: </b> <span class="blue">&lt;91&nbsp;</span>
                                </td>
                                <td class="span3 border-bottom">

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td class="span3">
                                    <b>VITAL SIGNS</b>
                                    <div class="checkbox inline">
                                        <x-forms.Checkboxprint label='(L)' checked='{{ (isset($vital) && $vital->BPSide=="L") ? 1 : "" }}' />
                                    </div>
                                    <div class="checkbox inline">
                                        <x-forms.Checkboxprint label='(R)' checked='{{ (isset($vital) && $vital->BPSide=="R") ? 1: "" }}' />
                                    </div>
                                </td>
                                <td class="span3">
                                    <b>Lying:</b>&nbsp;{{ isset($vital->BPLying) ? $vital->BPLying : "" }}&nbsp;
                                </td>
                                <td class="span2">
                                    <b>Standing:</b>&nbsp;{{ isset($vital->BPStanding) ? $vital->BPStanding : "" }}&nbsp;
                                </td>
                                <td class="span2">
                                    <b>Resp:</b>&nbsp;{{ isset($vital->Respirations) ? $vital->Respirations."BPM" : "" }}&nbsp;
                                </td>
                                <td class="span2">
                                    <b>Apical Pulse:</b>&nbsp;{{ isset($vital->Apical_Pulse) ? $vital->Apical_Pulse : "" }}&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td class="span3">
                                    <div><strong>Date of Last BM:&nbsp;&nbsp;</strong>@if(isset($visitform->visitintime)) {{ \Carbon\Carbon::parse($visitform->visitintime)->isoFormat('MM/DD/YYYY') }} @endif&nbsp;</div>
                                </td>
                                <td class="span3">
                                    <b>Sitting:</b>&nbsp;{{ isset($vital->BPSitting) ? $vital->BPSitting : "" }}&nbsp;
                                </td>
                                <td class="span2">
                                    <b>Temp:</b>&nbsp;{{ isset($vital->Temperature) ? $vital->Temperature : "" }}&nbsp;
                                </td>
                                <td class="span2">
                                    <b>Weight (lbs):</b>&nbsp;{{ isset($vital->Weight) ? $vital->Weight."lbs" : "" }}&nbsp;
                                </td>
                                <td class="span2">
                                    <b>Radial Pulse:</b>&nbsp;{{ isset($vital->Radial_Pulse) ? $vital->Radial_Pulse."BPM" : "" }}&nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="pl10 pr10 h10">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td colspan="2" class="lightgrey-bg border-bottom"><b>TASKS</b></td>
                            </tr>
                            <tr>
                                <td class="border-right c50 border-bottom">
                                    <table class="inner semipad divider ">
                                        <tbody>
                                            <tr>
                                                <td style="width: 40%"><b>Vital Signs</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <td style="width: 10%"><b>A</b></td>
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Blood Pressure</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop049) ? $formmeta->HHAop049 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop050) ? $formmeta->HHAop050 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop051) ? $formmeta->HHAop051 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop052) ? $formmeta->HHAop052 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Temperature</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop053) ? $formmeta->HHAop053 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop054) ? $formmeta->HHAop054 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop055) ? $formmeta->HHAop055 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop056) ? $formmeta->HHAop056 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Heart Rate</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop057) ? $formmeta->HHAop057 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop058) ? $formmeta->HHAop058 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop059) ? $formmeta->HHAop059 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop060) ? $formmeta->HHAop060 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Resp</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop061) ? $formmeta->HHAop061 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop062) ? $formmeta->HHAop062 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop063) ? $formmeta->HHAop063 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop064) ? $formmeta->HHAop064 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Weight</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop065) ? $formmeta->HHAop065 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop066) ? $formmeta->HHAop066 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop067) ? $formmeta->HHAop067 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop068) ? $formmeta->HHAop068 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%"><b>Bath</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <td style="width: 10%"><b>A</b></td>
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Bed</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop069) ? $formmeta->HHAop069 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop070) ? $formmeta->HHAop070 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop071) ? $formmeta->HHAop071 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop072) ? $formmeta->HHAop072 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop073) ? $formmeta->HHAop073 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop074) ? $formmeta->HHAop074 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Chair</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop075) ? $formmeta->HHAop075 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop076) ? $formmeta->HHAop076 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop077) ? $formmeta->HHAop077 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop078) ? $formmeta->HHAop078 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop079) ? $formmeta->HHAop079 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop080) ? $formmeta->HHAop080 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tub</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop081) ? $formmeta->HHAop081 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop082) ? $formmeta->HHAop082 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop083) ? $formmeta->HHAop083 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop084) ? $formmeta->HHAop084 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop085) ? $formmeta->HHAop085 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop086) ? $formmeta->HHAop086 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shower</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop087) ? $formmeta->HHAop087 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop088) ? $formmeta->HHAop088 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop089) ? $formmeta->HHAop089 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop090) ? $formmeta->HHAop090 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop091) ? $formmeta->HHAop091 : "" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop092) ? $formmeta->HHAop092 : "" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Other: {{ isset($formmeta->HHANote12) ? $formmeta->HHANote12 :"" }} &nbsp;</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop093) ? $formmeta->HHAop093 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop094) ? $formmeta->HHAop094 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop095) ? $formmeta->HHAop095 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop096) ? $formmeta->HHAop096 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop097) ? $formmeta->HHAop097 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop098) ? $formmeta->HHAop098 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%"><b>Household Tasks</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <td style="width: 10%"><b>A</b></td>
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Wash Clothes/Bed Linens</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop099) ? $formmeta->HHAop099 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop100) ? $formmeta->HHAop100 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop101) ? $formmeta->HHAop101 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop102) ? $formmeta->HHAop102 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop103) ? $formmeta->HHAop103 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop104) ? $formmeta->HHAop104 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Make Bed</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop105) ? $formmeta->HHAop105 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop106) ? $formmeta->HHAop106 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop107) ? $formmeta->HHAop107 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop108) ? $formmeta->HHAop108 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop109) ? $formmeta->HHAop109 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop110) ? $formmeta->HHAop110 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Change Bed Linens</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop111) ? $formmeta->HHAop111 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop112) ? $formmeta->HHAop112 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop113) ? $formmeta->HHAop113 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop114) ? $formmeta->HHAop114 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop115) ? $formmeta->HHAop115 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop116) ? $formmeta->HHAop116 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tidy Room</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop117) ? $formmeta->HHAop117 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop118) ? $formmeta->HHAop118 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop119) ? $formmeta->HHAop119 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop120) ? $formmeta->HHAop120 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop121) ? $formmeta->HHAop121 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop122) ? $formmeta->HHAop122 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Equipment Care</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop123) ? $formmeta->HHAop123 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop124) ? $formmeta->HHAop124 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop125) ? $formmeta->HHAop125 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop126) ? $formmeta->HHAop126 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop127) ? $formmeta->HHAop127 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop128) ? $formmeta->HHAop128 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Clean Bathroom</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop129) ? $formmeta->HHAop129 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop130) ? $formmeta->HHAop130 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop131) ? $formmeta->HHAop131 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop132) ? $formmeta->HHAop132 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop133) ? $formmeta->HHAop133 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop134) ? $formmeta->HHAop134 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Clean Kitchen</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop135) ? $formmeta->HHAop135 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop136) ? $formmeta->HHAop136 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop137) ? $formmeta->HHAop137 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop138) ? $formmeta->HHAop138 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop139) ? $formmeta->HHAop139 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop140) ? $formmeta->HHAop140 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Other: {{ isset($formmeta->HHANote13) ? $formmeta->HHANote13 : '' }} &nbsp;</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop141) ? $formmeta->HHAop141 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop142) ? $formmeta->HHAop142 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop143) ? $formmeta->HHAop143 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop144) ? $formmeta->HHAop144 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop145) ? $formmeta->HHAop145 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop146) ? $formmeta->HHAop146 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%"><b>Nutrition</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <td style="width: 10%"><b>A</b></td>
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Meal Preparation</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop147) ? $formmeta->HHAop147 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop148) ? $formmeta->HHAop148 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop149) ? $formmeta->HHAop149 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop150) ? $formmeta->HHAop150 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop151) ? $formmeta->HHAop151 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop152) ? $formmeta->HHAop152 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assist with Feeding</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop153) ? $formmeta->HHAop153 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop154) ? $formmeta->HHAop154 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop155) ? $formmeta->HHAop155 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop156) ? $formmeta->HHAop156 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop157) ? $formmeta->HHAop157 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop158) ? $formmeta->HHAop158 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Encourage Fluids</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop159) ? $formmeta->HHAop159 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop160) ? $formmeta->HHAop160 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop161) ? $formmeta->HHAop161 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop162) ? $formmeta->HHAop162 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop163) ? $formmeta->HHAop163 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop164) ? $formmeta->HHAop164 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Limit Fluids</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop165) ? $formmeta->HHAop165 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop166) ? $formmeta->HHAop166 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop167) ? $formmeta->HHAop167 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop168) ? $formmeta->HHAop168 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop169) ? $formmeta->HHAop169 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop170) ? $formmeta->HHAop170 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Other: {{ isset($formmeta->HHANote14) ? $formmeta->HHANote14 : '' }}&nbsp;</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop171) ? $formmeta->HHAop171 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop172) ? $formmeta->HHAop172 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop173) ? $formmeta->HHAop173 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop174) ? $formmeta->HHAop174 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop175) ? $formmeta->HHAop175 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop176) ? $formmeta->HHAop176 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%"><b>Activities</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <td style="width: 10%"><b>A</b></td>
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Ambulation Assit: W/C, Walker, Cane</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop177) ? $formmeta->HHAop177 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop178) ? $formmeta->HHAop178 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop179) ? $formmeta->HHAop179 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop180) ? $formmeta->HHAop180 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop181) ? $formmeta->HHAop181 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop182) ? $formmeta->HHAop182 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mobility/Transfer Assist: Chair, Bed, Dangle, Commode, Shower/Tub</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop183) ? $formmeta->HHAop183 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop184) ? $formmeta->HHAop184 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop185) ? $formmeta->HHAop185 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop186) ? $formmeta->HHAop186 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop187) ? $formmeta->HHAop187 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop188) ? $formmeta->HHAop188 :"" }}' />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Turn and Position</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop189) ? $formmeta->HHAop189 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop190) ? $formmeta->HHAop190 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop191) ? $formmeta->HHAop191 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop192) ? $formmeta->HHAop192 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop193) ? $formmeta->HHAop193 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop194) ? $formmeta->HHAop194 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Safety Check</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop195) ? $formmeta->HHAop195 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop196) ? $formmeta->HHAop196 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop197) ? $formmeta->HHAop197 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop198) ? $formmeta->HHAop198 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop199) ? $formmeta->HHAop199 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop200) ? $formmeta->HHAop200 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Universal Precautions</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop201) ? $formmeta->HHAop201 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop202) ? $formmeta->HHAop202 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop203) ? $formmeta->HHAop203 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop204) ? $formmeta->HHAop204 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop205) ? $formmeta->HHAop205 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop206) ? $formmeta->HHAop206 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assist with Exercises</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop207) ? $formmeta->HHAop207 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop208) ? $formmeta->HHAop208 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop209) ? $formmeta->HHAop209 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop210) ? $formmeta->HHAop210 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop211) ? $formmeta->HHAop211 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop212) ? $formmeta->HHAop212 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Other: {{ isset($formmeta->HHANote15) ? $formmeta->HHANote15 : '' }}&nbsp;</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop213) ? $formmeta->HHAop213 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop214) ? $formmeta->HHAop214 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop215) ? $formmeta->HHAop215 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop216) ? $formmeta->HHAop216 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop217) ? $formmeta->HHAop217 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop218) ? $formmeta->HHAop218 :"" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>

                                <td class="pl10 pr10 c50 border-bottom">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 40%"><b>Procedures</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <td style="width: 10%"><b>A</b></td>
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Record Bowel Movement</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop219) ? $formmeta->HHAop219 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop220) ? $formmeta->HHAop220 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop221) ? $formmeta->HHAop221 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop222) ? $formmeta->HHAop222 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop223) ? $formmeta->HHAop223 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop224) ? $formmeta->HHAop224 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assist with Elimination</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop225) ? $formmeta->HHAop225 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop226) ? $formmeta->HHAop226 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop227) ? $formmeta->HHAop227 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop228) ? $formmeta->HHAop228 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop229) ? $formmeta->HHAop229 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop230) ? $formmeta->HHAop230 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Catheter Care</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop231) ? $formmeta->HHAop231 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop232) ? $formmeta->HHAop232 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop233) ? $formmeta->HHAop233 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop234) ? $formmeta->HHAop234 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop235) ? $formmeta->HHAop235 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop236) ? $formmeta->HHAop236 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Empty Catheter Bag</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop237) ? $formmeta->HHAop237 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop238) ? $formmeta->HHAop238 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop239) ? $formmeta->HHAop239 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop240) ? $formmeta->HHAop240 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop241) ? $formmeta->HHAop241 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop242) ? $formmeta->HHAop242 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Inspect/Reinforce Dressing</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop243) ? $formmeta->HHAop243 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop244) ? $formmeta->HHAop244 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop245) ? $formmeta->HHAop245 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop246) ? $formmeta->HHAop246 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop247) ? $formmeta->HHAop247 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop248) ? $formmeta->HHAop248 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Medication Reminder</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop249) ? $formmeta->HHAop249 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop250) ? $formmeta->HHAop250 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop251) ? $formmeta->HHAop251 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop252) ? $formmeta->HHAop252 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop253) ? $formmeta->HHAop253 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop254) ? $formmeta->HHAop254 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Other: {{ isset($formmeta->HHANote16) ? $formmeta->HHANote16 : '' }}&nbsp;</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop255) ? $formmeta->HHAop255 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop256) ? $formmeta->HHAop256 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop257) ? $formmeta->HHAop257 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop258) ? $formmeta->HHAop258 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop259) ? $formmeta->HHAop259 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop260) ? $formmeta->HHAop260 :"" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 50%"><b>Hygiene/Grooming</b></td>
                                                <td style="width: 10%"><b>QV</b></td>
                                                <td style="width: 10%"><b>QW</b></td>
                                                <!-- <td> <b>A</b> </td> -->
                                                <td style="width: 10%"><b>Done</b></td>
                                                <td style="width: 10%"><b>Refuse</b></td>
                                                <td style="width: 10%"><b>N/A</b></td>
                                            </tr>
                                            <tr>
                                                <td>Personal Care</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop261) ? $formmeta->HHAop261 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop262) ? $formmeta->HHAop262 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop263) ? $formmeta->HHAop263 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop264) ? $formmeta->HHAop264 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop265) ? $formmeta->HHAop265 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop266) ? $formmeta->HHAop266 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assist with Dressing</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop267) ? $formmeta->HHAop267 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop268) ? $formmeta->HHAop268 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop269) ? $formmeta->HHAop269 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop270) ? $formmeta->HHAop270 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop271) ? $formmeta->HHAop271 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop272) ? $formmeta->HHAop272 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hair Care: Comb/Brush</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop273) ? $formmeta->HHAop273 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop274) ? $formmeta->HHAop274 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop275) ? $formmeta->HHAop275 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop276) ? $formmeta->HHAop276 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop277) ? $formmeta->HHAop277 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop278) ? $formmeta->HHAop278 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shampoo Hair</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop279) ? $formmeta->HHAop279 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop280) ? $formmeta->HHAop280 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop281) ? $formmeta->HHAop281 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop282) ? $formmeta->HHAop282 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop283) ? $formmeta->HHAop283 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop284) ? $formmeta->HHAop284 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Skin Care</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop285) ? $formmeta->HHAop285 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop286) ? $formmeta->HHAop286 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop287) ? $formmeta->HHAop287 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop288) ? $formmeta->HHAop288 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop289) ? $formmeta->HHAop289 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop290) ? $formmeta->HHAop290 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oral Hygiene</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop291) ? $formmeta->HHAop291 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop292) ? $formmeta->HHAop292 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop293) ? $formmeta->HHAop293 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop294) ? $formmeta->HHAop294 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop295) ? $formmeta->HHAop295 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop296) ? $formmeta->HHAop296 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Foot Care</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop297) ? $formmeta->HHAop297 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop298) ? $formmeta->HHAop298 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop299) ? $formmeta->HHAop299 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop300) ? $formmeta->HHAop300 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop301) ? $formmeta->HHAop301 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop302) ? $formmeta->HHAop302 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nails: Clean/File</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop303) ? $formmeta->HHAop303 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop304) ? $formmeta->HHAop304 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop305) ? $formmeta->HHAop305 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop306) ? $formmeta->HHAop306 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop307) ? $formmeta->HHAop307 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop308) ? $formmeta->HHAop308 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pericare</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop309) ? $formmeta->HHAop309 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop310) ? $formmeta->HHAop310 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop311) ? $formmeta->HHAop311 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop312) ? $formmeta->HHAop312 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop313) ? $formmeta->HHAop313 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop314) ? $formmeta->HHAop314 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shave</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop315) ? $formmeta->HHAop315 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop316) ? $formmeta->HHAop316 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop317) ? $formmeta->HHAop317 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop318) ? $formmeta->HHAop318 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop319) ? $formmeta->HHAop319 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop320) ? $formmeta->HHAop320 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Deodorant</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop321) ? $formmeta->HHAop321 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop322) ? $formmeta->HHAop322 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop323) ? $formmeta->HHAop323 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop324) ? $formmeta->HHAop324 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop325) ? $formmeta->HHAop325 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop326) ? $formmeta->HHAop326 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Check Pressure Areas</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop327) ? $formmeta->HHAop327 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop328) ? $formmeta->HHAop328 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop329) ? $formmeta->HHAop329 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop330) ? $formmeta->HHAop330 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop331) ? $formmeta->HHAop331 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop332) ? $formmeta->HHAop332 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Back Rub</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop333) ? $formmeta->HHAop333 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop334) ? $formmeta->HHAop334 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop335) ? $formmeta->HHAop335 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop336) ? $formmeta->HHAop336 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop337) ? $formmeta->HHAop337 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop338) ? $formmeta->HHAop338 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Swab</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop339) ? $formmeta->HHAop339 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop340) ? $formmeta->HHAop340 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop341) ? $formmeta->HHAop341 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop342) ? $formmeta->HHAop342 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop343) ? $formmeta->HHAop343 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop344) ? $formmeta->HHAop344 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Dentures</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop345) ? $formmeta->HHAop345 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop346) ? $formmeta->HHAop346 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop347) ? $formmeta->HHAop347 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop348) ? $formmeta->HHAop348 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop349) ? $formmeta->HHAop349 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop350) ? $formmeta->HHAop350 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assess Skin Condition</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop351) ? $formmeta->HHAop351 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop352) ? $formmeta->HHAop352 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop353) ? $formmeta->HHAop353 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop354) ? $formmeta->HHAop354 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop355) ? $formmeta->HHAop355 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop356) ? $formmeta->HHAop356 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assess for Reddened Areas</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop357) ? $formmeta->HHAop357 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop358) ? $formmeta->HHAop358 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop359) ? $formmeta->HHAop359 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop360) ? $formmeta->HHAop360 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop361) ? $formmeta->HHAop361 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop362) ? $formmeta->HHAop362 :"" }}' />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Other: {{ isset($formmeta->HHANote19) ? $formmeta->HHANote19 : '' }}&nbsp;</td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop363) ? $formmeta->HHAop363 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop364) ? $formmeta->HHAop364 :"" }}' />
                                                </td>
                                                <!-- <td><x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop365) ? $formmeta->HHAop365 :"" }}'/></td> -->
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop366) ? $formmeta->HHAop366 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop367) ? $formmeta->HHAop367 :"" }}' />
                                                </td>
                                                <td>
                                                    <x-forms.Checkboxprint label='' checked='{{ isset($formmeta->HHAop368) ? $formmeta->HHAop368 :"" }}' />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="border-bottom">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Aide/Reports/Comments: </b> <span class="blue">{{ isset($formmeta->HHANote17) ? $formmeta->HHANote17 : '' }} &nbsp;</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="height:10pt;">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td class="c80" style="vertical-align:bottom;">
                                    <strong>Signature: </strong><span class="blue"> @if(isset($clinician->last_name))
                                        <span class="blue">Electronically Signed By {{$clinician->last_name}}, {{$clinician->first_name}}
                                            @if(isset($visitform->signed_date))
                                            on {{ \Carbon\Carbon::parse($visitform->signed_date)->isoFormat('MM/DD/YYYY hh:mm:SS A') }}
                                            @endif &nbsp;</span>
                                        @endif&nbsp;</span>
                                </td>
                                <td style="vertical-align:bottom;">
                                    <strong>Date: </strong><span class="blue">@if(isset($visitform->signed_date))
                                        on {{ \Carbon\Carbon::parse($visitform->signed_date)->isoFormat('MM/DD/YYYY') }}
                                        @endif&nbsp;</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="portrait last-chapter page-break-before">
        <thead>
            <tr>
                <td class="pl10 h20 border-bottom">
                    <table class="inner">
                        <tr>
                            <td class="h20 vamiddle">
                                @if (!empty($company->logo ))
                                <img src={{$folder.$company->logo}} style="width:204px;height:50px;border:0;">
                                @endif
                            </td>
                            <td class="c70 border-left">
                                <table class="inner semipad divider">
                                    <tr>
                                        <td colspan="2">
                                            <h5><span class="blue">{{$company->company_name}}</span></h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="blue">{{$company->address}} </span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="blue">{{$company->city}}, {{$company->state}}-{{$company->zip}}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Phone: <span class="blue">{{$company->phone}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fax: <span class="blue">{{$company->fax}}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NPI: <span class="blue">{{$company->NPI}}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="lightgrey-bg border-bottom aligncenter"><b>
                        <h3 class="pl10">COVID-19 Screening</h3>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="border-bottom"><b>
                        <p>Date: <span class="blue">@if(isset($covid19->evaldate)) {{ \Carbon\Carbon::parse($covid19->evaldate)->isoFormat('MM/DD/YYYY') }} @endif&nbsp;</span></p>
                    </b>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-bottom h20">
                    <table class="inner">
                        <tbody>
                            <tr class="lightgrey-bg border-bottom">
                                <td class="span6"><b>PATIENT</b></td>
                                <td class="span6"><b>PHYSICIAN</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <b><span class="blue">{{$patient->last_name}}, {{$patient->first_name}}&nbsp;</span></b> (<span class="blue">{{$patient->MRN}}&nbsp;</span>)
                                    <p><span class="blue">{{$patient->address}} &nbsp;</span></p>
                                    <p><span class="blue">{{$patient->city}}, {{$patient->state}} {{$patient->zip}}&nbsp;</span></p>
                                    <p><b>DOB:</b> {{ \Carbon\Carbon::parse($patient->birthday)->isoFormat('MM/DD/YYYY') }}
                                    </p>
                                    <p><b>Gender:</b> <span class="blue">{{$patient->gender}}&nbsp;</span></p>
                                </td>
                                <td>
                                    @if(isset($physicians))
                                    <p>
                                        <strong><span class="blue">{{$physicians->last_name}}, {{$physicians->first_name}} {{$physicians->Title}}&nbsp;</span></strong>
                                    </p>
                                    <p><span class="blue">{{$company->address}}&nbsp;</span></p>
                                    <p><span class="blue">{{$company->city}}, {{$company->state}} {{$company->zip}}&nbsp;</span></p>
                                    <p>Phone: <span class="blue">{{$company->phone}}&nbsp;</span></p>
                                    <p>
                                        Fax: <span class="blue">{{$company->fax}}&nbsp;</span>
                                    </p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="border-bottom h10">
                    <table class="inner tbl-bordered">
                        <thead>
                            <tr>
                                <td class="border-bottom  span7"><b>COVID-19 Screening - SELF (@if(isset($covid19->emp_lname))
                                        <span class="blue text-uppercase">{{$covid19->emp_lname}}, {{$covid19->emp_fname}} ({{$covid19->emp_title}})</span>
                                        @endif)</b></td>
                                <td class="border-bottom span5"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="h30">
                                    Have you traveled to a COVID-19-affected area outside of the U.S. in the past 14 days?
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->emp_istravelled) && ($covid19->emp_istravelled =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h40">
                                    Do you have signs or symptoms of COVID-19, such as fever, chills, repeated shaking with chills, cough, shortness of breath or difficulty breathing, fatigue, muscle or body aches, headache, new loss of tastes or smell, sore throat, congestion or runny nose, diarrhea, nausea or vomiting?
                                </td>
                                <td class="imgaligncenter gap-2 h40">
                                    @if(isset($covid19->emp_symptoms) && ($covid19->emp_symptoms =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h30">
                                    Have you had close contact (been within six feet for over 15 minutes or lived with) a person with COVID-19 in the past 14 days?
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->emp_closecontact) && ($covid19->emp_closecontact =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h30">
                                    Have you been diagnosed with COVID-19 or told by a health care provider that you might have or have COVID-19?
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->emp_diagnosedc19) && ($covid19->emp_diagnosedc19 =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h30">
                                    Risk Level:
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->emp_risklevel) && ($covid19->emp_risklevel =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="h20">
                                    <b>Temperature (please write your temperature prior to arrival):</b>&nbsp;@if(isset($covid19->emp_temperature))
                                    <span class="blue">{{$covid19->emp_temperature}}</span>
                                    @endif&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="h50">
                                    <b>Comment</b>&nbsp;@if(isset($covid19->emp_comment))
                                    <span class="blue">{{$covid19->emp_comment}}</span>
                                    @endif&nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="border-bottom h10">
                    <table class="inner tbl-bordered">
                        <thead>
                            <tr>
                                <td class="border-bottom span7"><b>COVID-19 Screening - PATIENT (@if(isset($patient->last_name))
                                        <span class="text-uppercase blue">{{$patient->last_name}}, {{$patient->first_name}}</span>
                                        @endif)</b></td>
                                <td class="border-bottom span5"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="h30">
                                    Have you traveled to a COVID-19-affected area outside of the U.S. in the past 14 days?
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->pt_istravelled) && ($covid19->pt_istravelled =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h40">
                                    Do you have signs or symptoms of COVID-19, such as fever, chills, repeated shaking with chills, cough, shortness of breath or difficulty breathing, fatigue, muscle or body aches, headache, new loss of tastes or smell, sore throat, congestion or runny nose, diarrhea, nausea or vomiting?
                                </td>
                                <td class="imgaligncenter gap-2 h40">
                                    @if(isset($covid19->pt_symptoms) && ($covid19->pt_symptoms =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h30">
                                    Have you had close contact (been within six feet for over 15 minutes or lived with) a person with COVID-19 in the past 14 days?
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->pt_closecontact) && ($covid19->pt_closecontact =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h30">
                                    Have you been diagnosed with COVID-19 or told by a health care provider that you might have or have COVID-19?
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->pt_diagnosedc19) && ($covid19->pt_diagnosedc19 =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="h30">
                                    Risk Level:
                                </td>
                                <td class="imgaligncenter gap-2 h30">
                                    @if(isset($covid19->pt_risklevel) && ($covid19->pt_risklevel =='1') )
                                    <i data-feather="check-square" class="icon-sm"></i> Yes
                                    <i data-feather="square" class="icon-sm"></i> No
                                    @else
                                    <i data-feather="square" class=" icon-sm me-1 align-middle"></i> Yes
                                    <i data-feather="check-square" class=" icon-sm me-1 align-middle"></i> No
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="h20">
                                    <b>Temperature (please write your temperature prior to arrival):</b>&nbsp;@if(isset($covid19->pt_temperature))
                                    <span class="blue">{{$covid19->pt_temperature}}</span>
                                    @endif&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="h50">
                                    <b>Comment</b>&nbsp;@if(isset($covid19->pt_comment))
                                    <span class="blue">{{$covid19->pt_comment}}</span>
                                    @endif&nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="border-top pl10 h10">
                    <table class="inner">
                        <tbody>
                            <tr>
                                <td class="span9">
                                    <strong>Signature:</strong>&nbsp;&nbsp;
                                    @if(isset($covid19->emp_lname))
                                    <span class="blue">Electronically Signed By {{$covid19->emp_lname}}, {{$covid19->emp_fname}}
                                        @if(isset($visitform->signed_date))
                                        on {{ \Carbon\Carbon::parse($visitform->signed_date)->isoFormat('MM/DD/YYYY hh:mm:SS A') }}
                                        @endif &nbsp;</span>
                                    @endif
                                </td>
                                <td class="span3">
                                    <strong>Date:</strong>&nbsp;&nbsp;&nbsp;<span class="blue"> @if(isset($visitform->signed_date)) {{ \Carbon\Carbon::parse($visitform->signed_date)->isoFormat('MM/DD/YYYY') }} @endif &nbsp;</span>&nbsp;</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <footer class="no-print">
        <a href="#" onclick="javascript:window.print();">Print</a> | <a href="#top">To top <i class="icon-arrow-up"></i></a>
    </footer>
</div>
@endsection