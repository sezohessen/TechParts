<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\DataTables\NewsDatatable;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsDatatable $new)
    {
        $page_title = __("News");
        $page_description =__( "View News");
        return  $new->render("dashboard.News.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $rules = News::rules($request,NULL);
        $request->validate($rules);
        $credentials = News::credentials($request);
        $New = News::create($credentials);
        $New->save();
       session()->flash('success',__("news has been added!"));
       return redirect()->route("dashboard.news.index");
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
    public function edit(News $news)
    {
        $categories = Category::all();
        $page_title = __('news');
        $page_description = __('Frequently Asked Questions');
        return view('dashboard.News.edit', compact('page_title', 'page_description','news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules  = News::rules($request,$id);
        $request->validate($rules);
        $credentials = News::credentials($request);
        $New = News::where('id',$id)->update($credentials);

        session()->flash('updated',__("Changed has been updated successfully!"));
        return  redirect()->route("dashboard.news.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.news.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$new = News::find($id);
				$new->delete();
			}
		} else {
			$new = News::find(request('item'));
			$new->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.news.index");
    }
}
