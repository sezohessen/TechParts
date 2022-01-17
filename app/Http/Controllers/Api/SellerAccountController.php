<?php

namespace App\Http\Controllers\Api;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerAccountController extends Controller
{
    public function saveSellerInfo(Request $request)
    {
        $seller     = Seller::where('user_id',Auth()->user()->id)->first();
        $rules      =  Seller::rules($request);
        $request->validate($rules);
        $seller->update(Seller::credentials($request,$seller));

            return response()->json([
                "success"        => true,
                "message"        => "successfully updated",
                'seller name'    => $seller->user->getFullNameAttribute(),
                'Facebook'       => $seller->facebook,
            ]);

    }
}
