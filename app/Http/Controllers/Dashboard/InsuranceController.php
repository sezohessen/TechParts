<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Insurance_offer;
use App\Models\User;
use Illuminate\Http\Request;

class InsuranceController extends Controller
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
            $page_title = "اضافة شركة تأمين";
            $page_description = " اضافة شركة تأمين جديدة";
        } else {
            $page_title = "Add insurance company";
            $page_description = "Add new insurance company";
        } */
        $page_title = "Add insurance company";
        $page_description = "Add new insurance company";
        $users = User::all();
        return view('dashboard.Insurance.add', compact('page_title', 'page_description','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Insurance::rules($request);
        $request->validate($rules);
        $credentials = Insurance::credentials($request);
        $Insurance = Insurance::create($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة شركة التأمين"));
        } else {
            session()->flash('success',__("Insurance company has been added!"));
        } */
       session()->flash('success',__("Insurance company has been added!"));
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
        $offers = Insurance_offer::where('insurance_id', $id)->get();
        if($offers->count() > 0 ){
            return response()->json([
                'insurance_offers' => $offers
            ]);
        }
        return response()->json([
            'insurance_offers' => null
        ]);
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
