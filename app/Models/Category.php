<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table    = 'categories';
    protected $fillable=[
        'name',
        'name_ar',
    ];
    public static function rules($request)
    {
        $rules = [
            'CategoryEnglish'         => 'required|string|max:255',
            'CategoryArabic'          => 'required|string|max:255',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'name'         =>  $request->CategoryEnglish,
            'name_ar'      =>  $request->CategoryArabic,
        ];
        return $credentials;
    }
}
