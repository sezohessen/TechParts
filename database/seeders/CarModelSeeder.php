<?php

namespace Database\Seeders;

use App\Models\CarMaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $carMaker   = CarMaker::all();
        for ($i = 0; $i < 40; $i++) {
            DB::table('car_models')->insert([
                'name'          => $faker->name,
                'CarMaker_id'   => $carMaker->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
