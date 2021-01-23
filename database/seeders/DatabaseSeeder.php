<?php

namespace Database\Seeders;


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
        $this->call(imagesSeeder::class);
        $this->call( [FaqSeeder::class] );
        $this->call(CountrySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(PPolicySeeder::class);
        $this->call(AskExpertSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(LaratrustSeeder::class);
        //\App\Models\User::factory(10)->create();
        $this->call(BadgeSeeder::class);
        $this->call(FeatureSeeder::class);
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
        $this->call(AgencyCarMakerSeeder::class);
        $this->call(AgencyCarSeeder::class);
        $this->call(AgencyContactSeeder::class);
        $this->call(AgencyReviewSeeder::class);
        $this->call(UserFavAgencySeeder::class);
        $this->call(ListCarUsersSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        $this->call(AgencySpecialtiesSeeder::class);
        $this->call(FinanceRequestSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(BankSeeder::class);//Also contain Bank contact seedr ;)
        $this->call(Car_DepositSeeder::class);
        $this->call(subscribe_packageSeeder::class);
        $this->call(PromoteCarSeeder::class);
    }
}
