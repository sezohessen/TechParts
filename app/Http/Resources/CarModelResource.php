<?php

namespace App\Http\Resources;

use App\Http\Resources\CarMakerResource;
use App\Models\CarModel;
use App\Models\CarYear;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
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
            'id'                => $this->id,
            'car_type_name'     => $this->name,
            'car_year'          => CarYearResource::collection($this->carYear)
        ];

    }
}
