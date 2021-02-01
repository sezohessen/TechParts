<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class car_featureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Features  =  Feature::where('active', 1)->get();
        $cars = Car::all();
        foreach ($cars as  $car) {
            DB::table('car_features')->insert([
                'car_id'        => $car->id,
                'feature_id'    => $Features->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            DB::table('car_features')->insert([
                'car_id'        => $car->id,
                'feature_id'    => $Features->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
