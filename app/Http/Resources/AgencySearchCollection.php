<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AgencySearchCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'centerList'    =>  parent::toArray($request),
            'status'        =>  true,
            "msg"           =>  __('Successfully')
        ];
    }
}
