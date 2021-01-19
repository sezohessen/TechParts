<?php

namespace Database\Seeders;

use App\Models\Badges;
use App\Models\CarBody;
use App\Models\CarCapacity;
use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarManufacture;
use App\Models\CarModel;
use App\Models\CarYear;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
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
        foreach (range(1,5) as $value){
            DB::table('cars')->insert([

                'ServiceHistory'        => $faker->sentence,
                'Description'           => $faker->sentence,
                'Description_ar'        => $faker->sentence,
                'lat'                   => $faker->longitude,
                'lng'                   => $faker->latitude,
                'phone'                 => $faker->phoneNumber,
                'InstallmentMonth'      => $faker->month,
                'InstallmentPrice'      => $faker->numberBetween(1,10000),
                'DepositPrice'          => $faker->numberBetween(1,10000),
                'Country_id'            => Country::all()->random()->id,
                'City_id'               => City::all()->random()->id,
                'Governorate_id'        => Governorate::all()->random()->id,
                'CarManufacture_id'     => CarManufacture::all()->random()->id,
                'CarModel_id'           => CarModel::all()->random()->id,
                'CarMaker_id'           => CarMaker::all()->random()->id,
                'CarBody_id'            => CarBody::all()->random()->id,
                'CarYear_id'            => CarYear::all()->random()->id,
                'CarCapacity_id'        => CarCapacity::all()->random()->id,
                'CarColor_id'           => CarColor::all()->random()->id,
                'views'                 => $faker->numberBetween(1,100),
                'AccidentBefore'        => rand(0,1),
                'transmission'          => rand(0,1),
                'payment'               => rand(0,2),
                'SellerType'            => rand(0,2),
                'price_after_discount'  => $faker->numberBetween(1,100),
                'price'                 => $faker->numberBetween(1,10000),
                'isNew'                 => rand(0,1),
                'status'                => rand(0,1),
                'kiloUsed'              => $faker->numberBetween(1,100),
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
