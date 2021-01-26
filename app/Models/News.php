<?php

namespace App\Models;

use Exception;
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

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function imgAuthor(){
        return $this->belongsTo(Image::class,'authorImg_id','id');
    }
    public function img(){
        return $this->belongsTo(Image::class,'image_id','id');
    }
    public static function rules($request,$id = NULL)
    {
        $rules = [
            'title'             => 'required|string|max:255',
            'title_ar'          => 'required|string|max:255',
            'authorName'        => 'required|string|max:255',
            'category_id'       => 'required',
            'description'       => 'required|min:3|max:1000',
            'description_ar'    => 'required|min:3|max:1000',
            'authorImg_id'         => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',// 2m
            'image_id'             => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
        if($id){
            $rules['authorImg_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            $rules['image_id']     = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }
        return $rules;
    }
    public static function credentials($request,$id1 = NULL,$id2 = NULL)
    {
        $credentials = [
            'title'             => $request->title,
            'title_ar'          => $request->title_ar,
            'authorName'        => $request->authorName,
            'category_id'       => $request->category_id,
            'description'       => $request->description,
            'description_ar'    => $request->description_ar,
        ];
        if($request->file('authorImg_id')){
            if($id1){
                $Image_id = self::file($request->file('authorImg_id'),$id1);
            }else{
                $Image_id = self::file($request->file('authorImg_id'));
            }
            $credentials['authorImg_id'] = $Image_id;
        }
        if($request->file('image_id')){
            if($id2){
                $Image_id = self::file($request->file('image_id'),$id2);
            }else{
                $Image_id = self::file($request->file('image_id'));
            }
            $credentials['image_id'] = $Image_id;
        }
        return $credentials;
    }

    public static function file($file,$id = NULL)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/news/';
        $file->move($destinationPath, $fileName);
        if($id){//For update
            $Image = Image::find($id);
            //Delete Old image
            try {
                $file_old = $destinationPath.$Image->name;
                unlink($file_old);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            //Update new image
            $Image->name = $fileName;
            $Image->save();
            return $Image->id;
        }else{
            $Image = Image::create(['name' => $fileName,'base'=>'/img/news/']);
            return $Image->id;
        }
    }
}
