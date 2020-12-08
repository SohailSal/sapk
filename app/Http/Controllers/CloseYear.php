<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountGroup;
use App\Models\Account;
use App\Models\Entry;

class CloseYear extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        DB::transaction(function () {
            $year =  \App\Models\Year::where('company_id',session('company_id'))->where('enabled',1)->first();
            $claccount;
            
            if(! Account::where('company_id',session('company_id'))->where('name','Income Summary')->first()){
                $claccount = Account::create([
                'name' => 'Income Summary',
                'group_id' => AccountGroup::where('company_id',session('company_id'))->latest()->first()->id,
                'company_id' => session('company_id'),
                ]);
            } else {
                $claccount = Account::where('company_id',session('company_id'))->where('name','Income Summary')->first();
            }

            $doc = \App\Models\Document::create([
                    'ref' => 'close',
                    'date' => $year->end,
                    'description' => 'To the record the closing entry.',
                    'type_id' => \App\Models\DocumentType::where('company_id',session('company_id'))->first()->id,
                    'company_id' => session('company_id'),
                ]);

            $id4= \App\Models\AccountType::where('name','Revenue')->first()->id;
            $id5= \App\Models\AccountType::where('name','Expenses')->first()->id;
            $grps4 = AccountGroup::where('company_id',session('company_id'))->where('type_id',$id4)->orWhere('type_id',$id5)->get();
            $balance4 = [];
            $ite4 = 0;
            foreach($grps4 as $group){
                foreach($group->accounts as $account){
                    $balance = 0;
                    $lastbalance = 0;
                    foreach ($account->entries as $entry){
                        if(($entry->document->date >= $year->begin)&&($entry->document->date <= $year->end)){
                            $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                            $lastbalance = $balance;
                        }
                    }
                    $balance4[$ite4++] = $balance;
                    $balance = -1 * $balance;
                    Entry::create([
                        'document_id' => $doc->id,
                        'account_id' => $account->id,
                        'debit' => ($balance < 0)? '0': $balance,
                        'credit' => ($balance > 0)? '0': abs($balance),
                        'company_id' => session('company_id'),
                    ]);
                }
            }


//            $profit = abs(array_sum($gbalance4)) - array_sum($gbalance5);

            Entry::create([
                'document_id' => $doc->id,
                'account_id' => $claccount->id,
                'debit' => (array_sum($balance4) < 0)? '0': array_sum($balance4),
                'credit' => (array_sum($balance4) > 0)? '0': abs(array_sum($balance4)),
                'company_id' => session('company_id'),
            ]);
            

            $year->update(['closed' => 1]);
        });
        session()->flash('message', 'Fiscal Year closed successfully.');
        return view('report');
    }
}
