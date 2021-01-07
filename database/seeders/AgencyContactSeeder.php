<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AgencyContactSeeder extends Seeder
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
            DB::table('agency_contacts')->insert([
                'facebook'          => $faker->url,
                'whatsapp'          => $faker->url,
                'instagram'         => $faker->url,
                'messenger'         => $faker->url,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
