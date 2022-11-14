<style type="text/css" media="print">
        /*@media print {
	        * {-webkit-print-color-adjust: exact}
        }*/

        * {
            background-image: none !important;
        }

        .page {
            width: 297mm;
            min-height: 210mm;
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
            size: landscape !important;
            margin: 15pt 25pt;
        }

        @media print {

            html,
            body {
                width: 297mm;
                height: 95%;
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