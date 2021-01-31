<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsDetailCollection;
use App\Models\Category;
use App\Models\News;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use GeneralTrait;
    public function show(Request $request)
    {
        $this->lang($request->lang);
        if (!$request->news_id) {
            return $this->errorField('News id ');
        }
        $news    = News::find($request->news_id);
        if (!$news) {
            return $this->returnError('Not found');
        }
        $data   = [
            'id'            => $news->id,
            'author_image'  => find_image(@$news->imgAuthor),
            'image'         => find_image(@$news->img),
            'author_name'   => $news->authorName,
            'category_id'   => $news->category_id,
            'date'          => date("Y-m-d", strtotime($news->created_at)),
            'details'       => Session::get('app_locale') == 'ar' ? $news->description_ar : $news->description,
            'title'         => Session::get('app_locale') == 'ar' ? $news->title : $news->title,

        ];
        return $this->returnData('mNews', $data, __('Success'));
    }
    public function filter(Request $request)
    {
        $this->lang($request->lang);
        if (!$request->category_id) {
            return $this->errorField('Category id ');
        }
        $category   = Category::find($request->category_id);
        if (!$category) {
            return $this->returnError('No such Category id exist');
        }
        $news       = News::where('category_id', $request->category_id);
        if (!$news->count()) {
            return $this->returnError('No news in this category');
        }
        $data           = new NewsDetailCollection($news->paginate(10));
        /* $Trendingdata   = new NewsDetailCollection($news->paginate(10)); */
        return $data;
    }
    public function category()
    {
        $categroyLists  = Category::where('active', 1)->get();
        $categories     = [];
        foreach ($categroyLists as $categroyList) {
            $categories[]   = [
                "id"        => $categroyList->id,
                "title_en"  => $categroyList->name,
                "title_ar"  => $categroyList->name_ar,
            ];
        }
        return $this->returnData("listMain", $categories, "Successfully");
    }
}
