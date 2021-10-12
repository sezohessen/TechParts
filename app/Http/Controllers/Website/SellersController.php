<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    public function index()
    {
        $sellers = Seller::where('governorate_id' , '!=' , null)->get();
        return view('website.sellers',compact('sellers'));
    }
}
