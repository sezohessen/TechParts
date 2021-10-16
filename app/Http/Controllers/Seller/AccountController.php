<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\BrandSeller;
use App\Models\CarMaker;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Seller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
class AccountController extends Controller
{
    public function edit(Request $request)
    {
        $seller             = Seller::where('user_id',Auth()->user()->id)->first();
        $page_title         = __("Edit my account");
        $page_description   = __("Edit");
        $governorates       = Governorate::all();
        $brands             = CarMaker::all();
        $car_makers_selected= BrandSeller::where('seller_id',$seller->id)->get();
        $currentUserInfo    = Location::get($request->ip());
        $SelectedCarMakers = [];
        foreach($car_makers_selected as $carMaker)$SelectedCarMakers[] = $carMaker->brand_id;
        return view('SellerDashboard.MyAccount.edit', compact('page_title', 'page_description','seller',
        'governorates','brands','SelectedCarMakers','currentUserInfo'));
    }
    public function update(Request $request,$id)
    {
        $seller     = Seller::findOrFail($id);
        $rules      =  Seller::rules($request);
        $request->validate($rules);
        $seller->update(Seller::credentials($request,$seller));
        /* (Testing)
        $a = ['1','2','3'];//Selected
        $b = ['4','5','6','7'];//New Selected
        $difference = array_diff($a, $b);
        */

        //Array Differnce compute difference between to arrays
        //if Get Array diff between Selected and New select ,then It will return the array that I need to delete
        //if Get Array diff between New select and Selected ,then It will return the array that I need to create
        $SellerBrands     = BrandSeller::where('seller_id',$id)->get();
        $SelectedCarMaker = [];
        foreach($SellerBrands as $SellerBrand){
            $SelectedCarMaker[] = $SellerBrand->brand_id;
        }
        $NeedToBeDeleted = array_diff($SelectedCarMaker,$request->specialty_id);
        $NeedToBeCreated = array_diff($request->specialty_id,$SelectedCarMaker);
        //Get car_id Array to Agency Car , (Create New)
        foreach ($NeedToBeCreated as $CarMaker_id){
            $credentials    = BrandSeller::credentials($CarMaker_id,$id);
            $Brand          = BrandSeller::create($credentials);
        }
        //Delete Removed Selected
        foreach ($NeedToBeDeleted as $CarMaker_id){
            $Brand      = BrandSeller::where([
                ['brand_id',$CarMaker_id],
                ['seller_id',$id]
            ])->delete();
        }
        session()->flash('updated',__("Changes has been Updated successfully"));
        return redirect()->route("seller.index");
    }
    public function show($id)
    {
        $cities     = City::where('governorate_id', $id)->get();
        if($cities->count() > 0 ){
            return response()->json([
                'cities' => $cities
            ]);
        }
        return response()->json([
            'cities' => null
        ]);

    }
}
