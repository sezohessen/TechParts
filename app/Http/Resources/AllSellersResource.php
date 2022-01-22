<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllSellersResource extends JsonResource
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
        if($request->lang == 'en')
        {
            return [
                'first_name'    =>$this->user->first_name,
                'last_name'     =>$this->user->last_name,
                'desc'          =>$this->desc,
                'email'         =>$this->user->email,
                'created_at'    =>$this->created_at,
            ];
        } else {
            return [
                'first_name'    =>$this->user->first_name,
                'last_name'     =>$this->user->last_name,
                'desc'          =>$this->desc_ar,
                'email'         =>$this->user->email,
                'created_at'    =>$this->created_at,
            ];
        }
    }
}
