<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCapacity extends Model
{
    use HasFactory;
    protected $table    = 'car_capacities';
    protected $fillable=[
        'capacity',
    ];
    public static function rules($request)
    {
        $rules = [
            'capacity'             => 'required|string|max:255',
        ];
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'capacity'              => $request->capacity,
        ];
        return $credentials;
    }
}
