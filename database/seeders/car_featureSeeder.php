<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class car_featureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $cars =  Car::where('status', 1)->get();
        $Features  =  Car::where('status', 1)->get();
        for ($i = 0; $i < 40; $i++) {
            DB::table('car_features')->insert([
                'car_id'        => $cars->random()->id,
                'feature_id'    => $Features->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
