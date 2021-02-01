<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class car_imgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = Image::where('base', '/img/Cars/')->get();
        $faker = Faker::create();
        $cars = Car::all();
        foreach ($cars as  $car) {
            DB::table('car_imgs')->insert([
                'car_id'        => $car->id,
                'img_id'        => $images->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            DB::table('car_imgs')->insert([
                'car_id'        => $car->id,
                'img_id'        => $images->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
