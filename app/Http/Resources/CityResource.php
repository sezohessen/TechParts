<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $cityLists = [
            "id"            => $this->id,
            "title"         => Session::get('app_locale') == 'ar' ? $this->title_ar : $this->title,
            "government_id" => $this->governorate_id,
        ];
        return $cityLists;
    }
}
