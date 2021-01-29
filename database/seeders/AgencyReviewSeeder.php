<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AgencyReviewSeeder extends Seeder
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
            DB::table('agency_reviews')->insert([
                'rate'              => $faker->randomElement(['1', '2', '3', '4', '5']),
                'price'             => $faker->randomElement(['1', '2', '3']),
                'review'            => $faker->text,
                'agency_id'         => Agency::all()->random()->id,
                'user_id'           => User::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
