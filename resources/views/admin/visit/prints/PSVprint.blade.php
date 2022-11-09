@extends('layouts.print')

@section('title')
Supervisory Visit-{{ $patient->MRN }} | Care Giver
@endsection


@section('style')

@endsection
@section('content')
<div class="container portrait">
    <table class="portrait last-chapter page-break-before@">
        <thead>
            <tr>
                <td class="pl10 h20 border-bottom">
                    <table class="inner">
                        <tr>
                            <td class="c30 border-right h20 vamiddle">
                                <img src="https://guidancehomehealth.com/wp-content/uploads/2022/06/logo-guidance-Latest-1-e1655324438733-1-1024x207.png" style="width:204px;height:40px;border:0;">
                            </td>
                            <td>
                                <table class="inner semipad divider">
                                    <tr>
                                        <td colspan="2">
                                            <h5><span class="blue">{{$company->name}}</span></h5>
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
                        <h3 class="pl10">Supervisory Visit</h3>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="border-bottom"><b>
                        @if (isset($visitform->visitintime))
                        <p>Time In: <span class="blue">{{ \Carbon\Carbon::parse($visitform->visitintime)->isoFormat('MM/DD/YYYY hh:mm:SS A') }}&nbsp;</span> Time Out: <span class="blue">{{ \Carbon\Carbon::parse($visitform->visitouttime)->isoFormat('MM/DD/YYYY hh:mm:SS A') }}&nbsp;</span></p>
                        @endif
                    </b>
                </td>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td class="pl10 border-bottom" style="height:40pt;">

                    <table class="inner divider">
                        <tr>
                            <td class="span4 border-right">
                                <table class="inner">
                                    <tr>
                                        <td class="lightgrey-bg border-bottom"><b><u>Patient:</u></b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5><span class="blue">{{$patient->last_name}}, {{$patient->first_name}}&nbsp;</span> (<span class="blue">&nbsp;{{$patient->MRN}}&nbsp;</span>)</h5>
                                            <p><span class="blue">{{$patient->address}} &nbsp;</span></p>
                                            <p><span class="blue">{{$patient->city}}, {{$patient->state}} {{$patient->zip}}&nbsp;</span></p>
                                            <p>SOC: <span class="blue">{{ isset($patient->SOC) ?  \Carbon\Carbon::parse($patient->SOC)->isoFormat('MM/DD/YYYY') : ''}}&nbsp;</span></p>
                                            @if (isset($visitform->certperiodstart))
                                            <p>Cert. Period: <span class="blue">{{ \Carbon\Carbon::parse($visitform->certperiodstart)->isoFormat('MM/DD/YYYY') }}-{{ \Carbon\Carbon::parse($visitform->certperiodend)->isoFormat('MM/DD/YYYY') }}&nbsp;</span></p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="span4 border-right">
                                <table class="inner">
                                    <tr>
                                        <td class="lightgrey-bg border-bottom"><b><u>Clinician:</u></b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>
                                            <h5><span class="blue">{{$clinician->last_name}}, {{$clinician->first_name}} ({{$clinician->Title}})&nbsp;</span></h5>
                                            </p>
                                            <p>Phone: <span class="blue">{{$clinician->mobile}}&nbsp;</span></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="inner">
                                    <tr>
                                        <td class="lightgrey-bg border-bottom"><b><u>Supervisor:</u></b></td>
                                    </tr>
                                    <tr>
                                        <td>@if(isset($supervisor->last_name))
                                            <p>
                                            <h5><span class="blue">{{$supervisor->last_name}}, {{$supervisor->first_name}} ({{$supervisor->Title}})&nbsp;</span></h5>
                                            </p>
                                            <p>Phone: <span class="blue">{{$supervisor->mobile}}&nbsp;</span></p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="pl10 pr10 border-bottom h100">
                    <table class="inner">
                        <tr>
                            <td class="border-bottom">
                                <p>
                                    <strong>Aide present at time of visit</strong>
                                </p>
                                <p>
                                    <span class="blue">{{isset($formmeta->EA001) ? $formmeta->EA001 : ''}}&nbsp;</span>
                                </p>
                            </td>
                            <td class="border-bottom">
                                <p>
                                    <strong>Aide honor the patient rights, respect the patient privacy and the patient's property:</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA006) ? $formmeta->EA006 : ''}}&nbsp;</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom">
                                <p>
                                    <strong>Aide follow and complete assigned tasks on the Aide Care Plan:</strong>
                                </p>
                                <p>
                                    <span class="blue">{{isset($formmeta->EA002) ? $formmeta->EA002 : ''}}&nbsp;</span>
                                </p>
                            </td>
                            <td class="border-bottom">
                                <p>
                                    <strong>Aide report changes in the patient's condition to appropriate staff:</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA007) ? $formmeta->EA007 : ''}}&nbsp;</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom">
                                <p>
                                    <strong>Aide maintain an open communication process with the patient, representative (if any), caregivers and family:</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA003) ? $formmeta->EA003 : ''}}&nbsp;</span>
                                </p>
                            </td>
                            <td class="border-bottom">
                                <p>
                                    <strong>Does the patient have continued need for Aide services?</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA008) ? $formmeta->EA008 : ''}}&nbsp;</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom">
                                <p>
                                    <strong>Aide demonstrate competency with assigned tasks:</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA004) ? $formmeta->EA004 : ''}}&nbsp;</span>
                                </p>
                            </td>
                            <td class="border-bottom">
                                <p>
                                    <strong>Adheres to home health care agency policies and procedures:</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA009) ? $formmeta->EA009 : ''}}&nbsp;</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <strong>Aide comply with infection prevention and control policies and procedures including proper hand hygiene and bag technique:</strong>
                                </p>

                                <p>
                                    <span class="blue">{{isset($formmeta->EA005) ? $formmeta->EA005 : ''}}&nbsp;</span>
                                </p>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="pl10 pr10 border-bottom h100">
                    <table class="inner">
                        <tr>
                            <td><strong class="big">Comments from Patient:</strong></td>
                        </tr>
                        <tr>
                            <td><span class="blue">{{isset($formmeta->EA010) ? $formmeta->EA010 : ''}}&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="pl10 pr10 border-bottom h100">
                    <table class="inner">
                        <tr>
                            <td><strong class="big">Supervisor Comments:</strong></td>
                        </tr>
                        <tr>
                            <td><span class="blue">{{isset($formmeta->EA011) ? $formmeta->EA011 : ''}}&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="pl10 pr10 h100">
                    <table class="inner">
                        <tr>
                            <td><strong class="big">Changes to Care Plan:</strong></td>
                        </tr>
                        <tr>
                            <td><span class="blue">{{isset($formmeta->EA012) ? $formmeta->EA012 : ''}}&nbsp;</span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="border-bottom"></td>
            </tr>

            <tr>
                <td class="pl10" style="height:10pt;">
                    <table class="inner">
                        <tr>
                            <td class="c80 noborder" style="vertical-align:bottom;">
                                <strong>Supervisor Signature:</strong>&nbsp;&nbsp;&nbsp;
                                @if(isset($covid19->emp_lname))
                                <span class="blue">Electronically Signed By {{$covid19->emp_lname}}, {{$covid19->emp_fname}}
                                    @if(isset($visitform->signed_date))
                                    on {{ \Carbon\Carbon::parse($visitform->signed_date)->isoFormat('MM/DD/YYYY hh:mm:SS A') }}
                                    @endif &nbsp;</span>
                                @endif
                            </td>
                            <td class="noborder" style="height:25pt;vertical-align:bottom;">
                                <strong>Date:</strong>&nbsp;&nbsp;&nbsp;<span class="blue"> @if(isset($visitform->signed_date)) {{ \Carbon\Carbon::parse($visitform->signed_date)->isoFormat('MM/DD/YYYY') }} @endif &nbsp;</span>&nbsp;</span>
                            </td>
                        </tr>
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