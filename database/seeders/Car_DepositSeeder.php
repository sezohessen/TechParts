<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Car_DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('car_deposits')->insert([
                'car_id'            => Car::where('status', 1)->get()->random()->id,
                'user_id'           => User::all()->random()->id,
                'price'             => $faker->numberBetween(1, 1000),
                "weaccept_order_id" => $faker->numberBetween(1, 1000),
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
