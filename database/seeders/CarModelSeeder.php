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
        for ($i = 0; $i < 20; $i++) {
            DB::table('car_models')->insert([
                'name'          => $faker->name,
                'CarMaker_id'   => CarMaker::all()->random()->id,
                'active'        => rand(0, 1),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
