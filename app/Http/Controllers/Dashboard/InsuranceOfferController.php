<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use Illuminate\Http\Request;

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
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة عرض تأمين";
            $page_description = " اضافة عرض تأمين جديد";
        } else {
            $page_title = "Add insurance offer";
            $page_description = "Add new insurance offer;
        } */
        $page_title = "Add insurance offer";
        $page_description = "Add new insurance offer";
        $Insurances = Insurance::all();
        return view('dashboard.Insurance-offer.add', compact('page_title', 'page_description','Insurances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Insurance_offer::rules($request);
        $request->validate($rules);
        $credentials = Insurance_offer::credentials($request);
        $Insurance_offer = Insurance_offer::create($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة عرض شركة التأمين"));
        } else {
            session()->flash('success',__("Offer insurance company has been added!"));
        } */
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
