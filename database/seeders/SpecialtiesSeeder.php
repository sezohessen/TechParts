<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SpecialtiesSeeder extends Seeder
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
            DB::table('specialties')->insert([
                'name'                  => $faker->company,
                'name_ar'               => $faker->company,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
