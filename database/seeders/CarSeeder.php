<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CarSeeder extends Seeder
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
            DB::table('cars')->insert([
                'makerName'             => $faker->name,
                'modelName'             => $faker->company,
                'price'                 => $faker->numberBetween(1,10000),
                'PrePrice'              => $faker->numberBetween(1,10000),
                'ManufacturingYear'     => $faker->year,
                'status'                => $faker->colorName,
                'currency'              => $faker->currencyCode,
                'kiloUsed'              => $faker->numberBetween(1,10000),
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
