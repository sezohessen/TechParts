<?php

namespace App\Http\Controllers\Website;

use App\Models\Part;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SellerRating;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function show($id)
    {
        $page_title = __('Seller');

        $seller = Seller::where('user_id',$id)->first();

        $review = SellerRating::where('seller_id',$seller->id)//If user reviews this part
        ->where('user_id',Auth::id())
        ->get()
        ->first();
        // If the giving data is seller
        if ($seller) {
            $parts  = Part::where('active',1)
            ->where('user_id',$seller->user_id)
            ->paginate(10,['*'],'parts');
            // Users Reviewing Seller
            $UsersReviews = SellerRating::where('seller_id',$seller->id)->orderBy('id','DESC')->paginate(5,['*'],'reviews');
            return view('website.seller',compact('seller','parts','page_title','UsersReviews','review'));
        // User id or admin id redirect
        } else {
            return redirect()->back();
        }

    }
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'review'   =>'required|min:3|max:255',
            'rating'   =>'required|in:1,2,3,4,5',
        ]);

        $review = SellerRating::where('seller_id',$id)//If user reviews this part
        ->where('user_id',Auth::id())
        ->get()
        ->first();
        if($review){
            session()->flash('Exist', __('You have already review'));
            return redirect()->back();
        }

        $seller = Seller::where('id',$id)
        ->where('user_id',Auth::id())
        ->first();
        if($seller){//If user is the owner of this part
            session()->flash('Exist', __('You can not rate yourself'));
            return redirect()->back();
        }
        $seller = Seller::where('user_id',$id)->first();

        // Store review
        $post = SellerRating::create([
            'review'     => $request->review,
            'rating'     => $request->rating,
            'user_id'    => Auth::id(),
            'seller_id'  => $id
        ]);
        session()->flash('review', __('Thank you for reviewing'));
        return redirect()->back();
    }
}
