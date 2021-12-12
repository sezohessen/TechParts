<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Privacy_Policy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         /* if (Session::get('app_locale') == 'ar') {
            $page_title = 'سياسة الخصوصية';
            $page_description = 'عرض سياسة الخصوصية';
        } else {
            $page_title = 'Privacy Policy';
            $page_description = 'View Privacy Policy';
        } */
        $page_title = __("Privcay and policy");
        $page_description = __("View Privacy Policy");
        $PPolicy = Privacy_Policy::first();
        return view('dashboard.PPolicy.show', compact('page_title', 'page_description','PPolicy'));
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
    public function show()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "سياسة الخصوصية";
            $page_description = "عرض سياسة الخصوصية";
        } else {
            $page_title = "Privacy And Policy";
            $page_description = "View Privacy And Policy";
        } */
        $page_title = __("Privcay and policy");
        $page_description = __("View Privacy Policy");
        $PPolicy = Privacy_Policy::first();
        return view('PPolicy.index',compact('page_title','page_description','PPolicy'));
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
        $PPolicy = Privacy_Policy::find($id);
        $this->validate($request,[
            'description'       => 'required|min:3',
            'description_ar'    => 'required|min:3'
        ]);
        $PPolicy->description       = $request->description;
        $PPolicy->description_ar    = $request->description_ar;
        $PPolicy->save();
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل سياسة الخصوصية"));
        } else {
            session()->flash('success',__("Privacy&Policy has been updated!"));
        } */
        session()->flash('success',__("Privacy&Policy has been upated!"));
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
        //
    }
}
