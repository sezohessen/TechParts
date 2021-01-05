<?php

namespace Database\Seeders;

use App\Models\Country;
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
        foreach (range(1,10) as $value){
            DB::table('cities')->insert([
                'title'             =>   $faker->country,
                'title_ar'          =>   $faker->country,
                'country_id'        =>   Country::all()->random()->id,
                'governorate_id'    =>   Governorate::all()->random()->id,
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
                'active'            =>  1,
            ]);
        }
    }
}
