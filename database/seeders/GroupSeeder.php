<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $type_id = \App\Models\AccountType::where('name','Assets')->first()->id;
        DB::table('account_groups')->insert([
        'name' => 'Fixed Assets',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Stock-in-Trade',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Accounts Receivables',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Loans & Advances',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Deposits, Prepayments & Other Receivables',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Cash & Bank',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);

        $type_id = \App\Models\AccountType::where('name','Capital')->first()->id;
        DB::table('account_groups')->insert([
        'name' => 'Equity',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Reserves',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);

        $type_id = \App\Models\AccountType::where('name','Liabilities')->first()->id;
        DB::table('account_groups')->insert([
        'name' => 'Long Term Liabilities',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Short Term Loans',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Advances, Deposits & Other Liabilities',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Accounts Payables',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);

        $type_id = \App\Models\AccountType::where('name','Revenue')->first()->id;
        DB::table('account_groups')->insert([
        'name' => 'Sales & Service',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Other Income',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);

        $type_id = \App\Models\AccountType::where('name','Expenses')->first()->id;
        DB::table('account_groups')->insert([
        'name' => 'Operating Expenses',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Administrative Expenses',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('account_groups')->insert([
        'name' => 'Taxes',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);


        $this->call([
            AccountSeeder::class,
        ]);
    }
}
