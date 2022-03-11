<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
    use HasFactory;

    protected $table    = 'ch_messages';
    protected $fillable=[
        'type',
        'from_id',
        'to_id',
        'body',
        'attachment',
        'seen',
    ];

    public function FromUser()
    {
        return $this->belongsTo(User::class,"from_id","id");
    }

    public function ToUser()
    {
        return $this->belongsTo(User::class,"to_id","id");
    }
}
