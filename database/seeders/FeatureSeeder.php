<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
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
            DB::table('features')->insert([
                'name'          => $faker->name,
                'name_ar'       => $faker->name,
                "active"        => rand(0,1),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
