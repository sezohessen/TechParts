<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
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
            $page_title = "اضافة خبر";
            $page_description = "اضافة خبر جديدة";
        } else {
            $page_title = "Add News";
            $page_description = "Add new news";
        } */
        $page_title = "Add News";
        $page_description = "Add new news";
        $categories = Category::all();
        return view('dashboard.News.add', compact('page_title', 'page_description','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = News::rules($request);
        $request->validate($rules);
        $credentials = News::credentials($request);
        $New = News::create($credentials);
        $New->save();


        /* if (Session::get('app_locale') == 'ar') {
            session()->flash('success',__("تم اضافة منشور"));
        } else {
            session()->flash('success',__("news has been added!"));
        } */
       session()->flash('success',__("news has been added!"));
       return redirect()->route("news.index");
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
