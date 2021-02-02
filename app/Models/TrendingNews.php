<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendingNews extends Model
{
    use HasFactory;
    protected $table    = 'trending_news';
    protected $fillable=[
        'trend_id',
        'news_id'
    ];
    
    public static function rules($request)
    {
        $rules = [
            'news_id'            => "required|array",
            'news_id.*'          => "required|distinct",
            'trend_id'           => 'nullable',
        ];
        return $rules;
    }
    public static function credentials($news_id,$trend_id)
    {
        $credentials = [
            'news_id'           =>  $news_id,
            'trend_id'          =>  $trend_id,
        ];

        return $credentials;
    }
}
