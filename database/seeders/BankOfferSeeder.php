<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class BankOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $value){
            DB::table('bank_offers')->insert([
                'name'                      => $faker->name,
                'name_ar'                   => $faker->name,
                'description'               => $faker->text,
                'description_ar'            => $faker->text,
                'valid_till'                => $faker->date,
                'down_payment_percentage'   => $faker->numberBetween(1,99),
                'interest_rate'             => $faker->numberBetween(1,99),
                'number_of_years'           => $faker->numberBetween(1,20),
                'installment_months'        => $faker->numberBetween(10,99),
                'logo_id'                   => Image::all()->random()->id,
                'bank_id'                   => Bank::all()->random()->id,
                'created_at'                => now(),
                'updated_at'                => now(),
            ]);
        }
    }
}
