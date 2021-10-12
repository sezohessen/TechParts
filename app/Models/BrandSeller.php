<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandSeller extends Model
{
    use HasFactory;
    protected $table    = 'brand_sellers';
    protected $fillable=[
        'brand_id',
        'seller_id'
    ];
    public static function credentials($brand_id,$seller_id)
    {
        $credentials = [
            'brand_id'      => $brand_id,
            'seller_id'     => $seller_id,
        ];
        return $credentials;
    }
    /**
     * Get the carMaker that owns the BrandSeller
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carMaker()
    {
        return $this->belongsTo(CarMaker::class,'brand_id','id');
    }
}
