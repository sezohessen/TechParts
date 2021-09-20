<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show($id)
    {
        $seller = Seller::where('id',$id)->with('user','background','sellerAvatar','governorate','city')->get()->first();
        // dd($seller->governorate);
        return view('website.seller',compact('seller'));
    }
}
