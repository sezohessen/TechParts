<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;
    protected $table    = 'governorates';
    protected $fillable=[
        'title',
        'title_ar',
    ];
    public function cities() {
        return $this->hasMany(City::class);
    }
    public static function rules($request)
    {
        $rules = [
            'title'         => 'required|string|max:255',
            'title_ar'      => 'required|string|max:255',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'title'             =>  $request->title,
            'title_ar'          =>  $request->title_ar,
        ];

        return $credentials;
    }
}
