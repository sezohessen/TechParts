<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Image;
use App\Models\Badges;
use App\Models\Feature;
use App\Models\Car;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected $type;
    public function type($value){
        $this->type = $value;
        return $this;
    }
    public function toArray($request)
    {

        if($this->type==1){
            $carMan=attr_lang_name($this->manufacture->name_ar,$this->manufacture->name);
            if($this->payment== Car::PAYMENT_CASH ){
                $payment=__("Cash");
            }else {
                $payment=$this->payment== Car::PAYMENT_INSTALLMENT ? __("Installment") :  __("Financing");
            }
            $payment_loan_amount=$this->InstallmentPrice." ".$this->country->code." / ".$this->InstallmentMonth." months";
            $data = [
                "aboutCar" =>attr_lang_desc($this->Description_ar,$this->Description),
                "carFuelType"=>null,
                "bodyStyle"=>$this->body->name,
                "carManufacturing"=>$carMan,
                "color"=>@$this->color->code,
                "mDistributor"=>[
                    "image"=> null,
                    "name"=> null,
                    "rate"=> null,
                    "userId"=> null,
                    "userType"=> null
                ],
                "mLocation"=>[
                    "city_name"=>attr_lang_title($this->city->title_ar,$this->city->title),
                    "government_name"=>attr_lang_title($this->governorate->title_ar,$this->governorate->title),
                    "latitude"=>$this->lng,
                    "longitude"=>$this->lat,
                ],
                "other_costs"=>null,
                "payment_deposit"=>$this->DepositPrice,
                "payment_loan_amount"=>$payment_loan_amount ,
                "payment_loan_period"=>null,
                "payment_method"=>$payment,
                "serviceHistory"=>$this->ServiceHistory,
                "transmission"=> $this->transmission== Car::TRANSIMSSION_MANUAL ? __("Manual") :  __("Automatic"),
                //CarCapacity_id
                //SellerType
            ];
            return array_merge($this->item(),$data);
        }
        elseif($this->type==2)  {
            return $this->item();
        }
        elseif($this->type==3){
            $data=[
                "carFuelType"=>null,
                "transmission"=> $this->transmission== Car::TRANSIMSSION_MANUAL ? __("Manual") :  __("Automatic"),
                "used_kilometers"=> $this->kiloUsed
            ];
            return array_merge($this->item(),$data);
        }else {
            
            return $this->type;
        }

    }
    public function item(){
        $car_badges=[];
        foreach($this->badges as $item){
            ($badge=Badges::where('active', '=', 1)->find($item->badge_id))?$car_badges[]=attr_lang_name($badge->name_ar,$badge->name):'';
        }
        $car_features=[];
        foreach($this->features as $item){
            ($feature=Feature::where('active', '=', 1)->find($item->feature_id))? $car_features[]=attr_lang_name($feature->name_ar,$feature->name):'';
        }
        $data= [
            "adsExpire" =>date("Y-m-d",strtotime("+1 month",strtotime($this->created_at))),
            "badgeList"=>$car_badges,
            "featureList"=>$car_features,
        ];
        return array_merge($this->common(),$data);
    }
    public function common(){
        $price= $this->price-($this->price_after_discount*0.01*($this->price));
        $images=[];
        foreach($this->images as $item){
            $images[]=url('img/Cars/'.Image::find($item->img_id)->name);
        }
        return [
            "carMaker"=>@$this->model->name,
            "carModel"=>@$this->maker->name,
            "carState"=>$this->status== Car::IS_NEW ? __("New") :  __("Used"),
            "carYear"=>@$this->year->year,
            "id"=>$this->id,
            "imageList"=>$images,
            "isAccident"=>($this->AccidentBefore) ? true :false,
            "isAlertBefore"=>null,
            "isFavorite"=>null,
            "mContact"=> [
                "phone"=>$this->phone,
                "whats"=>null
            ],
            "price"=> (int)$price,
            "price_before_discount"=> $this->price,
            "promotedStatus"=> null,
        ];
    }

}
