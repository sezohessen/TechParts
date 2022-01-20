<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            'Seller name' => $this->user->full_name,
            'Arabic Desc' => $this->desc_ar,
            'background'  => $this->background->base    . $this->background->name,
            'avatar'      => $this->sellerAvatar->base  . $this->sellerAvatar->name,
            'brands'      => $this->brands

        ];
    }
}
