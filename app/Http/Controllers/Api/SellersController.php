<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Seller;
use App\Models\CarMaker;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerSearchRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\BrandsResource;
use App\Http\Resources\SellerResource;
use App\Http\Resources\GovernorateResource;
use App\Http\Resources\CarClassificationCollection;
use App\Http\Resources\CarClassificationResource;
use App\Models\CarClassification;

class SellersController extends Controller
{
    public function LocationData()
    {
         return (GovernorateResource::collection(Governorate::all()))->additional(['additional_parameters' =>
         [ 'car_classifications' => CarClassificationResource::collection(CarClassification::all()) , 'success' => true , 'msg' => 'location' ] ]);
    }

    public function searchForSellers(SellerSearchRequest $request)
    {
        $sellers = Seller::where('governorate_id' , '!=' , null);
        if($request->governorate_id)$sellers->where('governorate_id',$request->governorate_id);
        if($request->city_id)$sellers->where('city_id',$request->city_id);
        if($request->brand_id){
            $sellers->whereHas('brands',function($q) use($request){
                $q->where('brand_sellers.brand_id',$request->brand_id);
            });
        }
        return (SellerResource::collection($sellers->get()))->additional(['additional_parameters' =>
            ['success' => true , 'msg' => 'sellers']
        ]);
    }
}
