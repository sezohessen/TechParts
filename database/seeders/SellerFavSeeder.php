<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SellerFavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users        = User::all();
        $sellers      = Seller::all();
        $faker        = Faker::create();
        for ($i=0; $i < 30 ; $i++)
        {
           DB::table('sellers_rating')->insert([
           'review'         => $faker->text,
           'rating'         => $faker->numberBetween($min = 1, $max = 5),
           'user_id'        => $users->random()->id,
           'seller_id'      => $sellers->random()->id,
           'created_at'     => now(),
           'updated_at'     => now(),
           ]);
       }
    }
}
