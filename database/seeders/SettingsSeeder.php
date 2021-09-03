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
            'appName'       => 'Tech Parts',
            'appName_ar'    => 'قطع غيار',
            'email'         => $faker->email,
            'phone'         => $faker->phoneNumber,
            'whatsapp'      => $faker->phoneNumber,
            'facebook'      => $faker->url,
            'instgram'      => $faker->url,
            'location'      => $faker->url,
            'andriod'       => $faker->url,
            'ios'           => $faker->url,
            'logo_id'       => $image->id
        ]);
    }
}
