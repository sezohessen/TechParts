<?php

namespace App\Http\Resources;

use App\Models\CarMaker;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
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
            'id'                => $this->id,
            'car_brand'         => CarMaker::find($this->brand_id),
            // 'car_brand' =>   => new CarMakerResource(CarMaker::find($this->brand_id))
        ];
    }
}
