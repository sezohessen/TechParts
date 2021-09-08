<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            DB::table('governorates')->insert([
                'title'             =>   $faker->country,
                'title_ar'          =>   $faker->country,
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }
    }
}
