<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $governorate = Governorate::all();
        for ($i = 0; $i < 40; $i++) {
            DB::table('cities')->insert([
                'title'             =>  $faker->country,
                'title_ar'          =>  $faker->country,
                'governorate_id'    =>  $governorate->random()->id,
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }
    }
}
