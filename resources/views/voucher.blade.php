<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voucher - {{$voucher->ref}}</title>

    <style type="text/css">
        @page {margin: 20px;}
        body {margin: 40px;}
        * {font-family: Verdana, Arial, sans-serif;}
        a {text-decoration: none;}
        table {font-size: medium; margin: 15px;}
        .pv table {margin: 15px; border: 2px solid;}
        .pv td {margin:10px;padding:10px; border-bottom: 2px solid; border-right:2px solid;}
        .information {background-color: #fff;}
        .information table {padding: 10px;}
    </style>
</head>
<body>
    <?php
            $fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
            $amt = new NumberFormatter( 'en_GB', NumberFormatter::SPELLOUT );
            $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');

            $total=99;
    ?>

<div class="information">
                <h1 align="center">{{$voucher->documentType->name}}</h1>
    <table width="100%">
        <tr>
            <td align="left" >
                Reference: <strong>{{$voucher->ref}}</strong>
            </td>
            <td align="center">
            </td>
            <td align="right">
                Dated: <strong>{{ \Carbon\Carbon::parse($voucher->date)->format('F d, Y')}}</strong>
            </td>
        </tr>
    </table>
</div>

<div class="pv">
    <table width="100%" style="border-collapse: collapse;">
        <tbody>
        <tr>
            <td style="width: 23%">Total:</td>
            <td style="width: 77%"><strong>Rs. {{ str_replace(['Rs.','.00'],'',$fmt->formatCurrency($total,'Rs.')) }}</strong></td>
        </tr>
        <tr>
            <td>In words:</td>
            <td><strong>Rupees {{$amt->format($total) }} only.</strong></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><strong>{{$voucher->description}}</strong></td>
        </tr>
        <tr>
            <td>Cheque #:</td>
            <td><strong></strong></td>
        </tr>
        <tr>
            <td>Payee:</td>
            <td><strong></strong></td>
        </tr>
        </tbody>
   </table>
 </div>
 <br>
 <br>
 <br>
 <br>
 <br>
<div>
<table width="100%">
    <tr>
        <td style="border-bottom: 2px solid; width: 20%"></td>
        <td style="width: 20%"></td>
        <td style="border-bottom: 2px solid; width: 20%"></td>
        <td style="width: 20%"></td>
        <td style="border-bottom: 2px solid; width: 20%"></td>
    </tr>
    <tr>
        <td align="centre">Prepared by</td>
        <td></td>
        <td align="centre">Checked by</td>
        <td></td>
        <td align="centre">Approved by</td>
    </tr>
</table>
</div>
</body>
</html>