<?php

namespace Database\Seeders;

use App\Models\Terms;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call( [FaqSeeder::class] );
        /* $this->call(LaratrustSeeder::class); */
        $this->call(CountrySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(TermsSeeder::class);
        \App\Models\User::factory(10)->create();
    }
}
