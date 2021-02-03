<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\CarBody;
use App\Models\CarYear;
use App\Models\Country;
use App\Models\CarColor;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarCapacity;
use App\Models\Governorate;
use Faker\Factory as Faker;
use App\Models\CarManufacture;
use Illuminate\Support\Carbon;
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
        for ($i=0; $i < 120 ; $i++) {
            DB::table('cars')->insert([

                'ServiceHistory'        => $faker->sentence,
                'Description'           => $faker->sentence,
                'Description_ar'        => $faker->sentence,
                'lat'                   => $faker->longitude,
                'lng'                   => $faker->latitude,
                'phone'                 => $faker->phoneNumber,
                'InstallmentAmount'      => $faker->month,
                'InstallmentPeriod'      => $faker->numberBetween(1,10000),
                'DepositPrice'          => $faker->numberBetween(1,10000),
                'Country_id'            => Country::where('active', 1)->get()->random()->id,
                'City_id'               => City::where('active', 1)->get()->random()->id,
                'Governorate_id'        => Governorate::where('active', 1)->get()->random()->id,
                'CarManufacture_id'     => CarManufacture::all()->random()->id,
                'CarModel_id'           => CarModel::where('active', 1)->get()->random()->id,
                'CarMaker_id'           => CarMaker::where('active', 1)->get()->random()->id,
                'CarBody_id'            => CarBody::where('active', 1)->get()->random()->id,
                'CarYear_id'            => CarYear::all()->random()->id,
                'CarCapacity_id'        => CarCapacity::all()->random()->id,
                'CarColor_id'           => CarColor::all()->random()->id,
                'user_id'               => User::all()->random()->id,
                'views'                 => $faker->numberBetween(1,100),
                'AccidentBefore'        => rand(0,1),
                'transmission'          => rand(0,1),
                'payment'               => rand(0,2),
                'SellerType'            => rand(0,1),
                'price_after_discount'  => $faker->numberBetween(1,100),
                'price'                 => $faker->numberBetween(1,10000),
                'whats'                 => $faker->phoneNumber,
                'isNew'                 => rand(0,1),
                'status'                => rand(0,1),
                'kiloUsed'              => $faker->numberBetween(1,100),
                "FuelType"              => rand(0,1),
                "adsExpire"             => Carbon::now()->addDays($i)->format('Y-m-d'),
                "promotedExpire"        => Carbon::now()->addDays($i)->format('Y-m-d'),
                "promotedStatus"        => 0,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
