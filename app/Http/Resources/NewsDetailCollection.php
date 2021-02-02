<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsDetailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected $type;
    public function toArray($request)
    {
        return parent::toArray($request);
        return  [
            $this->type => parent::toArray($request),
        ];
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }
}
