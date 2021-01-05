<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class car_userFavSeeder extends Seeder
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
            DB::table('user_fav_cars')->insert([
                'car_id'        => Car::all()->random()->id,
                'user_id'       => User::all()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
