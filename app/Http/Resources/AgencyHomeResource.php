<?php

namespace App\Http\Resources;

use App\Http\Controllers\api\AgencyController;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $agency=new AgencyController;

        $data=$agency->AgencyData($this,$workType = false,$specializationList = false,$badgesList = false,$description = false,
        $paymentMethodList = false);

        return $data;
    }
}
