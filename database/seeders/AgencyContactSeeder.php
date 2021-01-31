<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AgencyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 40; $i++) {
            DB::table('agency_contacts')->insert([
                'facebook'          => $faker->url,
                'whatsapp'          => $faker->url,
                'instagram'         => $faker->url,
                'messenger'         => $faker->url,
                'agent_id'          => Agency::where('active', 1)->get()->random()->id,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }
    }
}
