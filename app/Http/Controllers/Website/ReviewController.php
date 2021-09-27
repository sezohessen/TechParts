<?php

namespace App\Http\Controllers\website;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Show reviews


    public function store(Request $request, $id )
    {
        $this->validate($request,[
            'title'    =>'required|min:3|max:100',
            'review'   =>'required|min:3|max:255',
            'rating'   =>'required|in:1,2,3,4,5',
        ]);



        $review = Review::where('part_id',$id)
        ->where('user_id',Auth::id())
        ->get()
        ->first();

        if($review){
            session()->flash('exist', 'You have already review',);
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
