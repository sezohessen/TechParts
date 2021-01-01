<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
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
            DB::table('countries')->insert([
                'name'      =>   $faker->country,
                'name_ar'   =>   $faker->country,
                'code'      =>   $faker->name,
                'created_at' =>  now(),
                'updated_at' =>  now(),
            ]);
        }
    }
}
