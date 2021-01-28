<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Bank;
use App\Models\BankOffer;
use App\Models\Car;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title         = __('Dashboard');
        $page_description   = __('Information management');
        $users              = User::all();
        $banks              = Bank::all();
        $insurances         = Insurance::all();
        $agencies           = Agency::where('center_type',Agency::center_type_Agency)->get();
        $maintenance        = Agency::where('center_type',Agency::center_type_Maintenance)->get();
        $spares             = Agency::where('center_type',Agency::center_type_Spare)->get();
        $banks_offers       = BankOffer::all();
        $insurances_offers  = Insurance_offer::all();
        $carShowrooms       = Car::has('agencies')->get();
        $carCustomers       = Car::doesnthave('agencies')->get();
        return view('dashboard.index', compact('page_title', 'page_description','users','banks',
        'insurances','agencies','maintenance','spares','banks_offers','insurances_offers','carShowrooms',
        'carCustomers'));
    }
}
