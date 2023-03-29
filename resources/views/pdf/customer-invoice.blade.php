<!DOCTYPE html>
<html>

<head>
    <title></title>

    <style>
        body {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 98%;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            padding: 0 4px;
        }

        table td {
            padding: 0 4px;
        }

        header {
            margin-bottom: 20px;
        }

        header h1 {
            text-transform: uppercase;
            margin: 0;
        }

        header img {
            width: 80px;
        }

        .heading-invoice .left,
        .heading-invoice .right {
            width: 45%;
            display: inline-block;
            vertical-align: top;
            border: 1px solid #000;
            padding: 2%;
            min-height: 180px;
        }

        .invoice-details {
            margin-top: 30px;
        }

        .invoice-details th {
            background-color: rgb(207, 205, 205);
            border: solid 1px black;
        }

        .invoice-details td {
            text-align: center;
            border: solid 1px black;
        }

        .th-title {
            border-right: solid 1px black !important;
        }

        .table-first th:not(:last-child),
        .table-second th:not(:last-child),
        .table-third th:not(:last-child),
        .table-fourth th:not(:last-child),
        .table-fifth th:not(:last-child) {
            border-right: none;
        }

        .table-first td:not(:last-child),
        .table-second td:not(:last-child),
        .table-third td:not(:last-child),
        .table-fourth td:not(:last-child),
        .table-fifth td:not(:last-child) {
            border-right: none;
            border-top: none;
        }

        .b-none {
            border: none !important;
        }

        footer {
            font-size: 8px;
            font-family: Arial, Helvetica, sans-serif;
            position: fixed;
            left: 0px;
            right: 0px;
            bottom: 0px;
            text-align: center;
        }
    </style>
</head>

<body class="invoice">

    <footer>
        REPAIR AND ASSISTANCE COMPANY FOR WHITE, BROWN AND GREY PRODUCTS, S.L. <br />
        registered in the Mercantile Registry of Madrid, in Volume 28,354, Folio 199, Section 8, Sheet number M-510.662,
        first inscription.
    </footer>

    <div class="container">
        <header>
            <table>
                <tr>
                    <td width="35%" style="text-align: right;">
                        <img src="{{ public_path('assets/img/logo-ct-dark.png') }}" alt="">
                    </td>
                    <td width="50%;">
                        <h1>Invoice n° {{ $invoice->invoice_number }}</h1>
                    </td>
                </tr>
            </table>
        </header>

        <div class="heading-invoice">
            <div class="left">
                <h4 style="font-weight: normal;">
                    <strong>COMPANY NAME</strong> <br />
                    (Repair and Assistance Company for Electronics LLC)
                </h4>
                <p>
                    VAT: B-98765432
                    <br />
                    123 Main Street <br />
                    New York, NY 10001<br />
                    Phone: 212-555-1212 <br />
                    Email: info@electronicsrepairco.com
                </p>
                <p>
                    EIN: 12-3456789
                    <br />
                    456 Elm Avenue <br />
                    Los Angeles, CA 90001<br />
                    Phone: 310-555-1212 <br />
                    Email: info@electronicsrepairco.com
                </p>
            </div>
            <div class="right">
                <p style="padding: 0; margin: 0;">
                <h4 style="font-size: 18px;">14</h4>
                1234 Maple Street <br />
                90210 - Beverly Hills <br />
                ID card type: <strong>Driver's License</strong><br />
                <br />
                Operation date: 2023-03-29
                </p>
            </div>
        </div>

        <div class="invoice-details">
            <div>
                <table class="table-first">
                    <tbody>
                        <tr>
                            <th class="th-title" style="background-color: rgb(149, 149, 149);" colspan="2">FACTURA
                            </th>
                        </tr>
                        <tr>
                            <th>Series</th>
                            <th>Number</th>
                            <th>Date</th>
                            <th>Customer No.</th>
                        </tr>
                        <tr>
                            <td>MGE</td>
                            <td>invoice number</td>
                            <td>date paid</td>
                            <td>warranty number</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 30px;">
                <table class="table-second">
                    <tbody>
                        <tr>
                            <th>Item</th>
                            <th style="text-align: left;">Description</th>
                            <th>Units</th>
                            <th>Price</th>
                            <th>Amount (EUR)</th>
                        </tr>
                        <tr>
                            <td class="b-none">MGE</td>
                            <td style="text-align: left;border:none;">
                                Annual Multi-Device Warranty (Washing Machine, Dishwasher, Refrigerator)
                            </td>
                            <td style="text-align: right;border:none;">1.00</td>
                            <td style="text-align: right;border:none;">
                                excl. VAT</td>
                            <td style="text-align: right;border:none;">
                                excl. VAT</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 250px;">
                <table class="table-third">
                    <tbody>
                        <tr>
                            <th>Base IVA</th>
                            <th>% IVA</th>
                            <th>Cuota IVA</th>
                        </tr>
                        <tr>
                            <td>ex base Iva</td>
                            <td>ex base Iva</td>
                            <td>ex base Iva</td>
                        </tr>

                        <tr>
                            <td colspan="2" style="padding: 5px; text-align:right;"><strong>{{ $invoice->amount }} (EUR)</strong>
                            </td>
                            <td><strong>ex base Iva</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>
