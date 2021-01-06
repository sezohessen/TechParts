<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class finance_requestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $value){
            DB::table('finance_requests')->insert([
                'self_employed'             => $faker->boolean,
                'salary_through_bank'       => $faker->boolean,
                'monthly_salary'            => $faker->numberBetween(4000,10000),
                'paid_loan'                 => $faker->boolean,
                'existing_loans'            => $faker->boolean,
                'provide_amount'            => $faker->numberBetween(4000,10000),
                'existing_credit'           => $faker->boolean,
                'status'                    => $faker->randomElement(['pending', 'approved', 'canceled']),
                'created_at'                => now(),
                'updated_at'                => now(),
            ]);
        }
    }
}
