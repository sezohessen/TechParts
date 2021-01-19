<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function type($value){
       return $value;
    }
    public function __construct() {
        parent::__construct($this->type());
    }
    public function toArray($request)
    {
        return [
            'data' =>parent::toArray($request),
            'status'=>true,
            "msg"=>__('Success')
        ];
    }
}
