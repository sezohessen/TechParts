<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = Image::where('base','/img/insurance/')->get();
        $faker  = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('insurances')->insert([
                'name'          => $faker->name,
                'name_ar'       => $faker->name,
                'img_id'        => $images->random()->id,
                'user_id'       => User::all()->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
