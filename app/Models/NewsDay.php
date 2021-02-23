<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsDay extends Model
{
    use HasFactory;
    protected $table    = 'news_days';
    protected $dates    = ['day'];
    protected $fillable=[
        'day',
    ];
    public function trends()
    {
        return $this->belongsToMany(News::class, 'trending_news', 'trend_id','news_id');
    }
    public static function  rules($request)
    {
        $rules = [
            'day'            =>  'required|date',
            'news_id'        =>  'required|array|min:1',
        ];
        return $rules;
    }
    public static function  credentials($request)
    {
        $credentials = [
            'day'            => date("Y-m-d", strtotime($request->day)) ,
        ];

        return $credentials;
    }
}
