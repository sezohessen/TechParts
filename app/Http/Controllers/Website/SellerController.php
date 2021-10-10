<?php

namespace App\Http\Controllers\Website;

use App\Models\Part;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request, $id )
    {
        $this->validate($request,[
            'title'    =>'required|min:3|max:100',
            'review'   =>'required|min:3|max:255',
            'rating'   =>'required|in:1,2,3,4,5',
        ]);



        $review = Seller::where('id',$id)//If user reviews this part
        ->where('user_id',Auth::id())
        ->get()
        ->first();
        if($review){
            session()->flash('Exist', __('You have already review'));
            return redirect()->back();
        }
        $part = Part::where('id',$id)
        ->where('user_id',Auth::id())
        ->first();
        if($part){//If user is the owner of this part
            session()->flash('Exist', __('You can not review your part'));
            return redirect()->back();
        }

        // Store review
        $post = Review::create([
            'title'      => $request->title,
            'review'     => $request->review,
            'rating'     => $request->rating,
            'user_id'    => Auth::id(),
            'part_id'   => $id
        ]);
        session()->flash('review', __('You reviewed this part successfully!'));
        return redirect()->back();
    }
}
