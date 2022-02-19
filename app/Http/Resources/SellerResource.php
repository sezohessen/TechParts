<?php

namespace App\Http\Resources;

use App\Models\CarMaker;
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

        return [
            'id'                    => $this->id,
            'seller_name'           => $this->user->full_name,
            'desc'                  => $this->desc,
            'desc_ar'               => $this->desc_ar,
            'brands'                => BrandsResource::collection($this->brands),
            'lat'                   => $this->lat,
            'long'                  => $this->long,
            'street'                => $this->street,
            'facebook'              => $this->facebook,
            'instagram'             => $this->instagram,
            'file'                  => $this->file,
            'governorate'           => $this->governorate,
            'city'                  => $this->city,
            'background'            => $this->background?(site_base() . $this->background->base . $this->background->name):NULL,
            'avatar'                => $this->sellerAvatar?(site_base() . $this->sellerAvatar->base . $this->sellerAvatar->name):NULL,

        ];
    }



}
