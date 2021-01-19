<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
        $array = [
            'name'              =>  "https://source.unsplash.com/random",
            'created_at'        =>  now(),
        ];
        foreach ($array as $value){
            DB::table('images')->insert([
                'name'              =>  "https://source.unsplash.com/random",
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }
    }
}
