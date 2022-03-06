<?php

namespace App\Http\Controllers\Api;

use Error;
use App\Models\Seller;
use App\Models\CarMaker;
use App\Models\BrandSeller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Http\Requests\SellerUpdateRequest;
use App\Http\Resources\AllSellersResource;

class SellerAccountController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        return AllSellersResource::collection(Seller::all());
    }

    public function saveSellerInfo(SellerUpdateRequest $request)
    {
        $seller     = Seller::where('user_id',Auth()->user()->id)->first();
        $seller->update(Seller::credentials($request,$seller));
        // Add brand
        if($request->brand)
        {
            $SellerBrands     = BrandSeller::where('seller_id',$seller->id)->get();
            $SelectedCarMaker = [];
            foreach($SellerBrands as $SellerBrand){
                $SelectedCarMaker[] = $SellerBrand->brand_id;
            }
            // check if the brand ID already exits & check if user send more than one letter
            // $NeedToBeCreated = array_search($request->brand,$SelectedCarMaker);
            $Brands     = $request->brand;
            $carMaker = CarMaker::where('id', $Brands)->first();
            if($carMaker)
            {
                // Create brand seller
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
                }
                $arrayBrands = explode(',',$Brands);
                $NeedToBeDeleted = array_diff($SelectedCarMaker,$arrayBrands);
                if($NeedToBeDeleted)
                {
                //Delete Removed Selected
                foreach ($NeedToBeDeleted as $CarMaker_id){
                    $Brand      = BrandSeller::where([
                        ['brand_id',$CarMaker_id],
                        ['seller_id',$seller->id]
                        ])->delete();
                    }
                }
            } else {
                return $this->returnError($Brands . ' is a wrong ID');
            }
        }

        return new SellerResource($seller);
    }

}
