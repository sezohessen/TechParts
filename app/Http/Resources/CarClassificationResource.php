<?php

namespace App\Http\Resources;

use App\Models\CarMaker;
use Illuminate\Http\Resources\Json\JsonResource;

class CarClassificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'name_ar'       => $this->name_ar,
            'brand'         => CarMakerResource::collection($this->brand)
        ];
    }
}
