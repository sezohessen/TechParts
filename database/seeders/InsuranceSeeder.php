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
            $faker = Faker::create();
            foreach (range(1,5) as $value){
                DB::table('insurances')->insert([
                    'name'        => $faker->name,
                    'name_ar'        =>$faker->name,
                    'img_id'        => Image::all()->random()->id,
                    'user_id'        => User::all()->random()->id,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]);
            }
    }
}
