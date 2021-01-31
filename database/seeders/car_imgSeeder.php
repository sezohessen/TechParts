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
        for ($i = 0; $i < 40; $i++) {
            DB::table('car_imgs')->insert([
                'car_id'        => Car::where('status', 1)->get()->random()->id,
                'img_id'        => $images->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
