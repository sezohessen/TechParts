<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $value){
            DB::table('agencies')->insert([
                'name'              => $faker->company,
                'name_ar'           => $faker->company,
                'description'       => $faker->text,
                'description_ar'    => $faker->text,
                'show_in_home'      => $faker->boolean,
                'car_show_rooms'    => $faker->boolean,
                "agency_type"       => rand(0,2),
                'center_type'       => $faker->numberBetween(0,2),
                'lat'               => $faker->latitude,
                'long'              => $faker->longitude,
                'car_status'        => $faker->boolean,
                'payment_method'    => $faker->numberBetween(0,2),
                'img_id'            => Image::all()->random()->id,
                'country_id'        => Country::all()->random()->id,
                'governorate_id'    => Governorate::all()->random()->id,
                'city_id'           => City::all()->random()->id,
                'user_id'           => User::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
