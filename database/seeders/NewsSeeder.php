<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = Image::where('base', '/img/news/')->get();
        $imagesAuthor = Image::where('name', 'LIKE', '%' . 'avatar' . '%')->get();
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            DB::table('news')->insert([
                'title'                 => $faker->name,
                'title_ar'              => $faker->name,
                'authorName'            => $faker->name,
                'authorImg_id'          => $imagesAuthor->random()->id,
                'image_id'              => $images->random()->id,
                'description'           => $faker->text,
                'description_ar'        => $faker->text,
                'category_id'           => Category::all()->random()->id,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
