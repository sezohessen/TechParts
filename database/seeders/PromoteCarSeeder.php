<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\subscribe_package;
use Illuminate\Support\Facades\DB;

class PromoteCarSeeder extends Seeder
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
            DB::table('promote_cars')->insert([
                'car_id'               => Car::where('status', 1)->get()->random()->id,
                'user_id'              => User::all()->random()->id,
                "subscribe_package_id" => subscribe_package::all()->random()->id,
                "price"                => $faker->numberBetween(1, 100),
                "weaccept_order_id"    => $faker->numberBetween(1, 100),
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }
    }
}
