<?php

namespace App\Http\Controllers\website;

use App\Models\Car;
use App\Models\Part;
use App\Models\User;
use App\Models\Seller;
use App\Models\CarModel;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parts  = Part::where('active',1)
        ->orderBy('views','DESC')
        ->get();
        return view('website.index',compact('parts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $part         = Part::where('id', $id)
        ->where('active',1)
        ->first();

        // Show reviews
        $reviews = Review::where('part_id',$id)->get();
        if($part){
        $partReview = Review::where('part_id',$id)
        ->get()
        ->first();
        $hasReview = Review::NotLogin;
        if(Auth::check())$hasReview    = Review::where('user_id', Auth()->user()->id)->where('part_id',$id)->first() ? Review::HasReview:Review::HasNotReview;

        $carModelID    = $part->car->model->id;
        $RelatedModelParts = Part::whereHas('car', function($q) use($carModelID) {
            $q->where('cars.carModel_id',$carModelID);
        })
        ->where('id','!=',$id)
        ->limit(12)
        ->get();
        return view('website.part',compact('part','hasReview','RelatedModelParts','reviews','partReview'));
        }
        else return redirect()->route('Website.Index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
