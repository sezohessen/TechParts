<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          = Faker::create();
        $sellers        = User::whereHas(
            'role', function($q){
                $q->where('name', User::SellerRole);
            }
        )->get();

        $governorates   = Governorate::all();
        foreach ($sellers as $seller){
            $governorate = $governorates->random();
            DB::table('sellers')->insert([
                'user_id'           => $seller->id,
                'desc'              => $faker->text,
                'desc_ar'           => $faker->text,
                'governorate_id'    => $governorate->id,
                'city_id'           => $governorate->cities->random()->id,
                'lat'               => $faker->latitude,
                'long'              => $faker->longitude,
                'street'            => $faker->city,
                'facebook'          => $faker->url,
                'instagram'         => $faker->url,
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
