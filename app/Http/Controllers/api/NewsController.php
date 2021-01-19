<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use GeneralTrait;
    public function show(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        if (!$request->news_id) {
            return $this->errorField('News id ');
        }
        $news    = News::find($request->news_id);
        if(!$news){
            return $this->returnError('Not found');
        }
        $data   = [
            'id'            => $news->id,
            'author_image'  => $news->imgAuthor->name,
            'image'         => $news->img->name,
            'author_name'   => $news->authorName,
            'category_id'   => $news->category_id,
            'date'          => date("Y-m-d",strtotime($news->created_at)),
            'details'       => Session::get('app_locale')=='ar'? $news->description_ar : $news->description,
            'title'         => Session::get('app_locale')=='ar'? $news->title : $news->title,

        ];
        return $this->returnData('mNews',$data,__('Success'));
    }
    /* public function filter(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        if (!$request->news_id) {
            return $this->errorField('News id ');
        }
        $news    = News::find($request->news_id);
        if(!$news){
            return $this->returnError('Not found');
        }
        $data   = [
            'id'            => $news->id,
            'author_image'  => $news->imgAuthor->name,
            'image'         => $news->img->name,
            'author_name'   => $news->authorName,
            'category_id'   => $news->category_id,
            'date'          => date("Y-m-d",strtotime($news->created_at)),
            'details'       => Session::get('app_locale')=='ar'? $news->description_ar : $news->description,
            'title'         => Session::get('app_locale')=='ar'? $news->title : $news->title,

        ];
        return $this->returnData('mNews',$data,__('Success'));
    } */
}
