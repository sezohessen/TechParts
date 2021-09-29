<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Bank;
use App\Models\BankOffer;
use App\Models\Car;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\Part;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page_title         = __('Dashboard');
        $page_description   = __('Information management');
        $sellers            = User::whereHas(
            'role', function($q){
                $q->where('name', User::SellerRole);
            }
        )->get();
        $users              = User::all();
        $parts              = Part::all();
        return view('dashboard.index', compact('page_title', 'page_description','users','sellers'
        ,'parts'));
    }
}
