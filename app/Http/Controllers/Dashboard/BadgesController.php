<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Badges;
use Illuminate\Http\Request;

class BadgesController extends Controller
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
            $page_title = "اضافة شارة";
            $page_description = "اضافة شارة جديدة";
        } else {
            $page_title = "Add Bagdes";
            $page_description = "Add new Governorate";
        } */
        $page_title = "Add Bagdes";
        $page_description = "Add new Bagdes";
        return view('dashboard.Badge.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Badges::rules($request);
        $request->validate($rules);
        $credentials = Badges::credentials($request);
        $Badges = Badges::create($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة الميزة"));
        } else {
            session()->flash('success',__("Badge has been added!"));
        } */
       session()->flash('success',__("Badge has been added!"));
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
            $page_title = "تعديل الشارة";
            $page_description = "تعديل";
        } else {
            $page_title = "Edit Badge";
            $page_description = "Edit";
        } */
        $page_title = "Edit Badge";
        $page_description = "Edit";
        $Badge = Badges::find($id);
        return view('dashboard.Badge.edit', compact('page_title', 'page_description','Badge'));
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
        $rules = Badges::rules($request);
        $request->validate($rules);
        $credentials = Badges::credentials($request);
        $Badges = Badges::where('id',$id)->update($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل الميزة"));
        } else {
            session()->flash('success',__("Badge has been updated!"));
        } */
       session()->flash('success',__("Badge has been updated!"));
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
       /*  $badge = Badges::find($id);
        if($badge->count()!=0){
            $badge->delete($id);
             if (Session::get('app_locale') == 'ar') {
            session()->flash('delete',__(" تم الحذف بنجاح!  "));
            } else {
                session()->flash('delete',__("Row has been deleted successfully!"));
            }
            session()->flash('delete', 'Row has been deleted successfully!');
            return redirect()->route('badge.index');
        }else{
            return redirect()->back();
        } */
    }
}
