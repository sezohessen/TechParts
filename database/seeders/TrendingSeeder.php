<?php

namespace Database\Seeders;

use App\Models\Car;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrendingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $value){
            DB::table('trendings')->insert([
                'day'           => Carbon::now()->format('Y-m-d'),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
