<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table    = 'cars';

    const TRANSIMSSION_MANUAL  = 0;
    const TRANSIMSSION_AUTOMATIC = 1;

    const PAYMENT_CASH  = 0;
    const PAYMENT_INSTALLMENT = 1;
    const PAYMENT_FINANCING = 3;

    const STATUS_NEW  = 0;
    const STATUS_USED = 1;

    const SELLER_AGENCY=0;
    const SELLER_DISTRIBUTOR=1;
    const SELLER_INDIVIDUAL=2;


    protected $fillable=[
        'price',
        'price_after_discount',
        'Description',
        'Description_ar',
        'CarManufacture_id',
        'status',
        'kiloUsed',
        'ServiceHistory' ,
        'lat',
        'lng',
        'phone',
        'InstallmentMonth',
        'InstallmentPrice',
        'DepositPrice' ,
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
