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
        'name' => 'Advances, Deposits & Prepayments',
        'type_id' => $type_id,
        'company_id' => session('company_id'),
        ]);
        $this->call([
            AccountSeeder::class,
        ]);
    }
}
