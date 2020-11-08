<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profit or Loss Account</title>

    <style type="text/css">
        @page {margin-right: 10px;margin-left:45px; margin-top:-10px;}
        body {margin: 10px;}
        * {font-family: Verdana, Arial, sans-serif;}
        a {text-decoration: none;}
        table {font-size: x-small;}
        tfoot tr td {font-weight: bold;font-size: medium;}
        .invoice table {margin: 5px;}
        .invoice h3 {margin-left: 5px;}
        .information {background-color: #fff;}
        .information .logo {margin: 5px;}
        .information table {padding: 5px;}
        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
</head>
<body>
<?php
            $fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
            $amt = new NumberFormatter( 'en_GB', NumberFormatter::SPELLOUT );
            $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
            $dt = \Carbon\Carbon::now(new DateTimeZone('Asia/Karachi'))->format('M d, Y - h:m a');

                $id4= \App\Models\AccountType::where('name','Revenue')->first()->id;
                $grps4 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id4)->get();
                $gbalance4 = [];
                $gite4 = 0;
                foreach($grps4 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){
                        foreach ($account->entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance4[$gite4++] = $balance;
                }

                $id5= \App\Models\AccountType::where('name','Expenses')->first()->id;
                $grps5 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id5)->get();
                $gbalance5 = [];
                $gite5 = 0;
                foreach($grps5 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){
                        foreach ($account->entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance5[$gite5++] = $balance;
                }
?>

<div class="information">
    <table width="100%" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th align="left" style="width: 50%;">
                    <h3>Profit or Loss Account</h3>
                </th>
                <th colspan='2' align="right" style="width: 30%;">
                    <h5>Generated on: {{ $dt}}</h5>
                </th>
            </tr>
            <tr>
                <th style="width: 70%;border-bottom:2pt solid black;">
                    <strong></strong>
                </th>
                <th style="width: 15%;border-bottom:2pt solid black;" align="centre">
                    <strong>Amount</strong>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td><strong>REVENUE</strong></td>
                <td></td>
            </tr>
            @foreach ($grps4 as $group)
                    @if($gbalance4[$loop->index]==0)
                    @continue
                    @endif
            <tr>
                <td style="width: 15%;">
                    {{$group->name}}
                </td>
                <td style="width: 10%; border-left: 1pt solid black;" align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($gbalance4[$loop->index],'Rs.'))}}
                </td>
            </tr>
            @endforeach

            <tr>
                <td><strong>EXPENSES</strong></td>
                <td></td>
            </tr>
            @foreach ($grps5 as $group)
                @if($gbalance5[$loop->index]==0)
                @continue
                @endif
            <tr>
                <td style="width: 15%;">
                    {{$group->name}}
                </td>
                <td style="width: 10%; border-left: 1pt solid black;" align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($gbalance5[$loop->index],'Rs.'))}}
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<br/>
<script type="text/php">
    if (isset($pdf)) {
        $x = 500;
        $y = 820;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 10;
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $word_space, $char_space, $angle);
    }
</script>
</body>
</html>
