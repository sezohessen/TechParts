<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table    = 'faqs';
    protected $fillable=[
        'question',
        'question_ar',
        'answer',
        'answer_ar',
    ];
    public static function rules($request)
    {
        $rules = [
            'question'       => 'required|min:3|max:1000',
            'question_ar'    => 'required|min:3|max:1000',
            'answer'         => 'required|min:3|max:1000',
            'answer_ar'      => 'required|min:3|max:1000',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'question'             =>  $request->question,
            'question_ar'          =>  $request->question_ar,
            'answer'               =>  $request->answer,
            "answer_ar"            =>  $request->answer_ar,
        ];

        return $credentials;
    }
}
