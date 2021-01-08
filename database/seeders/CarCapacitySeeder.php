<?php

namespace Database\Seeders;

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
        foreach (range(1,5) as $value){
            DB::table('car_capacities')->insert([
                'capacity'       => $faker->numberBetween(100,1000),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
