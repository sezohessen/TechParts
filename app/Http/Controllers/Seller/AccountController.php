<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Seller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function edit()
    {
        $seller             = Seller::where('user_id',Auth()->user()->id)->first();
        $page_title         = __("Edit my account");
        $page_description   = __("Edit");
        $governorates       = Governorate::all();
        return view('SellerDashboard.MyAccount.edit', compact('page_title', 'page_description','seller',
        'governorates'));
    }
    public function update(Request $request,$id)
    {
        $seller     = Seller::where('id',$id)->first();
        if($seller->user_id != Auth()->user()->id)return redirect()->route("seller.index");
        $rules      =  Seller::rules($request);
        $request->validate($rules);
        $seller->update(Seller::credentials($request));
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
