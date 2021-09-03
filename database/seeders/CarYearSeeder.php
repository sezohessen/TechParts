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
        $carModel   = CarModel::all();
        for ($i = 0; $i < 40; $i++) {
            DB::table('car_years')->insert([
                'year'          => $faker->year,
                'CarModel_id'   => $carModel->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
