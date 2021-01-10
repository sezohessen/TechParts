<?php

namespace Database\Seeders;


use App\Models\Car;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListCarUsersSeeder extends Seeder
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
            DB::table('list_car_users')->insert([
                'car_id'               =>Car::all()->random()->id,
                'user_id'            => User::all()->random()->id,
            ]);
        }
    }
}
