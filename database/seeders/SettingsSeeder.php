<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Settings;
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
        $image = Image::where('base', Settings::base)->first();
        DB::table('settings')->insert([
            'appName'       => 'To Part',
            'appName_ar'    => 'قطع غيار',
            'email'         => $faker->email,
            'phone'         => $faker->phoneNumber,
            'whatsapp'      => $faker->phoneNumber,
            'facebook'      => $faker->url,
            'instgram'      => $faker->url,
            'location'      => $faker->url,
            'andriod'       => $faker->url,
            'ios'           => $faker->url,
            'about_us'      => $faker->text,
            'about_us_ar'   => $faker->text,
            'logo_id'       => $image->id,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
