<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users      = User::all();
        $parts      = Part::all();
        for ($i=0; $i < 30 ; $i++)
        {
           DB::table('users_favorite')->insert([
           'user_id'        => $users->random()->id,
           'part_id'        => $parts->random()->id,
           'created_at'     => now(),
           'updated_at'     => now(),
           ]);
       }
    }
}
