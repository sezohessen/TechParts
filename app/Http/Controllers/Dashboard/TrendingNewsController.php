<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\TrendingNewsDatatable;
use App\Models\News;
use App\Models\NewsDay;
use App\Models\TrendingNews;

class TrendingNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrendingNewsDatatable $trendingNews)
    {
        $page_title = __("Trending news");
        $page_description = __("View news");
        return  $trendingNews->render("dashboard.TrendingNews.index", compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title         = __("Add trend news");
        $page_description   = __("Add");
        $newsList           = News::all();
        return view('dashboard.TrendingNews.add', compact('page_title', 'page_description',"newsList"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules      = NewsDay::rules($request);
        $request->validate($rules);
        $ValidDay   = NewsDay::where('day',date("Y-m-d", strtotime($request->day)))->get();
        if($ValidDay->count()){
            session()->flash('failed',__("This day already exist as a trend day"));
            return  redirect()->back();
        }
        $credentials    = NewsDay::credentials($request);
        $trend          = NewsDay::create($credentials);
        foreach($request->news_id as $news)
        {
            TrendingNews::create([
                "news_id"       => $news,
                "trend_id"      => $trend->id
            ]);
        }
        session()->flash('created',__("Changes has been Created Successfully"));
        return  redirect()->route("dashboard.trending-news.index");
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
        $trending   = NewsDay::find($id);
        if($trending==NULL)return redirect()->route('dashboard.trending-news.index');
        $page_title         = __("Edit news trend");
        $page_description   = __("Edit");
        $newsList           = News::all();
        $newsSelect=[];
        foreach($trending->trends as $item){
            $newsSelect[]   =   $item->id;
        }
        return view('dashboard.TrendingNews.edit', compact('page_title', 'page_description'
        ,"newsList","trending","newsSelect"));
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
        $rules      = NewsDay::rules($request);
        $request->validate($rules);
        $ValidDay   = NewsDay::where('day',date("Y-m-d", strtotime($request->day)))
        ->where('id','!=',$id)
        ->get();
        if($ValidDay->count()){
            session()->flash('failed',__("This day already exist as a trend day"));
            return  redirect()->back();
        }
        $credentials    = NewsDay::credentials($request);
        $NewsDay        = NewsDay::where('id',$id)->update($credentials);
        /* Update Trending News */
        $TrendingNews     = TrendingNews::where('trend_id',$id)->get();
        $SelectedNews = [];
        foreach($TrendingNews as $News){
            $SelectedNews[] = $News->news_id;
        }
        $NeedToBeDeleted = array_diff($SelectedNews,$request->news_id);
        $NeedToBeCreated = array_diff($request->news_id,$SelectedNews);

        $rules          = TrendingNews::rules($request);
        $request->validate($rules);

        foreach ($NeedToBeCreated as $news){
            $credentials    = TrendingNews::credentials($news,$id);
            $TrendingNews   = TrendingNews::create($credentials);
        }
        foreach ($NeedToBeDeleted as $news){
            $TrendingNews      = TrendingNews::where([
                ['news_id',$news],
                ['trend_id',$id]
            ])->delete();
        }
        session()->flash('created',__("Changes has been Updated Successfully"));
        return  redirect()->route("dashboard.trending-news.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trending = NewsDay::find($id);
        $trending->delete();
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.trending-news.index");
    }
    public function multi_delete(){
        if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$trending = NewsDay::find($id);
				$trending->delete();
			}
		} else {
			$trending = NewsDay::find(request('item'));
			$trending->delete();
		}
        session()->flash('deleted',__("Changes has been Deleted Successfully"));
        return redirect()->route("dashboard.trending-news.index");
    }
}
