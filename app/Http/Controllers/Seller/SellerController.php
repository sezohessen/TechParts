<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $page_title         = __('Seller Dashboard');
        $page_description   = __('Home');
        $parts              = Part::where('user_id',Auth()->user()->id)->get();
        $seller             = Seller::where('user_id',Auth()->user()->id)->first();
        return  view("SellerDashboard.index", compact('page_title', 'page_description','parts','seller'));
    }
}
