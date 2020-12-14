<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trial Balance</title>

    <style type="text/css">
        @page {margin: 20px;}
        body {margin: 10px;}
        * {font-family: Verdana, Arial, sans-serif;}
        a {text-decoration: none;}
        table {font-size: x-small;}
        tfoot tr td {font-weight: bold;font-size: medium;}
        .invoice table {margin: 15px;}
        .invoice h3 {margin-left: 15px;}
        .information {background-color: #fff;}
        .information .logo {margin: 5px;}
        .information table {padding: 10px;}
        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
</head>
<body>
    <?php
            $fmt = new NumberFormatter( 'en_GB', NumberFormatter::CURRENCY );
            $amt = new NumberFormatter( 'en_GB', NumberFormatter::SPELLOUT );
            $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
            $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
            $year =  \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first();

                $obalance = [];
                $oite= 0;
                foreach ($accounts as $account) {
                    $balance = 0;
                    $lastbalance = 0;
                    $isExpense = ($account->accountGroup->accountType->name == 'Expenses')? true : false;
                    $isRevenue = ($account->accountGroup->accountType->name == 'Revenue')? true : false;
                    $isProfit =  ($account->name == 'Accumulated Profit')? true : false;

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        $cnt = count($entries);
                        foreach ($entries as $entry){
                            if((--$cnt <= 0) && ($year->closed) && ($isExpense || $isRevenue || $isProfit)){
                                break;
                            }
                        $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                        $lastbalance = $balance;
                    }
                    $obalance[$oite++] = $balance;
                }

                $debit = 0;
                $credit = 0;
                for($i=0;$i<count($obalance);$i++){
                    if($obalance[$i]>0){
                        $debit = $debit + $obalance[$i];
                    }
                    else {
                        $credit = $credit + $obalance[$i];
                    }
                }

           $dt = \Carbon\Carbon::now(new DateTimeZone('Asia/Karachi'))->format('M d, Y - h:m a');
    ?>


<div class="information">
    <table width="100%" style="border-collapse: collapse;">
            <thead>
            <tr>
            <th align="left" style="width: 50%;">
            <h3>Trial Balance</h3>
            </th>
            <th colspan='2' align="right" style="width: 30%;">
                <h5>Generated on: {{ $dt}}</h5>
            </th>
            </tr>


        <tr>
            <th style="width: 70%;border-bottom:2pt solid black;">
                <strong>Head of Account</strong>

            </th>
            <th style="width: 15%;border-bottom:2pt solid black;" align="centre">
                <strong>Debit</strong>

            </th>
            <th style="width: 15%;border-bottom:2pt solid black;" align="centre">
                <strong>Credit</strong>

            </th>
        </tr>
            </thead>
            <tbody>
        @foreach ($accounts as $account)
                @if($obalance[$loop->index]==0)
                @continue
                @endif

        <tr>
            <td style="width: 15%;">
                {{$account->name}}
            </td>
            <td style="width: 10%; border-left: 1pt solid black;" align="right">
                @if($obalance[$loop->index]>0)
                {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($obalance[$loop->index],'Rs.'))}}
                @endif
            </td>
            <td style="width: 10%; border-left: 1pt solid black; border-right: 1pt solid black;" align="right">
                @if($obalance[$loop->index]<0)
                {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency(abs($obalance[$loop->index]),'Rs.'))}}
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
                <td>
                <strong>Total</strong>
                </td>
                <td style="width: 10%; border-left: 1pt solid black; border-top: 1pt solid black; border-bottom: 3pt double black;" align="right">
                {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($debit,'Rs.'))}}
                </td>
                <td style="width: 10%; border-left: 1pt solid black; border-right: 1pt solid black; border-top: 1pt solid black; border-bottom: 3pt double black;" align="right">
                {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency(abs($credit),'Rs.'))}}
                </td>
        </tr>
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
