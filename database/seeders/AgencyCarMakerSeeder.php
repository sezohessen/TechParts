<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Car;
use App\Models\CarMaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AgencyCarMakerSeeder extends Seeder
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
            DB::table('agency_car_makers')->insert([
                'CarMaker_id'       => CarMaker::all()->random()->id,
                'agency_id'         => Agency::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
