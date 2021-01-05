<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
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
            DB::table('contact_us')->insert([
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
