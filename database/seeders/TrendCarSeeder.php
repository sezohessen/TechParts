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
        $Trendings =  Trending::all();
        foreach ($Trendings as $Trending ) {

            DB::table('trendings_cars')->insert([
                'car_id'           =>  $cars->random()->id,
                'trend_id'         => $Trending->id,
                'created_at'       => now(),
                'updated_at'       => now()
            ]);
            DB::table('trendings_cars')->insert([
                'car_id'           =>  $cars->random()->id,
                'trend_id'         => $Trending->id,
                'created_at'       => now(),
                'updated_at'       => now()
            ]);
        }
    }
}
