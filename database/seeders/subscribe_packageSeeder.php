<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class subscribe_packageSeeder extends Seeder
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
            DB::table('subscribe_packages')->insert([
                'currency_name'     =>   $faker->currencyCode,
                'description'       =>   $faker->sentence,
                'description_ar'    =>   $faker->sentence,
                'price'             =>   $faker->numberBetween(1,100),
                "period"            =>   $faker->month,
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }

    }
}