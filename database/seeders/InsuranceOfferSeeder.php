<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Insurance;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceOfferSeeder extends Seeder
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
            DB::table('insurance_offers')->insert([
                'title'               => $faker->name,
                'title_ar'            => $faker->name,
                'img_id'              => Image::all()->random()->id,
                'description'         => $faker->sentence,
                'description_ar'      => $faker->sentence,
                'insurance_id'        => Insurance::all()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}