<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $insurance  = Insurance::where('user_id',Auth::id())->first();
        if($insurance->count()){
            $page_title = "Add insurance offer";
            $page_description = "Add new insurance offer";
            return view('InsuranceDashboard.Insurance-offer.add', compact('page_title', 'page_description'));
        }else{
            $page_title = "Add insurance company";
            $page_description = "Add new insurance company";
            return view('InsuranceDashboard.Insurance.add', compact('page_title', 'page_description'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insurance  = Insurance::where('user_id',Auth::id())->first();
        $id         = $insurance->id;
        $rules      = Insurance_offer::rules($request,$id);
        $request->validate($rules);
        $credentials = Insurance_offer::credentials($request,$id);
        $Insurance_offer = Insurance_offer::create($credentials);
        session()->flash('success',__("Offer insurance company has been added!"));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
