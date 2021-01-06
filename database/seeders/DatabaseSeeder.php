<?php

namespace Database\Seeders;

use App\Models\Terms;
use App\Models\User;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

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
        $this->call(CountrySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(PPolicySeeder::class);
        $this->call(AskExpertSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(LaratrustSeeder::class);
        //\App\Models\User::factory(10)->create();
        $this->call(BadgeSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(TrendingSeeder::class);
        $this->call(imagesSeeder::class);
        $this->call(car_imgSeeder::class);
        $this->call(car_badgeSeeder::class);
        $this->call(car_featureSeeder::class);
        $this->call(car_userFavSeeder::class);
        $this->call(finance_requestSeeder::class);
    }
}
