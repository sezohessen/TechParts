<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected $type;
    public function type($value){
        $this->type = $value;
        return $this;
    }
    public function toArray($request)
    {

        return [
            'data' =>$this->collection->map(function(CarResource $resource) use($request){
                return $resource->type($this->type)->toArray($request);
            })->all(),
            'status'=>true,
            "msg"=>__('Success')
        ];

    }
}
