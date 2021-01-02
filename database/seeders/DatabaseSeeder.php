<?php

namespace Database\Seeders;

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
        $this->call(
            [FaqSeeder::class],
        );
        // \App\Models\User::factory(10)->create();
        $this->call(LaratrustSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
    }
}
