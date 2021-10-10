<?php

namespace Database\Seeders;

use App\Models\MyMaintenanceList;
use App\Models\NewsDay;
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
        $this->call(SettingsSeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(PPolicySeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(PartSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(UserFavSeeder::class);
        $this->call(SellerFavSeeder::class);
    }
}
