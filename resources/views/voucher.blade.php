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
        .pv td {margin:10px;padding:2px; border-bottom: 2px solid; border-right:2px solid;border-top:2px solid;}
        .information {background-color: #fff;}
        .information table {padding: 0px;}
    </style>
</head>
<body>
    <?php
            $fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
            $amt = new NumberFormatter( 'en_GB', NumberFormatter::SPELLOUT );
            $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');

            $debits = $voucher->entries->sum('debit');
            $credits = $voucher->entries->sum('credit');
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
<div style="padding-left:18px"> Description: {{$voucher->description}} </div>
    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <th style="width: 70%">Description</th>
            <th style="width: 15%">Debit</th>
            <th style="width: 15%">Credit</th>
        </tr>
        <tbody>
        @foreach ($voucher->entries as $entry)
        <tr>
            <td style="width: 70%">{{$entry->account->name}} - {{$entry->account->accountGroup->name}}</td>
            <td style="width: 15%" align="right">{{ str_replace(['Rs.','.00'],'',$fmt->formatCurrency($entry->debit,'Rs.')) }}</td>
            <td style="width: 15%" align="right">{{ str_replace(['Rs.','.00'],'',$fmt->formatCurrency($entry->credit,'Rs.')) }}</td>
        </tr>
        @endforeach
        <tr>
            <td><strong>Total</strong></td>
            <td align="right"><strong>{{ str_replace(['Rs.','.00'],'',$fmt->formatCurrency($debits,'Rs.')) }}</strong></td>
            <td align="right"><strong>{{ str_replace(['Rs.','.00'],'',$fmt->formatCurrency($credits,'Rs.')) }}</strong></td>
        </tr>
        </tbody>
   </table>
<div style="padding-left:18px"> Amount in words: Rupees {{$amt->format($debits) }} only.</div>
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