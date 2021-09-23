<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show($id)
    {
        $seller = Seller::findOrFail($id);
        $parts  = Part::where('active',1)
        ->where('user_id',$seller->user_id)
        ->paginate(10);
        // dd($seller->governorate);
        return view('website.seller',compact('seller','parts'));
    }
}
