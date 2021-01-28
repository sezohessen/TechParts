<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GovernorateCollection extends ResourceCollection
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
            'governmentList'    =>  parent::toArray($request),
            'status'        =>  true,
            "msg"           =>  __('Successfully')
        ];
    }
}
