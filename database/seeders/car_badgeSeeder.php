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
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            DB::table('car_badges')->insert([
                'car_id'        => Car::where('status', 1)->get()->random()->id,
                'badge_id'      => Badges::where('active', 1)->get()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
