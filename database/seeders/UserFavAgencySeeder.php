<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserFavAgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $value){
            DB::table('user_fav_agencies')->insert([
                'agency_id'         => Agency::all()->random()->id,
                'user_id'           => User::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
