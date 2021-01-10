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
        foreach (range(1,10) as $value){
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
