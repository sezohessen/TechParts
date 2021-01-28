<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $countryLists = [
            "id"            => $this->id,
            "title"         => Session::get('app_locale') == 'ar' ? $this->name_ar : $this->name,
            "code"          => $this->code,
            "country_phone" => $this->country_phone,
        ];
        return $countryLists;
    }
}
