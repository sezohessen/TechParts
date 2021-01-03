<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = 'التصنيفات';
            $page_description = 'عرض جميع التصنيفات';
        } else {
            $page_title = 'Categories';
            $page_description = 'View all Categories';
        } */
        $page_title = 'Categories';
        $page_description = 'View all Categories';

        return view('dashboard.Country.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if (Session::get('app_locale') == 'ar') {
            $page_title = "اضافة صنف";
            $page_description = "اضافة صنف جديد";
        } else {
            $page_title = "Add Category";
            $page_description = "Add new Category";
        } */
        $page_title = "Add Category";
        $page_description = "Add new Category";

        return view('dashboard.Category.add', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Category::rules($request);
        $request->validate($rules);
        $credentials = Category::credentials($request);
        $Category = Category::create($credentials);
        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة الصنف"));
        } else {
            session()->flash('success',__("Category has been added!"));
        } */
       session()->flash('success',__("Category has been added!"));
       return redirect()->route("category.index");
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
