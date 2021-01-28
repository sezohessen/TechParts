<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class GovernorateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $governmentLists = [
            "id"            => $this->id,
            "title"         => Session::get('app_locale') == 'ar' ? $this->title_ar : $this->title,
            "country_name"  => Session::get('app_locale') == 'ar' ? $this->country->name_ar : $this->country->name,
        ];
        return $governmentLists;
    }
}
