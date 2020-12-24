<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountGroup;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            $type_id = \App\Models\AccountType::where('name','Assets')->first()->id;
            AccountGroup::create([
            'name' => 'Fixed Assets',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Stock-in-Trade',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Accounts Receivables',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Loans & Advances',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Deposits, Prepayments & Other Receivables',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Cash & Bank',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);

            $type_id = \App\Models\AccountType::where('name','Capital')->first()->id;
            AccountGroup::create([
            'name' => 'Equity',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Reserves',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);

            $type_id = \App\Models\AccountType::where('name','Liabilities')->first()->id;
            AccountGroup::create([
            'name' => 'Long Term Liabilities',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Short Term Loans',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Advances, Deposits & Other Liabilities',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Accounts Payables',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);

            $type_id = \App\Models\AccountType::where('name','Revenue')->first()->id;
            AccountGroup::create([
            'name' => 'Sales & Service',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Other Income',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);

            $type_id = \App\Models\AccountType::where('name','Expenses')->first()->id;
            AccountGroup::create([
            'name' => 'Operating Expenses',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Administrative Expenses',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
            AccountGroup::create([
            'name' => 'Taxes',
            'type_id' => $type_id,
            'company_id' => session('company_id'),
            ]);
        });

        $this->call([
            AccountSeeder::class,
        ]);
    }
}
