<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Balance Sheet</title>

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
            $year =  \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first();

                $id1= \App\Models\AccountType::where('name','Assets')->first()->id;
                $grps1 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id1)->get();
                $gbalance1 = [];
                $gite1 = 0;
                foreach($grps1 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        foreach ($entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance1[$gite1++] = $balance;
                }

                $id2= \App\Models\AccountType::where('name','Liabilities')->first()->id;
                $grps2 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id2)->get();
                $gbalance2 = [];
                $gite2 = 0;
                foreach($grps2 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        foreach ($entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance2[$gite2++] = $balance;
                }

                $id3= \App\Models\AccountType::where('name','Capital')->first()->id;
                $grps3 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id3)->get();
                $gbalance3 = [];
                $gite3 = 0;
                foreach($grps3 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        foreach ($entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance3[$gite3++] = $balance;
                }

                $id4= \App\Models\AccountType::where('name','Revenue')->first()->id;
                $grps4 = \App\Models\AccountGroup::where('company_id',session('company_id'))->where('type_id',$id4)->get();
                $gbalance4 = [];
                $gite4 = 0;
                foreach($grps4 as $group){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach($group->accounts as $account){

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        $cnt = count($entries);
                        foreach ($entries as $entry){
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

                        $entries = Illuminate\Support\Facades\DB::table('documents')
                            ->join('entries', 'documents.id', '=', 'entries.document_id')
                            ->whereDate('documents.date', '<=', $year->end)
                            ->where('documents.company_id',session('company_id'))
                            ->where('entries.account_id','=',$account->id)
                            ->select('entries.debit', 'entries.credit')
                            ->get();

                        $cnt = count($entries);
                        foreach ($entries as $entry){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $gbalance5[$gite5++] = $balance;
                }
            
            $profit = abs(array_sum($gbalance4)) - array_sum($gbalance5);
            $equity = abs(array_sum($gbalance2)) + abs(array_sum($gbalance3)) + $profit;

?>


<div class="information">
    <table width="100%" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th align="left" style="width: 50%;">
                    <h3>Balance Sheet</h3>
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
                    <strong>Amount in Rs.</strong>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td><strong>ASSETS</strong></td>
                <td></td>
            </tr>
            @foreach ($grps1 as $group)
                    @if($gbalance1[$loop->index]==0)
                    @continue
                    @endif
            <tr>
                <td style="width: 15%;">
                    {{$group->name}}
                </td>
                <td style="width: 10%;" align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($gbalance1[$loop->index],'Rs.'))}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td style="width: 15%;">
                    Assets - Total
                </td>
                <td style="width: 10%; border-top: 1pt solid black; border-bottom: 3pt double black;" align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency(array_sum($gbalance1),'Rs.'))}}
                </td>
            </tr>

            <tr>
                <td><strong>LIABILITIES</strong></td>
                <td></td>
            </tr>
            @foreach ($grps2 as $group)
                    @if($gbalance2[$loop->index]==0)
                    @continue
                    @endif
            <tr>
                <td style="width: 15%;">
                    {{$group->name}}
                </td>
                <td style="width: 10%;" align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency(abs($gbalance2[$loop->index]),'Rs.'))}}
                </td>
            </tr>
            @endforeach

            <tr>
                <td><strong>CAPITAL</strong></td>
                <td></td>
            </tr>
            @foreach ($grps3 as $group)
                    @if($gbalance3[$loop->index]==0)
                    @continue
                    @endif
            <tr>
                <td style="width: 15%;">
                    {{$group->name}}
                </td>
                <td style="width: 10%; " align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency(abs($gbalance3[$loop->index]),'Rs.'))}}
                </td>
            </tr>
            @endforeach
            @if($profit != 0)
            <tr>
                <td style="width: 15%;">
                    Accumulated Profit
                </td>
                <td style="width: 10%; " align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($profit,'Rs.'))}}
                </td>
            </tr>
            @endif
            <tr>
                <td style="width: 15%;">
                    Equity - Total
                </td>
                <td style="width: 10%; border-top: 1pt solid black; border-bottom: 3pt double black;" align="right">
                    {{str_replace(['Rs.','.00'],'',$fmt->formatCurrency($equity,'Rs.'))}}
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
