<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table    = 'images';
    protected $fillable=[
        'name', 'base'
    ];
    public function Setting()
    {
        return $this->hasOne(Settings::class);
    }
    public function Insurance()
    {
        return $this->hasOne(Insurance::class);
    }
    public function offer()
    {
        return $this->hasOne(Insurance_offer::class);
    }
}
