<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table    = 'settings';
    protected $fillable=[
        'appName',
        'appName_ar',
        'logo_id'
    ];
    public function logo()
    {
        return $this->belongsTo(Image::class);
    }
    use HasFactory;
}
