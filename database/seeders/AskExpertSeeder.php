<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AskExpertSeeder extends Seeder
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
            DB::table('ask_experts')->insert([
                'message'           =>  $faker->sentence,
                'email'             =>  $faker->email,
                'phone'             =>  $faker->phoneNumber,
                'country_phone'     =>  $faker->phoneNumber,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
