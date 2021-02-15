<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyReview extends Model
{
    use HasFactory;
    protected $table    = 'agency_reviews';
    protected $fillable=[
        'rate',
        'price',
        'review',
        'agency_id',
        'user_id',
        'active'
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function agency() {
        return $this->belongsTo(Agency::class,'agency_id','id');
    }

    public static function rules()
    {
        $rules = [
            'rate'          => 'required|in:1,2,3,4,5',
            'price_type'    => 'required|in:1,2,3',
            'comment'       => 'required|min:3|max:1000',
            'center_id'     => 'required|integer',
        ];
        return $rules;
    }
    public static function credentials($request, $id = null)
    {
        $credentials = [
            'rate'                  =>  $request->rate,
            'price'            =>  $request->price_type,
            'review'               =>  $request->comment,
            'agency_id'             =>  $request->center_id,
        ];
        if ($id) {
            $credentials['user_id']      = $id;
        } else {
            $credentials['user_id']      = auth()->user()->id;
        }
        return $credentials;
    }
}
