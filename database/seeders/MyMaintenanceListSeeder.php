<?php

namespace Database\Seeders;

use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyMaintenanceListSeeder extends Seeder
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
            DB::table('my_maintenance_lists')->insert([
                'date_next'         => $faker->dateTime(),
                'CarMaker_id'       => CarMaker::all()->random()->id,
                'CarModel_id'       => CarModel::all()->random()->id,
                'user_id'           => User::all()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
