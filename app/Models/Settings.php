<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    const base = '/img/settings/';
    protected $table    = 'settings';
    protected $fillable=[
        'appName',
        'appName_ar',
        'logo',
        'email',
        'phone',
        'whatsapp',
        'facebook',
        'instgram',
        'location',
        'andriod',
        'ios',
    ];
    public function logo()
    {
        return $this->belongsTo(Image::class);
    }


}
