<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AgencyCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $value) {
            DB::table('agency_cars')->insert([
                'car_id'            => Car::where('status', 1)->get()->random()->id,
                'agency_id'         => Agency::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
