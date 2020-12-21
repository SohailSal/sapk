<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(! DB::table('account_types')->get()){
            DB::transaction(function () {
                DB::table('account_types')->insert([
                'name' => 'Assets',
                ]);
                DB::table('account_types')->insert([
                'name' => 'Liabilities',
                ]);
                DB::table('account_types')->insert([
                'name' => 'Capital',
                ]);
                DB::table('account_types')->insert([
                'name' => 'Revenue',
                ]);
                DB::table('account_types')->insert([
                'name' => 'Expenses',
                ]);
            });
        }

        $this->call([
            GroupSeeder::class,
        ]);
    }
}
