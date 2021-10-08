<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show($id)
    {
        $page_title = __('Seller');

        $seller = Seller::where('user_id',$id)->first();
        // If the giving data is seller
        if ($seller) {
            $parts  = Part::where('active',1)
            ->where('user_id',$seller->user_id)
            ->paginate(8);
            // dd($seller->governorate);
            return view('website.seller',compact('seller','parts','page_title'));
        // User id or admin id redirect
        } else {
            return redirect()->back();
        }

    }
}
