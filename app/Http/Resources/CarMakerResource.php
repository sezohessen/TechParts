<?php

namespace App\Http\Resources;

use App\Models\CarMaker;
use App\Models\CarModel;
use App\Http\Resources\CarModelResource;
use App\Models\CarCapacity;
use Illuminate\Http\Resources\Json\JsonResource;

class CarMakerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'                    => $this->id,
            'car_brand_name'        => $this->name,
            // 'car_classification'    => $this->Classification,
            'logo'                  => site_base() . $this->logo->base  . $this->logo->name,
            'car_type'              => CarModelResource::collection($this->carMaker),
        ];
    }
}
