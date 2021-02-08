<?php

namespace App\Http\Resources;

use App\Models\Agency;
use App\Models\AgencyReview;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class DistributorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $agencyLists = [
            "image"     => find_image(@$this->img),
            "logo"      => find_image(@$this->logo),
            "name"      => Session::get('app_locale') == 'ar' ? $this->name_ar : $this->name,
            "rate"      => $this->rate($this),
            "userId"    => $this->user_id,
            "userType"  => Agency::ApiAgecnyType()[$this->agency_type],
        ];
        return $agencyLists;
    }
    public function rate($agency)
    {
        // Rate Row
        $rate   = AgencyReview::where('agency_id', $agency->id)
            ->selectRaw('SUM(rate)/COUNT(user_id) AS avg_rating')
            ->first()
            ->avg_rating;
        return $rate;
    }
}
