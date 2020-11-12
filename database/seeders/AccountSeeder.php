<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_id = \App\Models\AccountGroup::where('name','Advances, Deposits & Prepayments')->first()->id;
        DB::table('accounts')->insert([
        'name' => 'Advances',
        'group_id' => $group_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('accounts')->insert([
        'name' => 'Deposits',
        'group_id' => $group_id,
        'company_id' => session('company_id'),
        ]);
        DB::table('accounts')->insert([
        'name' => 'Prepayments',
        'group_id' => $group_id,
        'company_id' => session('company_id'),
        ]);
    }
}
