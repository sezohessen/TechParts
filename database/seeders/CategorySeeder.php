<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
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
            DB::table('categories')->insert([
                'name'          => $faker->name,
                'name_ar'       => $faker->name,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
