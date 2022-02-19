<?php

namespace App\Http\Resources;

use App\Models\CarCapacity;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\CarYear;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'id'            => $this->id,
            'car_brand'     => CarMaker::find($this->CarMaker_id),
            'car_type'      => CarModel::find($this->CarModel_id),
            'car_year'      => CarYear::find($this->CarYear_id),
            'car_capacity'  => CarCapacity::find($this->CarCapacity_id),
        ];
    }
}
