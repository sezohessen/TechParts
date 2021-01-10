<?php

namespace Database\Seeders;

use App\Models\AgentCar;
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
        $this->call(CategorySeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(PPolicySeeder::class);
        $this->call(AskExpertSeeder::class);
        $this->call(FinanceRequestSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(LaratrustSeeder::class);
        //\App\Models\User::factory(10)->create();
        $this->call(BadgeSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(imagesSeeder::class);
        $this->call(CarBodySeeder::class);
        $this->call(CarMakerSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarYearSeeder::class);
        $this->call(CarColorSeeder::class);
        $this->call(CarCapacitySeeder::class);
        $this->call(CarManufactureSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(TrendingSeeder::class);
        $this->call(car_imgSeeder::class);
        $this->call(car_badgeSeeder::class);
        $this->call(car_featureSeeder::class);
        $this->call(car_userFavSeeder::class);
        $this->call(InsuranceSeeder::class);
        $this->call(InsuranceOfferSeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(AgencyCarSeeder::class);
        $this->call(AgencyContactSeeder::class);
        $this->call(AgencyReviewSeeder::class);
        $this->call(PromoteCarSeeder::class);
        $this->call(ListCarUsersSeeder::class);
        $this->call(MaintenanceSpecialtiesSeeder::class);
    }
}
