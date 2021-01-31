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
                'name'              =>  "alahlybank.png",
                'base'              =>  "/img/bank/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "alexbank.png",
                'base'              =>  "/img/bank/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "bank.png",
                'base'              =>  "/img/bank/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "bankmasr.png",
                'base'              =>  "/img/bank/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "cib.png",
                'base'              =>  "/img/bank/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "qnb.png",
                'base'              =>  "/img/bank/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "bankOffer.png",
                'base'              =>  "/img/bank-offer/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "dairyland.png",
                'base'              =>  "/img/insurance/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "general.png",
                'base'              =>  "/img/insurance/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "plymouth.png",
                'base'              =>  "/img/insurance/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "travelers.png",
                'base'              =>  "/img/insurance/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "offer.png",
                'base'              =>  "/img/insurance/offer/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "elsaba.png",
                'base'              =>  "/img/agency/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "eltarek.png",
                'base'              =>  "/img/agency/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "otoshow.png",
                'base'              =>  "/img/agency/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "car1.png",
                'base'              =>  "/img/Cars/",
                'updated_at'        =>  now(),
                'created_at'        =>  now()
            ],
            [
                'name'              =>  "car2.png",
                'base'              =>  "/img/Cars/",
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
