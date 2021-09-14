<?php

namespace App\Http\Controllers\website;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id )
    {
        $this->validate($request,[
            'title'  =>'required|min:3|max:1000',
            'review' =>'required|min:3|max:1000',
            'rate'   =>'required|in:1,2,3,4,5',
        ]);
        $review = Review::where('product_id',$id)
        ->where('user_id',Auth::id())
        ->get()
        ->first();

        if($review){
            session()->flash('exist', 'You have already review');
            return redirect()->back();
        }
        // Store review
        $post = Review::create([
            'title'      =>$request->comment,
            'review'     =>$request->comment,
            'rate'       =>$request->rate,
            'user_id'    => Auth::id(),
            'product_id' => $id
        ]);
        session()->flash('status', 'Comment Was Added!');
        return redirect()->back();
    }
}
