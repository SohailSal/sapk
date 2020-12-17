<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
//        DB::transaction(function () {

            $fa = ["Land","Building", "Plant & Machinery","Furniture & Fixtures","Office Equipment", "Vehicles", "Allowance for Depreciation - Building", "Allowance for Depreciation - Plant & Machinery","Allowance for Depreciation - Furniture & Fixtures","Allowance for Depreciation - Office Equipment", "Allowance for Depreciation - Vehicles"];
            $group_id = \App\Models\AccountGroup::where('name','Fixed Assets')->where('company_id',session('company_id'))->first()->id;
            for($i=0;$i<count($fa);$i++){
                $account = Account::create([
                'name' => $fa[$i],
                'group_id' => $group_id,
                'company_id' => session('company_id'),
                ]);
                $account->update(['number' => $this->snum($account)]);
            }
            $group_id = \App\Models\AccountGroup::where('name','Stock-in-Trade')->where('company_id',session('company_id'))->first()->id;
            DB::table('accounts')->insert([
            'name' => 'Stock 1',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);

            $group_id = \App\Models\AccountGroup::where('name','Cash & Bank')->where('company_id',session('company_id'))->first()->id;
            DB::table('accounts')->insert([
            'name' => 'Cash at Bank',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);
            DB::table('accounts')->insert([
            'name' => 'Cash in Hand',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);

            $group_id = \App\Models\AccountGroup::where('name','Equity')->where('company_id',session('company_id'))->first()->id;
            DB::table('accounts')->insert([
            'name' => 'Share Capital',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);

            $group_id = \App\Models\AccountGroup::where('name','Reserves')->where('company_id',session('company_id'))->first()->id;
            DB::table('accounts')->insert([
            'name' => 'Accumulated Profit',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);

            $group_id = \App\Models\AccountGroup::where('name','Sales & Service')->where('company_id',session('company_id'))->first()->id;
            DB::table('accounts')->insert([
            'name' => 'Sales - Local',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);
            
            $opexp = ["Stock 1 Consumed","Salaries & Wages", "Repair & Maintenance","Rent, Rates & Taxes","Utilities", "Depreciation Expense"];
            $group_id = \App\Models\AccountGroup::where('name','Operating Expenses')->where('company_id',session('company_id'))->first()->id;
            for($i=0;$i<count($opexp);$i++){
                DB::table('accounts')->insert([
                'name' => $opexp[$i],
                'group_id' => $group_id,
                'company_id' => session('company_id'),
                ]);
            }

            $adexp = ["Salaries & Wages", "Repair & Maintenance","Travelling & Conveyance","Rent, Rates & Taxes","Utilities","Printing & Stationery", "Advertisement", "Legal & Professional","Depreciation Expense"];
            $group_id = \App\Models\AccountGroup::where('name','Administrative Expenses')->where('company_id',session('company_id'))->first()->id;
            for($i=0;$i<count($adexp);$i++){
                DB::table('accounts')->insert([
                'name' => $adexp[$i],
                'group_id' => $group_id,
                'company_id' => session('company_id'),
                ]);
            }

            $group_id = \App\Models\AccountGroup::where('name','Taxes')->where('company_id',session('company_id'))->first()->id;
            DB::table('accounts')->insert([
            'name' => 'Income Tax',
            'group_id' => $group_id,
            'company_id' => session('company_id'),
            ]);
//        });
    }

    function snum($account){
        $ty = $account->accountGroup->accountType;
        $grs = $ty->accountGroups->where('company_id',session('company_id'));
        $grindex = 1;
        $grselindex = 0;
        $grsel = null;
        $number;
        foreach($grs as $gr){
            if($gr->name == $account->accountGroup->name){
                $grselindex = $grindex;
                $grsel = $gr;
            }
            ++$grindex;
        }
        if(count($grsel->accounts) == 1){
            $number = $ty->id . sprintf("%'.03d", $grselindex) . sprintf("%'.03d", 1);
        } else {
            $lastac = Account::orderBy('id', 'desc')->where('company_id',session('company_id'))->where('group_id',$grsel->id)->skip(1)->first()->number;
            $lastst = Str::substr($lastac, 4, 3);
            $number = $ty->id . sprintf("%'.03d", $grselindex) . sprintf("%'.03d", ++$lastst);
        }
        return $number;
    }

}
