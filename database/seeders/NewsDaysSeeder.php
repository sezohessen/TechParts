<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NewsDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('news_days')->insert([
                'day'                   => Carbon::now()->addDays($i)->format('Y-m-d'),
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
