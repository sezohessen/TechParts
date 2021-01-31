<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BadgeSeeder extends Seeder
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
            DB::table('badges')->insert([
                'name'          => $faker->name,
                'name_ar'       => $faker->name,
                "active"        => rand(0,1),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
