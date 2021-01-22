<?php

namespace Database\Seeders;

use App\Models\subscribe_package;
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
        foreach (range(1,10) as $value){
            subscribe_package::create([
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
