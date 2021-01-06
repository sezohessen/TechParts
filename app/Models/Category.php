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
        'active'
    ];
    public static function rules($request)
    {
        $rules = [
            'name'         => 'required|string|max:255|min:3',
            'name_ar'          => 'required|string|max:255|min:3',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'name'         =>  $request->name,
            'name_ar'      =>  $request->name,
        ];
        return $credentials;
    }
}
