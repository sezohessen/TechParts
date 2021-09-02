<?php

namespace Database\Seeders;

use App\Models\CarColor;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $string = file_get_contents("G:/xampp/htdocs/TechParts/colors.json");
        $json_a = json_decode(json_encode($string),true);
        $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($json_a, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);
        foreach ($jsonIterator as $values) {
            foreach ( (array) $values as $item) {
                if (! CarColor::where('code', $item)->first()) {
                    DB::table('car_colors')->insert([
                        'code'          => $item,
                        'created_at'    => now(),
                        'updated_at'    => now()
                    ]);
                }
            }
        }
    }
}
