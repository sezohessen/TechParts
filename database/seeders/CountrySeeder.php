<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $array = [
            [
                'name'                  =>   'egypt',
                'name_ar'               =>   'مصر',
                'code'                  =>   'EG',
                'country_phone'         =>   '+20',
            ],
            [
                'name'                  =>   'Saudi Arabia',
                'name_ar'               =>   'السعودية',
                'code'                  =>   'KSA',
                'country_phone'         =>   '+966',
            ],
            [
                'name'                  =>   'United Arab Emirates',
                'name_ar'               =>   'الإمارات العربية المتحدة',
                'code'                  =>   'UAE',
                'country_phone'         =>   '‎+971',
            ],
        ];
        foreach ($array as $value){
            DB::table('countries')->insert([
                'name'                  =>   $value['name'],
                'name_ar'               =>   $value['name_ar'],
                'code'                  =>   $value['code'],
                'country_phone'         =>   $value['country_phone'],
                'created_at'            =>  now(),
                'updated_at'            =>  now(),
                'active'                =>  1,
            ]);
        }
    }
}
