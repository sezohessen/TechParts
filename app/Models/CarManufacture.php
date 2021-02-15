<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarManufacture extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table    = 'car_manufactures';
    protected $fillable=[
        'name',
        'name_ar',
    ];

    public function getNameByLangAttribute(){
        return Session::get('app_locale') == 'ar' ? $this->name_ar : $this->name;
    }

}
