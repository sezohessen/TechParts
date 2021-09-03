<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CarCapacitySeeder extends Seeder
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
            DB::table('car_capacities')->insert([
                'capacity'      => $faker->numberBetween(1000, 5000),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
