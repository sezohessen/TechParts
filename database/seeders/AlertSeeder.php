<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('alerts')->insert([
                'car_id'            => Car::where('status', 1)->get()->random()->id,
                'user_id'           => User::all()->random()->id,
                'status'            => rand(0, 1),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
