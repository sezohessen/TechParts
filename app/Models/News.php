<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table    = 'news';
    protected $fillable=[
        'title',
        'title_ar',
        'authorName',
        'authorImg_id',
        'image_id',
        'category_id',
        'description',
        'description_ar',
    ];
}
