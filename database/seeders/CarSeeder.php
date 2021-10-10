<?php

namespace Database\Seeders;


use App\Models\CarYear;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Models\CarClassification;
use App\Models\Image;
use App\Models\User;
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
        $faker      = Faker::create();
        $images     = Image::where('base', CarMaker::base)->get();
        $users      = User::all();
        for ($i=0; $i < 3 ; $i++) {
            //First make classification of car company
            $Maker  = DB::table('car_classifications')->insertGetId([
                'name'          => $faker->name,
                'name_ar'       => $faker->name,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }

        $AllClass   = CarClassification::all();
        for ($i=0; $i < 20 ; $i++) {
            //First insert Car Maker
            $Maker  = DB::table('car_makers')->insertGetId([
                'name'          => $faker->name,
                'class_id'      => $AllClass->random()->id,
                'logo_id'       => $images->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            //Second insert Car Capacity
            $Cap    = DB::table('car_capacities')->insertGetId([
                'capacity'      => $faker->numberBetween(1000, 5000).'cc',
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
            DB::table('cars')->insert([
                'user_id'               => $users->random()->id,
                'CarModel_id'           => $Model,
                'CarMaker_id'           => $Maker,
                'CarYear_id'            => $Year,
                'CarCapacity_id'        => $Cap,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
