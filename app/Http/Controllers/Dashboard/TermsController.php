<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = 'الشروط';
            $page_description = 'عرض الشروط';
        } else {
            $page_title = 'Terms';
            $page_description = 'View all terms';
        } */
        $page_title =  __("Terms");
        $page_description =  __("Terms And Conditions");
        $terms = Terms::first();
        return view('dashboard.Terms.add', compact('page_title', 'page_description','terms'));
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
            $page_title = "الاحكام والشروط";
            $page_description = "عرض الاحكام والشروط";
        } else {
            $page_title = "Terms and condition";
            $page_description = "View terms description";
        } */
        $page_title =  __("Terms");
        $page_description =  __("Terms And Conditions");
        $terms = Terms::first();
        return view('Terms.index',compact('page_title','page_description','terms'));
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
        $term = Terms::find($id);
        $this->validate($request,[
            'description'       => 'required|min:3',
            'description_ar'    => 'required|min:3'
        ]);
        $term->description       = $request->description;
        $term->description_ar   = $request->description_ar;
        $term->save();
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم تعديل الشروط"));
        } else {
            session()->flash('success',__("Terms has been updated!"));
        } */
        session()->flash('success',__("Terms has been upated!"));
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
