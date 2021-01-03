<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = 'المدن';
            $page_description = 'عرض جميع المدن';
        } else {
            $page_title = 'Cities';
            $page_description = 'View all Cities';
        } */
        $page_title = 'Cities';
        $page_description = 'View all Cities';

        return view('dashboard.City.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة مدينة";
            $page_description = "اضافة مدينة جديدة";
        } else {
            $page_title = "Add City";
            $page_description = "Add new City";
        } */
        $page_title = "Add City";
        $page_description = "Add new City";
        $countries = Country::all();
        return view('dashboard.City.add', compact('page_title', 'page_description','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = City::rules($request);
        $request->validate($rules);
        $credentials = City::credentials($request);
        $City = City::create($credentials);

        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة المدينة"));
        } else {
            session()->flash('success',__("City has been added!"));
        } */
       session()->flash('success',__("City has been added!"));
       return redirect()->route("city.index");
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
