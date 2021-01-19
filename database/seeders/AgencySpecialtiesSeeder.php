<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\AgencySpecialties;
use App\Models\Specialties;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AgencySpecialtiesSeeder extends Seeder
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
            DB::table('agency_specialties')->insert([
                'specialty_id'          => Specialties::all()->random()->id,
                'agency_id'             => Agency::all()->random()->id,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}