<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Bank;
use App\Models\BankOffer;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title         = 'Dashboard';
        $page_description   = 'Some description for the page';
        $users              = User::all();
        $banks              = Bank::all();
        $insurances         = Insurance::all();
        $agencies           = Agency::where('center_type',2)->get();
        $maintenance        = Agency::where('center_type',1)->get();
        $spares             = Agency::where('center_type',0)->get();
        $banks_offers       = BankOffer::all();
        $insurances_offers  = Insurance_offer::all();
        return view('dashboard.index', compact('page_title', 'page_description','users','banks',
        'insurances','agencies','maintenance','spares','banks_offers','insurances_offers'));
    }
}
