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
        $images = Image::where('base','/img/CarBodies/')->get();
        $faker  = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('car_bodies')->insert([
                'name'          => $faker->name,
                'logo_id'       => $images->random()->id,
                "active"        => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
