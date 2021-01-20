<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "currency_name"=> $this->currency_name,
            "description"=> attr_lang_desc($this->description_ar,$this->description),
            "id"=> $this->id,
            "period"=> $this->period,
            "price"=> $this->price

        ];
    }
}
