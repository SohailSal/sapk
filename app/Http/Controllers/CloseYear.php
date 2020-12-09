<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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
            $yearef = Carbon::parse($year->end);
            $claccount;
            
            if(! Account::where('company_id',session('company_id'))->where('name','Accumulated Profit')->first()){
                $claccount = Account::create([
                'name' => 'Accumulated Profit',
                'group_id' => AccountGroup::where('company_id',session('company_id'))->first()->id,
                'company_id' => session('company_id'),
                ]);
            } else {
                $claccount = Account::where('company_id',session('company_id'))->where('name','Accumulated Profit')->first();
            }

            $doc = \App\Models\Document::create([
                    'ref' => 'CL/' . $yearef->year . '/' . $yearef->month . '/00',
                    'date' => $year->end,
                    'description' => 'To the record the closing entry.',
                    'type_id' => \App\Models\DocumentType::where('company_id',session('company_id'))->first()->id,
                    'company_id' => session('company_id'),
                ]);

            $id4= \App\Models\AccountType::where('name','Revenue')->first()->id;
            $id5= \App\Models\AccountType::where('name','Expenses')->first()->id;
            $grps4 = AccountGroup::where('company_id',session('company_id'))
                        ->where(function (Builder $query)  use ($id4,$id5) {
                            return $query->where('type_id',$id4)
                                         ->orWhere('type_id',$id5);
                        })->get();

            $balance4 = [];
            $ite4 = 0;
            foreach($grps4 as $group){
                foreach($group->accounts as $account){
                    $balance = 0;
                    $lastbalance = 0;

                    $entries = DB::table('documents')
                        ->join('entries', 'documents.id', '=', 'entries.document_id')
                        ->whereDate('documents.date', '>=', $year->begin)
                        ->whereDate('documents.date', '<=', $year->end)
                        ->where('documents.company_id',session('company_id'))
                        ->where('entries.account_id','=',$account->id)
                        ->select('entries.debit', 'entries.credit')
                        ->get();

                    foreach ($entries as $entry){
                        $balance= $lastbalance + floatval($entry->debit) - floatval($entry->credit);
                        $lastbalance = $balance;
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
