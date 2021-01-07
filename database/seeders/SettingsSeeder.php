<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        DB::table('settings')->insert([
            'appName'       => '3arabiat',
            'appName_ar'    => 'عربيات',
        ]);
    }
}
