<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = Image::where('base','/img/bank/')->get();
        $faker  = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $bank = DB::table('banks')->insertGetId([ //I need id table to insert it into bank contact table
                'name'                  => $faker->company,
                'status'                => $faker->randomElement(['Approved', 'Canceled', 'Pending']),
                'color'                 => $faker->hexColor,
                'order'                 => $faker->numberBetween(1, 100),
                'show_finance_services' => $faker->boolean,
                'logo_id'               => $images->random()->id,
                'user_id'               => User::all()->random()->id,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
            DB::table('bank_contacts')->insert([
                'bank_id'               => $bank,
                'phone'                 => $faker->phoneNumber,
                'whatsapp'              => $faker->phoneNumber,
                'email'                 => $faker->email,
                'created_at'            => now(),
                'updated_at'            => now()
            ]);
        }
    }
}
