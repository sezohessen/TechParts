<?php

namespace Database\Seeders;

use App\Models\CarMaker;
use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use App\Models\Seller;

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
        $background     = Image::where('base', Seller::backgroundBase)->get();
        $avatar         = Image::where('base', Seller::avatarBase)->get();
        $brands         = CarMaker::all();
        foreach ($sellers as $seller){
            $governorate = $governorates->random();
            $seller      = DB::table('sellers')->insertGetId([
                'user_id'           => $seller->id,
                'desc'              => $faker->text,
                'desc_ar'           => $faker->text,
                'bg'                => $background->random()->id,
                'avatar'            => $avatar->random()->id,
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
            $count = rand(1,7);
            for($i = 0 ; $i< $count;$i++){
                DB::table('brand_sellers')->insert([
                    'brand_id'          => $brands->random()->id,
                    'seller_id'         => $seller,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }
        }
    }
}
