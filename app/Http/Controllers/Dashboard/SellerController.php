<?php

namespace App\Http\Controllers\Dashboard;




use App\Models\Seller;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\DataTables\PartDatatable;
use App\DataTables\SellerDatatable;
use App\Http\Controllers\Controller;
use App\Models\BrandSeller;
use App\Models\CarMaker;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SellerDatatable $seller)
    {
        $page_title = __("Sellers");
        $page_description =__( "View details");
        return  $seller->render("dashboard.Seller.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PartDatatable $part,Seller $seller)
    {
        $page_title         = __("Seller's Parts");
        $page_description   = __('View details');
        $seller             = Seller::findOrFail($part->request()->seller_id);
        $part->request()->all();
        return  $part->render("dashboard.Seller.show", compact('page_title', 'page_description','seller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        $page_title         = __("Edit Seller");
        $page_description   = __("Edit");
        $governorates       = Governorate::all();
        $brands             = CarMaker::all();
        $car_makers_selected= BrandSeller::where('seller_id',$seller->id)->get();
        $SelectedBrands = [];
        foreach($car_makers_selected as $carMaker)$SelectedCarMakers[] = $carMaker->brand_id;
        return view('dashboard.Seller.edit', compact('page_title', 'page_description','seller',
        'governorates','brands','SelectedCarMakers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request,$id)
    {
        $seller = Seller::findOrFail($id);
        $rules  = Seller::rules($request);
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
        return redirect()->route("dashboard.seller.index");
    }

//    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.seller.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$seller = Seller::find($id);
				$seller->delete();
			}
		} else {
			$seller = Seller::find(request('item'));
			$seller->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.seller.index");
    }
}
