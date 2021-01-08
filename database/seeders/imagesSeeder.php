<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class imagesSeeder extends Seeder
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
            DB::table('images')->insert([
                'name'              =>  "https://source.unsplash.com/random",
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }
    }
}
