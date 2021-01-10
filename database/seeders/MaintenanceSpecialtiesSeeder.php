<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MaintenanceSpecialtiesSeeder extends Seeder
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
            DB::table('maintenance_specialties')->insert([
                'name'                  => $faker->company,
                'name_ar'               => $faker->company,
                'active'                => $faker->boolean(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
