<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartResource extends JsonResource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'name_ar'        => $this->name_ar,
            'desc'           => $this->desc,
            'desc_ar'        => $this->desc_ar,
            'part_number'    => $this->part_number,
            'price'          => $this->price,
            'in_stock'       => $this->in_stock,
            'active'         => $this->active,
            'views'          => $this->views,
            'car'            => new CarResource($this->car),
            'seller'         => new SellerResource($this->seller),
            'first_image'    => new ImagesResource($this->first_image),
            'images'         => ImagesResource::collection($this->images),


        ];
    }
}
