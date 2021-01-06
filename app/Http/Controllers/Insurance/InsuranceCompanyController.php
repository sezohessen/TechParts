<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceCompanyController extends Controller
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
        $insurance = Insurance::where('user_id',Auth::id());
        if($insurance->count()){
            $insurance = $insurance->first();
            $page_title = "Edit insurance company";
            $page_description = "Edit company";
            return view('InsuranceDashboard.Insurance.edit', compact('page_title', 'page_description','insurance'));
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
        $id = Auth::id();
        $rules = Insurance::rules($request,$id);
        $request->validate($rules);
        $credentials = Insurance::credentials($request,$id);
        $Insurance = Insurance::create($credentials);
        $insurance = Insurance::where('user_id',$id)->first();
        session()->flash('success',__("Insurance company has been added!"));
        $page_title = "Edit insurance company";
        $page_description = "Edit company";
        return view('InsuranceDashboard.Insurance.edit', compact('page_title', 'page_description','insurance'));
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
