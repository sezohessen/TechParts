<?php

namespace Database\Seeders;

use App\Models\Image;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $image = Image::where( 'base', '/img/settings/')->first();
        DB::table('settings')->insert([
            'appName'       => '3arabiat App',
            'appName_ar'    => 'تطبيق عربيات',
            'logo_id'        => $image->id
        ]);
    }
}
