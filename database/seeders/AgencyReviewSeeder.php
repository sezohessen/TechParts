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
        $Agencies = Agency::where('active', 1)->get();
        for ($i = 0; $i < 40; $i++) {
            DB::table('agency_reviews')->insert([
                'rate'              => rand(1, 5),
                'price'             => rand(1, 3),
                'review'            => $faker->text,
                'active'            => rand(0, 1),
                'agency_id'         => $Agencies->random()->id,
                'user_id'           => User::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
