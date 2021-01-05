<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
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
            $page_title = "اضافة ميزة";
            $page_description = "اضافة ميزة جديدة";
        } else {
            $page_title = "Add Feature";
            $page_description = "Add new Feature";
        } */
        $page_title = "Add Feature";
        $page_description = "Add new Feature";
        return view('dashboard.Feature.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Feature::rules($request);
        $request->validate($rules);
        $credentials = Feature::credentials($request);
        $Feature = Feature::create($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة الخاصية"));
        } else {
            session()->flash('success',__("Feature has been added!"));
        } */
       session()->flash('success',__("Feature has been added!"));
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
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "تعديل الخاصية";
            $page_description = "تعديل";
        } else {
            $page_title = "Edit Feature";
            $page_description = "Edit";
        } */
        $page_title = "Edit Feature";
        $page_description = "Edit";
        $feature = Feature::find($id);
        return view('dashboard.Feature.edit', compact('page_title', 'page_description','feature'));
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
        $rules = Feature::rules($request);
        $request->validate($rules);
        $credentials = Feature::credentials($request);
        $Feature = Feature::where('id',$id)->update($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل الخاصية"));
        } else {
            session()->flash('success',__("Feature has been updated!"));
        } */
       session()->flash('success',__("Feature has been updated!"));
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* $Feature = Feature::find($id);
        if($Feature!=null){
            $Feature->delete($id);
             if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            }
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('feature.index');
        }else{
            return redirect()->back();
        } */
    }
}