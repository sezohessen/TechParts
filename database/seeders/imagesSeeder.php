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
            [
                'name'              =>  "elonmusk.jpg",
                'base'              =>  "http://arabiat.sydaliyat.com/api_fake/assets/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "joebiden.jpg",
                'base'              =>  "http://arabiat.sydaliyat.com/api_fake/assets/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "joebiden.jpg",
                'base'              =>  "/img/CarMakers/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
        ];
        foreach ($array as $value){
            DB::table('images')->insert([
                'name'              =>  $value['name'],
                'base'              =>  $value['base'],
                'updated_at'        =>  $value['updated_at'],
                'created_at'        =>  $value['created_at'],
            ]);
        }
    }
}
