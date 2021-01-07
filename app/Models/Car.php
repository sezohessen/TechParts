<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table    = 'cars';
    protected $fillable=[
        'price',
        'PrePrice',
        'currency',
        'status',
        'kiloUsed',
        'ServiceHistory' ,
        'lat',
        'lng',
        'phone',
        'InstallmentMonth',
        'InstallmentPrice',
        'InstallmentCurrency' ,
        'Deposit' ,
        'DepositPrice' ,
        'DepositCurrency' ,
        'Country_id' ,
        'City_id' ,
        'Governorate_id' ,
        'CarModel_id' ,
        'CarMaker_id' ,
        'CarBody_id' ,
        'CarYear_id' ,
        'CarCapacity_id' ,
        'CarColor_id' ,
        'views' ,
        'AccidentBefore' ,
        'transmission' ,
        'payment',
        'SellerType',

    ];
}
