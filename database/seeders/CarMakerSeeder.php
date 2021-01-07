<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CarMakerSeeder extends Seeder
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
            DB::table('car_makers')->insert([
                'name'          => $faker->name,
                'logo_id'       => Image::all()->random()->id,
                'active'        => rand(0,1),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
