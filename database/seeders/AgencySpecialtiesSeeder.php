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
        for ($i = 0; $i < 40; $i++) {
            DB::table('agency_specialties')->insert([
                'specialty_id'          => Specialties::all()->random()->id,
                'agency_id'             => Agency::all()->random()->id,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
