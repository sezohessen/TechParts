<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        for ($i = 0; $i < 40; $i++) {
            DB::table('finance_requests')->insert([
                'self_employed'             => $faker->boolean,
                'salary_through_bank'       => $faker->boolean,
                'monthly_salary'            => $faker->numberBetween(4000, 10000),
                'paid_loan'                 => $faker->boolean,
                'existing_loans'            => $faker->boolean,
                'provide_amount'            => $faker->numberBetween(4000, 10000),
                'existing_credit'           => $faker->boolean,
                'user_id'                   => User::all()->random()->id,
                'status'                    => $faker->randomElement(['pending', 'approved', 'canceled']),
                'created_at'                => now(),
                'updated_at'                => now(),
            ]);
        }
    }
}
