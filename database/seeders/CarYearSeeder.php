<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarYearSeeder extends Seeder
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
            DB::table('car_years')->insert([
                'year'          => $faker->year,
                'CarModel_id'    => CarModel::all()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
