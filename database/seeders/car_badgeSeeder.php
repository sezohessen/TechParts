<?php

namespace Database\Seeders;

use App\Models\Badges;
use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class car_badgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = Car::all();
        foreach ($cars as  $car) {
            DB::table('car_badges')->insert([
                'car_id'        => $car->id,
                'badge_id'      => Badges::where('active', 1)->get()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            DB::table('car_badges')->insert([
                'car_id'        => $car->id,
                'badge_id'      => Badges::where('active', 1)->get()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
