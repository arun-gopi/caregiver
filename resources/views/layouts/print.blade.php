<!DOCTYPE html>

<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Home Health Agency Reports" />
    <!-- Material Design Iconic Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <style type="text/css">
        .portrait {
            height: 800pt;
            width: 100%;
            margin: 0 auto;
        }

        .portrait>tbody>tr>td,
        .portrait>thead>tr>td,
        .portrait>thead>tr>td {
            padding: 0;
        }

        .icon-sm {
            height: 16px;
            width: 16px;
        }

        .icon-xs {
            height: 14px;
            width: 14px;
        }

        .text-lowercase {
            text-transform: lowercase !important; }

        .text-uppercase {
            text-transform: uppercase !important; }

        .text-capitalize {
            text-transform: capitalize !important; }

        .imgaligncenter {
            display: flex;
            align-items: center;
        }
        .itemaligncenter {
            display: flex;
            align-items: center;

        }
        .gap-0 {
            gap: 0 !important; }

        .gap-1 {
            gap: 0.25rem !important; }

        .gap-2 {
            gap: 0.5rem !important; }

        .gap-3 {
            gap: 1rem !important; }

        .gap-4 {
            gap: 1.5rem !important; }

        .gap-5 {
            gap: 3rem !important; }

        .landscape {
            height: 600pt;
            width: 828pt;
        }

        .chapter {
            margin-bottom: 10.8pt;
            border: solid 1px #ccc;
        }

        .last-chapter {
            border: solid 1px #ccc;
        }

        body {
            font-family: Calibri, Helvetica, Arial, sans-serif;
            background-color: #1F1F1F;
            font-weight: 300;
            color: #000;
            font-size: 9pt;
        }

        .container {
            background-color: #fff;
            padding: 20pt 25pt;
            margin: 15pt auto;
            overflow: visible;
        }

        .container.portrait {
            width: 612pt;
            min-width: 612pt;
            max-width: 612pt;
            height: 100%;
        }

        .container.landscape {
            width: 828pt;
            min-width: 828pt;
            max-width: 828pt;
            height: 100%;
        }

        footer {
            text-align: right;
            padding-top: 7.5pt;
        }

        .header {
            text-align: right;
            padding-bottom: 7.5pt;
        }

        .alignleft {
            text-align: left !important;
        }

        .alignright {
            text-align: right !important;
        }

        .aligncenter {
            text-align: center !important;
        }

        /*Table*/
        .no-border,
        .no-border td,
        .no-border th {
            border: 0 !important;
        }

        table.fixed {
            table-layout: fixed;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            border: 0;
        }

        thead th,
        thead td {
            border: 0;
        }

        thead {
            display: table-header-group;
        }

        tfoot td {}

        tbody {
            display: table-row-group;
        }

        tbody td {
            vertical-align: top;
        }

        table.inner {
            width: 100%;
            border: 0;
            table-layout: auto;
        }

        table tr.inner td {
            vertical-align: top;
            padding: 3.5pt 4pt !important;
            height: 10pt;
        }

        table.inner td {
            vertical-align: top;
            padding: 3.5pt 4pt;
        }

        table.inner.divider {
            border: 0 !important;
        }

        table.inner.sm-pad td {
            padding: 2pt 3pt;
        }

        table.inner.semi.divider td {
            padding: 3.5pt 0;
        }

        table.inner.semipad.divider td {
            padding: 1.5pt 0;
        }

        table.inner.divider>thead>tr>td,
        table.inner.divider>tbody>tr>td {
            padding: 0;
        }

        table.inner .span10 {
            width: 83.333333333%;
        }

        table.inner .span9 {
            width: 75%;
        }

        table.inner .span8 {
            width: 66.66666667%;
        }

        table.inner .span7 {
            width: 58.33333333%;
        }

        table.inner .span6 {
            width: 50%;
        }

        table.inner .span5 {
            width: 41.66666667%;
        }

        table.inner .span4 {
            width: 33.33%;
        }

        table.inner .span3 {
            width: 25%;
        }

        table.inner .span2 {
            width: 16.66666667%;
        }

        table.inner .span1 {
            width: 8.333333333%;
        }

        table.inner .noborder {
            border: none !important;
        }

        table.inner td.pl5 {
            padding-left: 5pt;
        }

        table.inner td.pl10 {
            padding-left: 10pt;
        }

        table.inner.divider td.pl5 {
            padding-left: 5pt;
        }

        table.inner.divider td.pl10 {
            padding-left: 10pt;
        }

        table.inner.divider td.pl15 {
            padding-left: 15pt;
        }

        .border-top {
            border-top: solid 1px #ccc;
        }

        .no-border-top {
            border-top: none !important;
        }

        .border-bottom {
            border-bottom: solid 1px #ccc;
        }

        .no-border-bottom {
            border-bottom: none !important;
        }

        .border-right {
            border-right: solid 1px #ccc;
        }

        .border-left {
            border-left: solid 1px #ccc;
        }

        table.border-bottom td,
        .border-bottom th {
            border-bottom: solid 1px #ccc;
        }

        table.wpd td {
            vertical-align: top;
            padding: 5px 0 5px;
        }

        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered td {
            border: 1px solid #ccc;
        }

        table.valignmiddle {
            vertical-align: middle;
        }

        .vamiddle {
            vertical-align: middle !important;
        }

        .pt2-5 {
            padding-top: 2.5pt;
        }

        .pt3 {
            padding-top: 3pt;
        }

        .pt3-5 {
            padding-top: 3.5pt;
        }

        .pt4 {
            padding-top: 4pt;
        }

        .pt4-5 {
            padding-top: 4.5pt;
        }

        .pt5 {
            padding-top: 5pt;
        }

        .pt7-5 {
            padding-top: 7.5pt;
        }

        .pl5 {
            padding-left: 5pt;
        }

        .pl10 {
            padding-left: 10pt;
        }

        .pl15 {
            padding-left: 15pt;
        }

        .pl20 {
            padding-left: 20pt;
        }

        .pl30 {
            padding-left: 30pt;
        }

        .pl40 {
            padding-left: 40pt;
        }

        .pr10 {
            padding-right: 10pt;
        }

        .pb10 {
            padding-bottom: 10pt;
        }

        .c10 {
            width: 1%;
        }

        .c20 {
            width: 20%;
        }

        .c30 {
            width: 30%;
        }

        .c40 {
            width: 40%;
        }

        .c50 {
            width: 50%;
        }

        .c60 {
            width: 60%;
        }

        .c70 {
            width: 70%;
        }

        .c80 {
            width: 80%;
        }

        /* Links */
        a {
            color: #000000;
            border-bottom: 1px solid #dddddd;
            -o-transition: color 0.5s ease-out, background 0.6s ease-in;
            -ms-transition: color 0.5s ease-out, background 0.6s ease-in;
            -moz-transition: color 0.5s ease-out, background 0.6s ease-in;
            -webkit-transition: color 0.5s ease-out, background 0.6s ease-in;
            transition: color 0.5s ease-out, background 0.6s ease-in;
        }

        a:hover {
            color: #333333;
            background: #F9F9F9;
            text-decoration: none;
        }

        footer a {
            padding: 0;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5 {
            color: #000;
        }

        h1 {
            font-size: 21pt;
        }

        h2 {
            font-size: 18pt;
        }

        h3 {
            font-size: 15pt;
            margin: 5pt auto;
        }

        h4 {
            font-size: 13pt;
            margin: 0 auto;
        }

        h4 small {
            display: block;
            font-size: 11pt;
            color: #888888;
        }

        h5 {
            font-size: 12pt;
            line-height: 14pt;
            margin: 0 auto;
        }

        label {
            line-height: 12pt;
            margin: 0;
            /*padding-top:5pt;    */
        }

        label.inline {
            display: inline-block;
        }

        p {
            line-height: 12pt;
            margin: 0;
        }

        .form-horizontal .controls {
            margin-left: 14.5pt;
        }

        /** Calendar */
        .calendar {
            font-size: 10pt;
        }

        .calendar span {
            font-weight: 400;
            margin-right: 10pt;
        }

        .calendar table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .calendar th {
            font-size: 12pt;
            border: solid 1px #ccc;
            background-color: #dddddd;
        }

        .calendar td {
            text-align: right;

            padding-bottom: 2pt;
            line-height: 14pt;
            border: solid 1px #ccc;
        }

        /*
        [class*="span"] {
            float: left;
            min-height: 1px;
            margin-left: 30px;
          }
        */
        .row-fluid {
            width: 100%;
            *zoom: 1;
        }

        .row-fluid:before,
        .row-fluid:after {
            display: table;
            content: "";
            line-height: 0;
        }

        .row-fluid:after {
            clear: both;
        }

        .row-fluid [class*="span"] {
            display: block;
            width: 100%;
            /*min-height: 30px;*/
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            float: left;
            margin-left: 2%;
            *margin-left: 2%;
            /*margin-bottom: 10pt;*/
        }

        .row-fluid [class*="span"]:first-child {
            margin-left: 0;
        }

        .row-fluid .span12 {
            width: 100%;
            *width: 99.94680851063829%;
        }

        .row-fluid .span11 {
            width: 91.45299145299145%;
            *width: 91.39979996362975%;
        }

        .row-fluid .span10 {
            width: 82.90598290598291%;
            *width: 82.8527914166212%;
        }

        .row-fluid .span9 {
            width: 74.35897435897436%;
            *width: 74.30578286961266%;
        }

        .row-fluid .span8 {
            width: 65.81196581196582%;
            *width: 65.75877432260411%;
        }

        .row-fluid .span7 {
            width: 57.26495726495726%;
            *width: 57.21176577559556%;
        }

        .row-fluid .span6 {
            width: 48.717948717948715%;
            *width: 48.664757228587014%;
        }

        .row-fluid .span5 {
            width: 40.42553191489362%;
            *width: 40.37234042553192%;
        }

        .row-fluid .span4 {
            width: 31.914893617021278%;
            *width: 31.861702127659576%;
        }

        .row-fluid .span3 {
            width: 23.404255319148934%;
            *width: 23.351063829787233%;
        }

        .row-fluid .span2 {
            width: 14.893617021276595%;
            *width: 14.840425531914894%;
        }

        .row-fluid .span1 {
            width: 6.382978723404255%;
            *width: 6.329787234042553%;
        }

        .form-horizontal .control-group {
            /*margin-bottom: 20px;*/
            *zoom: 1;
        }

        .form-horizontal .control-group:before,
        .form-horizontal .control-group:after {
            display: table;
            content: "";
            line-height: 0;
        }

        .form-horizontal .control-group:after {
            clear: both;
        }

        .form-horizontal .control-label {
            float: left;
            /*width: 160px;
          padding-top: 5px;*/
            text-align: right;
        }

        .form-horizontal .controls {
            *display: inline-block;
            /**padding-left: 20px;*/
            *margin-left: 0;
        }

        .radio,
        .checkbox {
            line-height: 9pt;
            font-weight: normal;
            /*min-height: 18px;
          padding-left: 18px;*/
        }

        .radio.inline,
        .checkbox.inline {
            display: inline-block;
            margin-right: 5pt;
        }

        /*.radio input[type="radio"],
        .checkbox input[type="checkbox"] {
          float: left;
          margin-left: -18px;
        }*/
        .radio>label,
        .checkbox>label {
            font-weight: normal;
            line-height: 9pt;
        }

        label {
            display: block;
            /*margin-bottom: 5px;*/
        }

        .row-fluid label {
            font-weight: normal;
        }

        .alt {
            /*background-color: #dddddd;*/
            border-top: solid 1px #ddd;
            border-bottom: solid 1px #ddd;
            padding: 4px 0 4px;
        }

        .inline {
            display: inline-block;
        }

        .mr-5 {
            margin-right: 5pt;
        }

        img {
            height: 12px;
            width: 12px;
            margin: 3px 3px 0 3px;
        }

        .compress img {
            height: 10px;
            width: 10px;
            margin: 3px 3px 0 3px;
        }

        b,
        strong {
            font-weight: bold;
        }

        .h0 {
            height: 0 !important;
            visibility: hidden !important;
        }

        .h10 {
            height: 10pt;
        }

        .h20 {
            height: 20pt;
        }

        .h25 {
            height: 25pt;
        }

        .h30 {
            height: 30pt;
        }

        .h40 {
            height: 40pt;
        }

        .h50 {
            height: 50pt;
        }

        .h60 {
            height: 60pt;
        }

        .h70 {
            height: 70pt;
        }

        .h80 {
            height: 80pt;
        }

        .h90 {
            height: 90pt;
        }

        .h100 {
            height: 100pt;
        }

        .h200 {
            height: 200pt;
        }

        .h300 {
            height: 300pt;
        }

        .h400 {
            height: 400pt;
        }

        .h500 {
            height: 500pt;
        }

        .h600 {
            height: 600pt;
        }

        .h700 {
            height: 700pt;
        }

        .h800 {
            height: 800pt;
        }

        .grey-bg {
            background-color: #dddddd;
        }

        .lightgrey-bg {
            background-color: #f6f6f6;
        }

        .black-bg {
            color: white;
            background-color: black;
        }

        .narrow {
            /*font-family: "Calibri Narrow","Helvetica Narrow", "Arial Narrow";*/
            font-size: 8pt;
            line-height: 10pt;
        }

        .big {
            font-size: 12pt;
        }

        .big p {
            font-size: 12pt;
        }

        .regular {
            font-size: 10pt;
        }

        .regular p {
            font-size: 10pt;
        }

        .small {
            font-size: 80%;
        }

        .footer-note {
            font-size: 7.5pt;
        }

        .bordered-top {
            margin-bottom: 9pt;
            border-top: solid 1px #ccc;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .white-space-pre {
            white-space: pre;
        }


        .texthighlightsmall {
            color: steelblue;
            /*#0077a9*/
            font-size: 11pt;
            font-weight: bold;
        }

        .texthighlightmed {
            color: steelblue;
            /*#0077a9*/
            font-size: 18pt;
            font-weight: bold;
        }

        .textgray {
            color: gray;
        }

        .bold {
            font-weight: bold;
        }

        .controls {
            margin-right: 20pt;
            border-bottom: 1px solid #ccc;
            padding: 3pt 0;
        }

        .input {
            margin-right: 20pt;
            border-bottom: 1px solid #ccc;
            padding: 0 0 3pt;
        }

        .control-group {
            margin-bottom: 2.5pt;
        }

        .field {
            padding-left: 7.5pt;
        }

        .field .input {
            padding: 3pt 0;
        }

        .comment {
            height: 12pt;
        }

        .tbl-bordered.wrapup {
            border: 1px solid #ccc;
        }

        .tbl-bordered>tbody>tr>td {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        .tbl-bordered>tbody>tr>td:last-child {
            border-right: 0;
        }

        .tbl-bordered>tbody>tr:last-child>td {
            border-bottom: 0;
        }

        .doc-btn-wrap {
            position: fixed;
            bottom: 50px;
            right: 25px;
            z-index: 11;
        }

        .doc-btn-wrap .btn-icon {
            background-color: #2196f3;
            width: 50px;
            height: 50px;
            display: block;
            margin-bottom: 10px;
            text-align: center;
            padding: 0;
            color: #ffffff;
            border: 0;

            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .doc-btn-wrap .btn-icon i {
            line-height: 50px;
            font-size: 24px;
        }

        i.zmdi-dot-circle {
            font-size: 10px;
        }

        i.zmdi-caret-right-circle {
            font-size: 12px;
        }

        td.radio-code-entry-wrap {
            width: 0.1%;
        }

        .radio-code-entry {
            position: relative;
            padding-left: 32px;
            min-height: 20px;
        }

        .radio-code-entry.inline {
            display: inline-block;
            vertical-align: top;
        }

        .radio-code-entry:before {
            display: block;
            position: absolute;
            content: " ";
            top: 0;
            left: 27px;
            bottom: 0;
            border-left: 2px solid #f0f0f0;
        }

        .radio-code-entry .input-box {
            position: absolute;
            top: 0;
            left: 3px;
            width: 16px;
            height: 16px;
            line-height: 16px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            border: 2px solid #9e9e9e;
            background-color: transparent;
        }

        .blue {
            color: blue;
        }

        .green {
            color: green;
        }

        .red {
            color: red;
        }
    </style>

    <style type="text/css" media="print">
        /*@media print {
	        * {-webkit-print-color-adjust: exact}
        }*/

        * {
            background-image: none !important;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            background: white;
        }

        @page {
            font-family: Open Sans, Source Sans Pro, Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-stretch: normal;
            size: letter;
            margin: 0;

            margin: 15pt 25pt;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 95%;
                /*set to 0 to avoid extra blank page*/
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        /*@page :first{
	        margin: 10.8pt 15.8pt 20.8pt 10.8pt;
        }*/

        body {
            font-family: Calibri, Helvetica, Arial, sans-serif;
            background-color: #ffffff;
            font-weight: 300;
            color: #000;
            font-size: 8pt;
        }

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .container {
            overflow: visible;
            padding: 0;
        }

        table.chapter {
            page-break-after: always;
        }

        table.last-chapter {
            page-break-after: auto;
        }

        table.page-break-after {
            page-break-after: always;
        }

        table.no-page-break {
            page-break-after: auto;
        }

        table.page-break-before {
            page-break-before: always;
        }

        p {
            font-size: 8pt;
        }

        .lightgrey-bg {
            background-color: #f6f6f6;
            -webkit-print-color-adjust: exact;
        }


        .grey-bg {
            background-color: #dddddd;
            -webkit-print-color-adjust: exact;
        }

        .no-print {
            display: none;
        }

        .noPrintBorder {
            border: none;
        }

        .noPrintPadding {
            padding: 0;
        }

        .doc-btn-wrap {
            display: none;
        }

        ul {
            margin: 0 auto 10px;
            padding-left: 25px;
        }

        ul li {
            margin-bottom: 8px;
            font-size: 9pt;
        }

        ul li>ul {
            margin-top: 8px;
        }
    </style>

    <script type="text/javascript">
        window.onload = function() {
            //window.print();
            //setTimeout(function () { window.close(); }, 1);
        }
    </script>
</head>

<body>

    @yield('content')

    <div class="doc-btn-wrap embeded">
        <a href="#" onclick="javascript:window.print();" class="btn-icon">
            <i class="zmdi zmdi-print"></i>
        </a>
    </div>
    <script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>