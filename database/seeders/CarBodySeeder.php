<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CarBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = Image::where('base', '/img/CarBodies/')->get();
        $faker  = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            DB::table('car_bodies')->insert([
                'name'          => $faker->name,
                'name_ar'          => $faker->name,
                'logo_id'       => $images->random()->id,
                "active"        => rand(0, 1),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
