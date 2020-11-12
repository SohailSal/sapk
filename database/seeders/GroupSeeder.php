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
        DB::table('account_groups')->insert([
        'name' => 'Advances, Deposits & Prepayments',
        'type_id' => '1',
        'company_id' => session('company_id'),
        ]);
        $this->call([
            AccountSeeder::class,
        ]);
    }
}
