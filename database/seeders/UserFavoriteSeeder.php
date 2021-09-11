<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserFavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 30 ; $i++)
         {
            DB::table('users_favorite')->insert([
            'user_id' => User::all()->random()->id,
            'part_id' => Part::all()->random()->id,
            ]);
        }
    }
}
