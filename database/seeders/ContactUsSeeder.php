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
        for ($i = 0; $i < 40; $i++) {
            DB::table('contact_us')->insert([
                'message'           =>  $faker->sentence,
                'email'             =>  $faker->email,
                'phone'             =>  $faker->phoneNumber,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
