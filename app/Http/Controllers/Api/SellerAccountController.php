<?php

namespace App\Http\Controllers\Api;

use App\Models\Seller;
use App\Models\BrandSeller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Requests\SellerUpdateRequest;

class SellerAccountController extends Controller
{
    public function saveSellerInfo(SellerUpdateRequest $request)
    {
        $seller     = Seller::where('user_id',Auth()->user()->id)->first();
        $seller->update(Seller::credentials($request,$seller));
        // Add brand
        $SellerBrands     = BrandSeller::where('seller_id',$seller->id)->get();
        $SelectedCarMaker = [];
        foreach($SellerBrands as $SellerBrand){
            $SelectedCarMaker[] = $SellerBrand->brand_id;
        }
        // check if the brand ID already exits & check if user send more than one letter 
        $NeedToBeCreated = array_search(substr($request->brand,0,1),$SelectedCarMaker);
        if($NeedToBeCreated === false)
        {
            BrandSeller::where('seller_id',$seller->id)->insert([
                'brand_id'      => substr($request->brand,0,1),
                'seller_id'     => $seller->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        } else {
            return response()->json(['errors' => 'Brand already exist'],500);
        }

        return new SellerResource($seller);
    }

    public function deleteBrand(Request $request)
    {
        $seller     = Seller::where('user_id',Auth()->user()->id)->first();
        $SellerBrands     = BrandSeller::where('seller_id',$seller->id)->get();
        foreach($SellerBrands as $SellerBrand){
            $SelectedCarMaker[] = $SellerBrand->brand_id;
        }
        $NeedToBeDeleted = array_search($request->brand,$SelectedCarMaker);
        dd($NeedToBeDeleted);
    }
}
