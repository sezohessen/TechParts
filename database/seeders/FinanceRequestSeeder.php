<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FinanceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //strval -> convert int to string
    {
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            DB::table('finance_requests')->insert([
                'self_employed'         => $faker->boolean,
                'salary_through_bank'   => $faker->boolean,
                'paid_loan'             => $faker->boolean,
                'existing_loans'        => $faker->boolean,
                'existing_credit'       => $faker->boolean,
                'monthly_salary'        => strval($faker->numberBetween(4000, 1000)), //As Row is string type
                'provide_amount'        => strval($faker->numberBetween(4000, 1000)), //As Row is string type
                'status'                => $faker->randomElement(['Approved', 'Canceled', 'Pending']),
                'user_id'               => User::all()->random()->id,
                'car_makerId'           => CarMaker::all()->random()->id,
                'car_modelId'           => CarModel::all()->random()->id,
                'car_id'                => Car::where('status', 1)->get()->random()->id,
                'bank_name'             => $faker->company,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
