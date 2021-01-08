<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarMaker;
use Illuminate\Http\Request;

class CarMakerController extends Controller
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
        $page_title = __("Add Car Make");
        $page_description = __("Car Make");

        return view('dashboard.CarMaker.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = CarMaker::rules($request);
        $request->validate($rules);
        $credentials = CarMaker::credentials($request);
        $CarMaker = CarMaker::create($credentials);
        session()->flash('created',__("Changed has been Created successfully!"));
        return redirect()->route("dashboard.maker.index");
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
    public function edit(CarMaker $maker)
    {
        $page_title = __("Edit Car Make");
        $page_description = __("Edit Make");

        return view('dashboard.CarMaker.edit', compact('page_title', 'page_description','maker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarMaker $maker)
    {
        $rules =$maker->rules($request);
        $request->validate($rules);
        $credentials = $maker->credentials($request,$maker->logo->id);
        $maker->update($credentials);
        session()->flash('updated',__("Changed has been Updated successfully!"));
        return redirect()->route("dashboard.maker.index");
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
