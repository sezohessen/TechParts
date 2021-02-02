<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsDay;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TrendingNewsSeeder extends Seeder
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
            DB::table('trending_news')->insert([
                'trend_id'              => NewsDay::all()->random()->id,
                'news_id'               => News::all()->random()->id,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
