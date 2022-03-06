<?php

namespace App\Http\Controllers\Api;

use App\Models\Part;
use App\Models\Review;
use App\Models\Seller;
use App\Models\SellerRating;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PartRateResource;
use App\Http\Requests\GetPartRatesRequest;
use App\Http\Resources\SellerRateResource;
use App\Http\Requests\StorePartRateRequest;
use App\Http\Requests\GetSellerRatesRequest;
use App\Http\Requests\StoreSellerRateRequest;

class RateController extends Controller
{
    use GeneralTrait;
    public function ratePart(StorePartRateRequest $request)
    {
        $PartID = $request->part_id;
        $AuthID = auth()->user()->id;
        $review = Review::where('part_id',$PartID)//If user reviews this part
        ->where('user_id',$AuthID)
        ->get()
        ->first();
        if($review){
            return $this->returnError('You have already reviewed this part');
        }
        $Authpart = Part::where('id',$PartID)
        ->where('user_id',$AuthID)
        ->first();
        $part = Part::where('id',$PartID)->first();

        if($Authpart){//If user is the owner of this part
            return $this->returnError('You can not review your part');
        } elseif ($part == null) {
            return $this->returnError('there is no part with the ID ' . $PartID);
        } else {
            $post = new Review();
            $post->title    =  $request->title;
            $post->review   =  $request->review;
            $post->rating   =  $request->rating;
            $post->user_id  =  $AuthID;
            $post->part_id  =  $PartID;
            $post->save();
            return $this->returnData('data', new PartRateResource($post),'review has been added');
        }
    }

    public function getAllPartRates(GetPartRatesRequest $request)
    {
        $PartID = $request->part_id;
        $reviews = Review::where('part_id',$PartID)->paginate(5);
        return (PartRateResource::collection($reviews))->additional(['additional_parameters' =>
        ['success' => true , 'msg' => 'Part ID ' . $PartID . ' reviews']
        ]);
    }

    public function rateSeller(StoreSellerRateRequest $request)
    {
        $sellerID = $request->seller_id;
        $review = SellerRating::where('seller_id',$sellerID)//If user reviews this part
        ->where('user_id',Auth::id())
        ->get()
        ->first();
        if($review){
            return $this->returnError('You have already review');
        }

        $seller = Seller::where('id',$sellerID)
        ->where('user_id',Auth::id())
        ->first();
        if($seller){//If user is the owner of this part
            return $this->returnError('You can not rate yourself');
        }
        $seller = Seller::where('user_id',$sellerID)->first();

        // Store review
        $post = SellerRating::create([
            'review'     => $request->review,
            'rating'     => $request->rating,
            'user_id'    => Auth::id(),
            'seller_id'  => $sellerID
        ]);
        return $this->returnData('data', new SellerRateResource($post),'review has been added');
    }

    public function getAllSellerReviews(GetSellerRatesRequest $request)
    {
        $sellerID = $request->seller_id;
        $reviews = SellerRating::where('seller_id',$sellerID)->paginate(5);
        return (SellerRateResource::collection($reviews))->additional(['additional_parameters' =>
        ['success' => true , 'msg' => 'Part ID ' . $sellerID . ' reviews']
        ]);
    }


}
