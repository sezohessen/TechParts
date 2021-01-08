<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AgencyDatatable;
use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgencyDatatable $agency)
    {
        $page_title = __('Agency companies');
        $page_description = __('View Insurances');
        return  $agency->render("dashboard.Agency.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = __("Add Agency");
        $page_description = __("Add new Agency");
        $countries = Country::all();
        $users     = User::all();
        return view('dashboard.Agency.add', compact('page_title', 'page_description','countries','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Agency::rules($request);
        $request->validate($rules);
        $credentials = Agency::credentials($request);
        $Agency = Agency::create($credentials);
       session()->flash('created',__("Agency has been Created successfully!"));
       return redirect()->route('dashboard.agency.index');
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
