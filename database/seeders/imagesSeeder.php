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
                'name'              =>  "parts (1).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (2).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (3).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (4).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (5).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (6).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (7).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (8).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (9).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (10).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (11).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "parts (12).jpg",
                'base'              =>  "/img/PartImgs/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "volksen",
                'base'              =>  "/img/CarMakers/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "mitsubishi.png",
                'base'              =>  "/img/CarMakers/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "honda.png",
                'base'              =>  "/img/CarMakers/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "ford.png",
                'base'              =>  "/img/CarMakers/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "bmw.png",
                'base'              =>  "/img/CarMakers/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "avata3.png",
                'base'              =>  "/img/users/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "avatar.png",
                'base'              =>  "/img/users/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "avatar2.png",
                'base'              =>  "/img/users/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "logo.png",
                'base'              =>  "/img/settings/",
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
