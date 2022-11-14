@extends('layouts.print')

@section('title')
Covid Screening-{{ $patient->MRN }} | Care Giver
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