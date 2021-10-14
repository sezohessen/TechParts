<?php

namespace App\Http\Controllers\Website;
use App\Models\CarCapacity;
use App\Models\CarClassification;
use App\Models\CarMaker;
use App\Models\Governorate;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    public function index(Request $Request)
    {
        $brands         = CarMaker::all();
        $governorates   = Governorate::all();
        $capacities     = CarCapacity::all();
        $Classes        = CarClassification::limit(3)->get();
        $sellers = Seller::where('governorate_id' , '!=' , null);
        if(isset($Request->governorate_id))$sellers->where('governorate_id',$Request->governorate_id);
        if(isset($Request->city_id))$sellers->where('city_id',$Request->city_id);
        if(isset($Request->brand_id)){
            $sellers->whereHas('brands',function($q) use($Request){
                $q->where('brand_sellers.brand_id',$Request->brand_id);
            });
        }
        $sellers = $sellers->paginate(10);
        $sellers->appends(
            [
                'brand_id'          => $Request->brand_id,
                'governorate_id'    => $Request->governorate_id,
                'city_id'           => $Request->city_id,
            ]
        );
        return view('website.sellers',compact('sellers','brands','governorates','capacities','Classes'));
    }
}
