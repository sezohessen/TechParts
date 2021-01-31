<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  = Faker::create();
        $images = Image::where('base','/img/agency/')->get();
        $users  = User::whereRoleIs('agency')->get();
        foreach ($users as $user ) {
            $agency = DB::table('agencies')->insertGetId([
                'name'              => $faker->company,
                'name_ar'           => $faker->company,
                'description'       => $faker->text,
                'description_ar'    => $faker->text,
                'show_in_home'      => $faker->boolean,
                'car_show_rooms'    => $faker->boolean,
                "agency_type"       => rand(1, 2),
                "is_authorised"     => rand(1, 2),
                "maintenance_type"  => rand(1, 2),
                'center_type'       => $faker->numberBetween(1, 2),
                'lat'               => $faker->latitude,
                'long'              => $faker->longitude,
                'car_status'        => $faker->boolean,
                'payment_method'    => $faker->numberBetween(0, 2),
                'img_id'            => $images->random()->id,
                'country_id'        => Country::all()->random()->id,
                'governorate_id'    => Governorate::all()->random()->id,
                'city_id'           => City::all()->random()->id,
                'user_id'           => $user->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
            DB::table('agency_contacts')->insert([
                'facebook'          => $faker->url,
                'whatsapp'          => $faker->url,
                'instagram'         => $faker->url,
                'messenger'         => $faker->url,
                'agent_id'          => $agency,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
