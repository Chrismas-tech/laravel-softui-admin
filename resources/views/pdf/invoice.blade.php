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
        COMPAÑÍA DE REPARACIONES Y ASISTENCIA PARA PRODUCTOS BLANCO, MARRÓN Y GRIS, S.L. <br />
        inscrita en el Registro Mercantil de Madrid, al Tomo 28.354, folio 199, sección 8, hoja número M-510.662
        inscripción primera
    </footer>

    <div class="container">
        <header>
            <table>
                <tr>
                    <td width="35%" style="text-align: right;">
                        <img src="{{ public_path('assets/img/logo-ct-dark.png') }}" alt="">
                    </td>
                    <td width="50%;">
                        <h1>Factura number INVOICE</h1>
                    </td>
                </tr>
            </table>
        </header>

        <div class="heading-invoice">
            <div class="left">
                <h4 style="font-weight: normal;">
                    <strong>MI GARANTIA ELECTRO</strong> <br />
                    (Compañía De Reparaciones <br />
                    Y Asistencia Para Productos <br />
                    Blanco Marrón Y Gris S.L.)
                </h4>

                <p>
                    NIF: B-86123486
                    <br />
                    Carretera de Canillas 134 <br />
                    28043 Madrid (Madrid)<br />
                    TLF: 911087628 <br />
                    Email: sac@migarantiaelectro.es
                </p>
            </div>
            <div class="right">
                <p style="padding: 0; margin: 0;">
                <h4 style="font-size: 18px;">14</h4>

                addres <br />
                postcode -
                city
                <br />
                identity-card-type :
                <strong>identity-card-number</strong><br />
                <br />
                Fecha operación: date
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
                            <th>Serie</th>
                            <th>Número</th>
                            <th>Fecha</th>
                            <th>Nº Cliente</th>
                        </tr>
                        <tr>
                            <td>MGE</td>
                            <td>number invoice</td>
                            <td>date paid at</td>
                            <td>warranty Number</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 30px;">
                <table class="table-second">
                    <tbody>
                        <tr>
                            <th>Artículo</th>
                            <th style="text-align: left;">Descripción</th>
                            <th>Unidades</th>
                            <th>Precio</th>
                            <th>Importe (EUR)</th>
                        </tr>
                        <tr>
                            <td class="b-none">MGE</td>
                            <td style="text-align: left;border:none;">
                                Garantia anual MultiAparatos (lavadora, lavavajillas, frigorifico)
                            </td>
                            <td style="text-align: right;border:none;">1.00</td>
                            <td style="text-align: right;border:none;">
                                ex base Iva</td>
                            <td style="text-align: right;border:none;">
                                ex base Iva</td>
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
                            <td colspan="2" style="padding: 5px; text-align:right;"><strong>Líquido (EUR)</strong>
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
