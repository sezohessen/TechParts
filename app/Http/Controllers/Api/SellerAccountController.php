<?php

namespace App\Http\Controllers\Api;

use App\Models\Seller;
use App\Models\BrandSeller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Resources\AllSellersCollection;
use App\Http\Requests\SellerUpdateRequest;

class SellerAccountController extends Controller
{
    public function index()
    {
        return new AllSellersCollection(Seller::all());
    }

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
        // $NeedToBeCreated = array_search($request->brand,$SelectedCarMaker);
        $Brands     = $request->brand;
        $arrayBrands = explode(',',$Brands);
        $NeedToBeCreated = array_diff($arrayBrands,$SelectedCarMaker);
        if($NeedToBeCreated)
        {
            foreach ($NeedToBeCreated as $brand){
                BrandSeller::where('seller_id',$seller->id)->insert([
                    'brand_id'      => $brand,
                    'seller_id'     => $seller->id,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]);
            }

        } else {
            return response()->json(['error' => 'Brand/s already exist'],500);
        }

        return new SellerResource($seller);
    }

    public function deleteBrand(Request $request)
    {
        $seller     = Seller::where('user_id',Auth()->user()->id)->first();
        $SellerBrands     = BrandSeller::where('seller_id',$seller->id)->get();
        $SelectedCarMaker = [];
        foreach($SellerBrands as $SellerBrand){
            $SelectedCarMaker[] = $SellerBrand->brand_id;
        }
        $Brands     = $request->brand;
        $arrayBrands = explode(',',$Brands);
        $NeedToBeDeleted = array_diff($arrayBrands,$request->specialty_id);
        dd($NeedToBeDeleted);
        //Delete Removed Selected
        foreach ($NeedToBeDeleted as $CarMaker_id){
            $Brand      = BrandSeller::where([
                ['brand_id',$CarMaker_id],
                ['seller_id',$seller->id]
            ])->delete();
        }

    }
}
