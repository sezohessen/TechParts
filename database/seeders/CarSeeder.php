<?php

namespace Database\Seeders;


use App\Models\CarYear;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Models\Image;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $images = Image::where('base', '/img/CarMakers/')->get();
        $carIMGS = Image::where('base', '/img/Cars/')->get();
        for ($i=0; $i < 10 ; $i++) {
            //First insert Car Maker
            $Maker  = DB::table('car_makers')->insertGetId([
                'name'          => $faker->name,
                'logo_id'       => $images->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            //Second insert Car Capacity
            $Cap    = DB::table('car_capacities')->insertGetId([
                'capacity'      => $faker->numberBetween(1000, 5000),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            //insert Car model then link it between car Maker
            $Model  = DB::table('car_models')->insertGetId([
                'name'          => $faker->name,
                'CarMaker_id'   => $Maker,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            //insert car year and link it between car year
            $Year   = DB::table('car_years')->insertGetId([
                'year'          => $faker->year,
                'CarModel_id'   => $Model,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            $car    = DB::table('cars')->insertGetId([
                'CarModel_id'           => $Model,
                'CarMaker_id'           => $Maker,
                'CarYear_id'            => $Year,
                'CarCapacity_id'        => $Cap,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
            DB::table('car_imgs')->insert([
                'car_id'        => $car,
                'img_id'        => $images->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            DB::table('car_imgs')->insert([
                'car_id'        => $car,
                'img_id'        => $carIMGS->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
