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
            'authorImg'         => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',// 2m
            'Image'             => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
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
        ];
        if($request->file('Image')){
            $Image_id = self::file($request->file('Image'));
            $credentials['image_id'] = $Image_id;
        }
        if($request->file('authorImg')){
            $authorImg_id = self::file($request->file('authorImg'));
            $credentials['authorImg_id'] = $authorImg_id;
        }
        return $credentials;
    }

    public static function file($file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/news/';
        $file->move($destinationPath, $fileName);
        $Image = Image::create(['name' => $fileName]);
        return $Image->id;
    }
}
