<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountType;
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
        DB::transaction(function () {
                if(count(AccountType::all()) == 0){
                AccountType::create([
                'name' => 'Assets',
                ]);
                AccountType::create([
                'name' => 'Liabilities',
                ]);
                AccountType::create([
                'name' => 'Capital',
                ]);
                AccountType::create([
                'name' => 'Revenue',
                ]);
                AccountType::create([
                'name' => 'Expenses',
                ]);
            }
        });

        $this->call([
            GroupSeeder::class,
        ]);
    }
}
