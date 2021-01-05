<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TrendingSeeder extends Seeder
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
            DB::table('trendings')->insert([
                'car_id'        => Car::all()->random()->id,
                'day'           => now(),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}