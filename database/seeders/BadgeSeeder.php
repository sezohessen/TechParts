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
        foreach (range(1,5) as $value){
            DB::table('badges')->insert([
                'name'          => $faker->name,
                'name_ar'       => $faker->name,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
