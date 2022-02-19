<?php

namespace App\Http\Resources;

use App\Http\Resources\PartResource;
use App\Http\Resources\ImagesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFavResource extends JsonResource
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
            'part_id'           => $this->part_id,
            'name'              => $this->partFav->name,
            'name_ar'           => $this->partFav->name_ar,
            'desc'              => $this->partFav->desc,
            'desc_ar'           => $this->partFav->desc_ar,
            'part_number'       => $this->partFav->part_number,
            'price'             => $this->partFav->price,
            'in_stock'          => $this->partFav->in_stock,
            'active'            => $this->partFav->active,
            // 'car_id'            => new CarResource($this->partFav->car_id),
            // 'user_id'           => $this->partFav->user_id,
            'first_image'       => new ImagesResource($this->partFav->first_image),
            'images'            => ImagesResource::collection($this->partFav->images)
        ];
    }

}
