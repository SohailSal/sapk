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
        DB::table('accounts')->insert([
        'name' => 'Advances',
        'group_id' => '19',
        ]);
        DB::table('accounts')->insert([
        'name' => 'Deposits',
        'group_id' => '19',
        ]);
        DB::table('accounts')->insert([
        'name' => 'Prepayments',
        'group_id' => '19',
        ]);
    }
}
