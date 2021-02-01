<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Trending;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TrendCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars =  Car::where('status', 1)->get();
        foreach ($cars as $car ) {

            DB::table('trendings_cars')->insert([
                'car_id'           =>  $car->id,
                'trend_id'         => Trending::all()->random()->id,
                'created_at'       => now(),
                'updated_at'       => now()
            ]);
        }
    }
}
