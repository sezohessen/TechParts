<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table    = 'news';
    protected $fillable=[
        'title',
        'title_ar',
        'authorName',
        'authorImg_id',
        'image_id',
        'category_id',
        'description',
        'description_ar',
    ];
    public static function rules($request)
    {
        $rules = [
            'title'             => 'required|string|max:255',
            'title_ar'          => 'required|string|max:255',
            'authorName'        => 'required|string|max:255',
            'category_id'       => 'required',
            'description'       => 'required|min:3|max:1000',
            'description_ar'    => 'required|min:3|max:1000',
            'authorImg'         => '',
            'Image'             => ''
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'title'             => $request->title,
            'title_ar'          => $request->title_ar,
            'authorName'        => $request->authorName,
            'category_id'       => $request->category_id,
            'description'       => $request->description,
            'description_ar'    => $request->description_ar,
            'authorImg'         => '',
            'Image'             => ''
        ];

        return $credentials;
    }
}
