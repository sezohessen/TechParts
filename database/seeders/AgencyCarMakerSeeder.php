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
        $agencies = Agency::where('active', 1)->get();
        $makers = CarMaker::all();
        foreach ($agencies as $key => $agency) {
            DB::table('agency_car_makers')->insert([
                'CarMaker_id'       => $makers->random()->id,
                'agency_id'         => $agency->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
            DB::table('agency_car_makers')->insert([
                'CarMaker_id'       => $makers->random()->id,
                'agency_id'         => $agency->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
